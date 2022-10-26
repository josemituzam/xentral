import { Component, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { ColumnMode, DatatableComponent } from '@swimlane/ngx-datatable';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { CoreConfigService } from '@core/services/config.service';
import { CoreSidebarService } from '@core/components/core-sidebar/core-sidebar.service';
import { ResquestdomainListService } from './requestdomain-list.service';
import { FormControl } from '@angular/forms';
import Swal from 'sweetalert2';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { RequestDomainEditModalComponent } from '../request-domain-edit/request-domain-edit-modal.component';
import { RequestDomain } from 'app/core/models/request-domain.model';


@Component({
  selector: 'app-requestdomain-list',
  templateUrl: './requestdomain-list.component.html',
  styleUrls: ['./requestdomain-list.component.scss'],
  encapsulation: ViewEncapsulation.None,
  //  changeDetection: ChangeDetectionStrategy.OnPush,
})
export class RequestDomainListComponent implements OnInit {
  // Public
  public sidebarToggleRef = false;
  public rows;
  public pageSizes: number;
  public curPages: number = 1;
  public rowCounts: number;
  public sortBy: string = 'created_at'
  public selectedOption = 10;

  itemsPerPage = new FormControl('10');
  searchQuery = new FormControl('');

  public currentVisible: number = 3;


  public ColumnMode = ColumnMode;
  public temp = [];
  public selectedStatus = [];
  public selectedApproved = [];
  public previousRoleFilter = '';
  public previousPlanFilter = '';
  public previousStatusFilter = '';
  public searchValue = '';
  public isActive = '';
  public isApproved = '';

  // Decorator
  @ViewChild(DatatableComponent) table: DatatableComponent;

  // Private
  private tempData = [];
  private _unsubscribeAll: Subject<any>;
  public contentHeader: object

  /**
   * Constructor
   *
   * @param {CoreConfigService} _coreConfigService
   * @param {ResquestdomainListService} _service
   * @param {CoreSidebarService} _coreSidebarService
   */
  constructor(
    private _service: ResquestdomainListService,
    private modalService: NgbModal,
    private _coreConfigService: CoreConfigService,
    // private cdr: ChangeDetectorRef,
  ) {
    this._unsubscribeAll = new Subject();
  }

  public getStatus: any = [
    { is_active: 1, name: 'Activo', icon: 'fa fa-check' },
    { is_active: 0, name: 'Inactivo', icon: 'fa fa-times' },
  ];

  public getApproved: any = [
    { is_approved: 1, name: 'Aprobado', icon: 'fa fa-thumbs-o-up' },
    { is_approved: 0, name: 'No aprobado', icon: 'fa fa-thumbs-o-down' },
  ];


  filterByApproved(event) {
    this.isApproved = event ? event.is_approved : '';
    this.getRowData();
  }

  filterByStatus(event) {
    this.isActive = event ? event.is_active : '';
    this.getRowData();
  }


  onCheckboxChange($event, id) {
    var band = 0;
    if ($event.target.checked == true) {
      band = 1;
    }
    var obj = {
      id: id,
      is_active: band,
    };
    this._service.putActive(obj).subscribe(
      (item: any) => {
        if (item) {
          this.getRowData();
        }
      },
      (err) => {
      }
    );
  }

  // actions
  add() {
    const modalRef = this.modalService.open(RequestDomainEditModalComponent, {
      centered: true,
      size: 'lg' // size: 'xs' | 'sm' | 'lg' | 'xl'
    });
    modalRef.result.then(
      () => this.getRowData(),
      () => { }
    );
  }
  edit(obj: RequestDomain) {
    const modalRef = this.modalService.open(RequestDomainEditModalComponent, {
      centered: true,
      size: 'lg' // size: 'xs' | 'sm' | 'lg' | 'xl'
    });
    modalRef.componentInstance.fullname = obj.fullname;
    modalRef.componentInstance.domain_name = obj.domain_name;
    modalRef.componentInstance.id = obj.id;
    modalRef.result.then(
      () => this.getRowData(),
      () => { }
    );
  }


  putSweetAccept(id) {
    Swal.fire({
      title: '¿Desea aprobar la solicitud?',
      text: "Este aprobación creará un nuevo inquilino",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#7367F0',
      cancelButtonColor: '#E42728',
      confirmButtonText: 'Aceptar',
      cancelButtonText: 'Cancelar',
      customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-danger ml-1'
      }
    }).then((result) => {
      if (result.value) {
        var obj = {
          id: id,
          is_approved: 1,
        };
        Swal.fire({
          icon: 'success',
          title: 'Inquilino creado',
          text: 'Tu nuevo cliente ha sido aprobado',
          customClass: {
            confirmButton: 'btn btn-success'
          }
        });
        this._service.putApproved(obj).subscribe(
          (item: any) => {
            if (item) {
              this.getRowData();
            }
          },
          (err) => {
          }
        );
      }

    });
  }
  // Public Methods
  // -----------------------------------------------------------------------------------------------------

  onSort(event) {
    console.log(event?.column?.prop);
    this.sortBy = event?.column?.prop;
    this.getRowData();

  }

  pageLimit(num: string) {
    this.selectedOption = Number(num);
    this.getRowData();
  }
  /**
   * filterUpdate
   *
   * @param event
   */
  filterUpdate(event) {
    const val = event.target.value.toLowerCase();
    this.searchValue = val;
    this.getRowData();
  }

  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------
  /**
   * On init
   */
  ngOnInit(): void {
    this.contentHeader = {
      headerTitle: 'Solicitudes de dominio',
      actionButton: true,
      breadcrumb: {
        type: '',
        links: [
          {
            name: 'Registros',
            isLink: false,
            link: '/'
          },
        ]
      }
    }

    // Subscribe config change
    this._coreConfigService.config.pipe(takeUntil(this._unsubscribeAll)).subscribe(config => {
      //! If we have zoomIn route Transition then load datatable after 450ms(Transition will finish in 400ms)
      if (config.layout.animation === 'zoomIn') {
        this.getRowData();
      } else {
        this.getRowData();
      }
    });
  }

  getRowData() {
    this._service.getDataTableRows(this.searchValue, this.selectedOption, this.curPages, this.sortBy, this.isActive, this.isApproved).subscribe(res => {
      if (res) {
        this.rows = res['data'];
        this.pageSizes = res['last_page'];
        this.curPages = res['current_page'];
        this.rowCounts = res['total'];
      }
    }
    );
  }

  handlePageChange(event: any): void {
    this.curPages = event.page;
    this.getRowData();
  }

  /**
   * On destroy
   */
  ngOnDestroy(): void {
    // Unsubscribe from all subscriptions
    this._unsubscribeAll.next();
    this._unsubscribeAll.complete();
  }
}

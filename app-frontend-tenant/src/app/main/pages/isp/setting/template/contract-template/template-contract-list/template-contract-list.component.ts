import { Component, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { ColumnMode, DatatableComponent } from '@swimlane/ngx-datatable';

import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { FormControl } from '@angular/forms';
import { CoreConfigService } from '@core/services/config.service';
import { CoreSidebarService } from '@core/components/core-sidebar/core-sidebar.service';
import Swal from 'sweetalert2'
import { TemplateContractListService } from './template-contract-list.service';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { ContractModalComponent } from '../contract-modal/contract-modal.component';


@Component({
  selector: 'app-template-contract-list',
  templateUrl: './template-contract-list.component.html',
  styleUrls: ['./template-contract-list.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class TemplateContractListComponent implements OnInit {
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
  public previousRoleFilter = '';
  public previousPlanFilter = '';
  public previousStatusFilter = '';
  public searchValue = '';
  public isActive = '';

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
   * @param {ServiceListService} _service
   * @param {CoreSidebarService} _coreSidebarService
   */
  constructor(
    private modalService: NgbModal,
    private _service: TemplateContractListService,
    private _coreSidebarService: CoreSidebarService,
    private _coreConfigService: CoreConfigService,
  ) {
    this._unsubscribeAll = new Subject();
  }

  public getStatus: any = [
    { is_active: 1, name: 'Activo', icon: 'fa fa-check' },
    { is_active: 0, name: 'Inactivo', icon: 'fa fa-times' },
  ];


  filterByStatus(event) {
    this.isActive = event ? event.is_active : '';
    this.getRowData();
  }

  downloadPdf(name: any, id: any) {
    this._service.downloadPdf(name, id).subscribe(
      (item: any) => {
        if (item) {
          console.log(item)
        }
      },
      (err) => {
      }
    );
  }

  seePDF(obj: any) {
    const modalRef = this.modalService.open(ContractModalComponent, {
      centered: true,
      backdrop: 'static',
      size: 'lg' // size: 'xs' | 'sm' | 'lg' | 'xl'
    });
    modalRef.componentInstance.id = obj.id;
    modalRef.componentInstance.title = obj.name;
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

  delete(id: string) {
    Swal.fire({
      title: '¿Desea eliminar el registro?',
      
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Eliminar'
    }).then((result) => {
      if (result.isConfirmed) {
        this._service
          .delete(id).subscribe({
            next: (res) => {
              Swal.fire(
                'Eliminado!',
                'Tu registro ha sido eliminado.',
                'success'
              )
              this.getRowData();
            }
          })
      }
    })
  }

  // Public Methods
  // -----------------------------------------------------------------------------------------------------

  onSort(event) {
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

  /**
   * Toggle the sidebar
   *
   * @param name
   */
  toggleSidebar(name): void {
    this._coreSidebarService.getSidebarRegistry(name).toggleOpen();
  }

  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------
  /**
   * On init
   */
  ngOnInit(): void {
    this.contentHeader = {
      headerTitle: 'Plantillas de contratos',
      actionButton: true,
      breadcrumb: {
        type: '',
        links: [
          {
            name: 'Menú',
            isLink: true,
            link: '/isp/template/main'
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
    this._service.getDataTableRows(this.searchValue, this.selectedOption, this.curPages, this.sortBy, this.isActive).subscribe(res => {
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
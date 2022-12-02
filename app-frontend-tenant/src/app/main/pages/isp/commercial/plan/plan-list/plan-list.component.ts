import { Component, OnInit, ViewChild, ViewEncapsulation } from '@angular/core';
import { ColumnMode, DatatableComponent } from '@swimlane/ngx-datatable';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { CoreConfigService } from '@core/services/config.service';
import { CoreSidebarService } from '@core/components/core-sidebar/core-sidebar.service';
import { FormControl } from '@angular/forms';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import Swal from 'sweetalert2'
import { PlanListService } from './plan-list.service';

@Component({
  selector: 'app-plan-list',
  templateUrl: './plan-list.component.html',
  styleUrls: ['./plan-list.component.scss'],
  encapsulation: ViewEncapsulation.None,
  //  changeDetection: ChangeDetectionStrategy.OnPush,
})
export class PlanListComponent implements OnInit {
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
   * @param {CoreSidebarService} _coreSidebarService
   */
  constructor(
    private _service: PlanListService,
    private _coreSidebarService: CoreSidebarService,
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
      headerTitle: 'Planes',
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

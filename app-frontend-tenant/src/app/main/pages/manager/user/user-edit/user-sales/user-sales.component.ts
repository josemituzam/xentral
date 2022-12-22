import { Component, OnInit, OnDestroy, ViewEncapsulation, ChangeDetectorRef } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { FormGroup, FormBuilder } from '@angular/forms';
import { ZoneSale } from 'core/models/manager/zone-sale.model';
import { AbstractControl, Validators } from '@angular/forms';
import { Subject, of, Subscription, Observable } from 'rxjs';
import { catchError, delay, finalize, tap } from 'rxjs/operators';
import Swal from 'sweetalert2'
import { SalesService } from 'core/services/manager/sales.service';
import { Sales } from 'core/models/manager/sales.model';
import { UserDetailService } from 'core/services/manager/user-detail.service';

@Component({
  selector: 'app-user-sales',
  templateUrl: './user-sales.component.html',
  styleUrls: ['./user-sales.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class UserSalesComponent implements OnInit, OnDestroy {
  // Public
  public url = this.router.url;
  public urlLastValue;
  public rows;
  public currentRow;
  public tempRow;
  public contentHeader: object
  editForm: FormGroup;
  itemModel: Sales;
  private _unsubscribeAll: Subject<any>;
  loading = false;
  subscriptions: Subscription[] = [];
  saleList: any[];
  /**
   * Constructor
   *
   * @param {Router} router
   * @param {UserEditService} _userEditService
   */
  constructor(private cdr: ChangeDetectorRef, private _service: UserDetailService, private router: Router, private fb: FormBuilder, private activatedRoute: ActivatedRoute) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
  }

  // Public Methods
  // -----------------------------------------------------------------------------------------------------

  initForm() {

  }

  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------
  /**
   * On init
   */
  ngOnInit(): void {
    this.getSales();
  }

  setUserSale($event, id) {
    var band = 0;
    if ($event.target.checked == true) {
      band = 1;
    }
    var obj = {
      id: id,
      is_active: band,
    };
    this.cdr.detectChanges();
  }

  getSales() {
    this._service.getSales().subscribe(
      (item: any) => {
        if (item) {
          this.saleList = item;
          this.cdr.detectChanges();
        }
      },
      (error) => { console.log(error) },
      () => { }
    );
  }

  /**
  * Submit
  *
  * @param form
  */
  submit() {

  }

  /*
   * On destroy
   */
  ngOnDestroy(): void {
    // Unsubscribe from all subscriptions
    this._unsubscribeAll.next();
    this._unsubscribeAll.complete();
  }
}

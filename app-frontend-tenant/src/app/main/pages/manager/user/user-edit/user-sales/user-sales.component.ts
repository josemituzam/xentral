import { Component, OnInit, OnDestroy, Input, ViewEncapsulation, ChangeDetectorRef } from '@angular/core';
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
  userSaleList: any[];
  @Input() userId: string;
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
    this.editForm = this.fb.group({
      sale_id: [
        null,
        Validators.compose([Validators.required]),
      ],
    });
  }


  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------
  /**
   * On init
   */
  ngOnInit(): void {
    this.initForm();
    this.getUserSales(this.userId);
    this.getSales();
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

  getUserSales(user_id: string) {
    this._service.getUserSales(user_id).subscribe(
      (item: any) => {
        if (item) {
          this.userSaleList = item;
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
    this.loading = true;

    const controls = this.editForm.controls;
    /** check form */
    if (this.editForm.invalid) {
      Object.keys(controls).forEach((controlName) => {
        console.log(
          "invalid editForm " + controlName + " = ",
          controls[controlName].status
        );
        controls[controlName].markAsTouched();
      });
      this.loading = false;
      this.cdr.detectChanges();
      return;
    }
    let item = {
      sale_id: controls["sale_id"].value,
      user_id: this.userId
    }
    this.addItem(item);
  }

  addItem(_item: any) {
    const sbCreate = this._service.createUserSale(_item).pipe(
      catchError((errorMessage) => {
        console.log(errorMessage);
        if (errorMessage.status == 422) {
          Swal.fire("Acción no válida!", errorMessage.error.msg, "error");
        }
        this.loading = false;
        this.cdr.detectChanges();
        return of(null);
      })
    ).subscribe((res: any) => {
      if (res) {
        this.loading = false;
        this.getUserSales(res.user_id);
        this.setMessageSuccess("Guardado Correctamente");

      }
    });
    this.subscriptions.push(sbCreate);
  }

  deleteUserSale(id: string) {
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
          .deleteUserSale(id).subscribe({
            next: (res) => {
              Swal.fire(
                'Eliminado!',
                'Tu registro ha sido eliminado.',
                'success'
              )
              this.getUserSales(this.userId);
            }
          })
      }
    })
  }

  setMessageSuccess(message: string) {
    Swal.fire({
      icon: 'success',
      title: `${message}`,
      showConfirmButton: false,
      timer: 1500
    })
  }

  /*
   * On destroy
   */
  ngOnDestroy(): void {
    // Unsubscribe from all subscriptions
    this._unsubscribeAll.next();
    this._unsubscribeAll.complete();
  }



  // helpers for View
  isControlValid(controlName: string): boolean {
    const control = this.editForm.controls[controlName];
    return control.valid && (control.dirty || control.touched);
  }

  isControlInvalid(controlName: string): boolean {
    const control = this.editForm.controls[controlName];
    return control.invalid && (control.dirty || control.touched);
  }

  controlHasError(validation: string, controlName: string) {
    const control = this.editForm.controls[controlName];
    return control.hasError(validation) && (control.dirty || control.touched);
  }

  isControlTouched(controlName: string): boolean {
    const control = this.editForm.controls[controlName];
    return control.dirty || control.touched;
  }
}

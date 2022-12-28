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
@Component({
  selector: 'app-sales-edit',
  templateUrl: './sales-edit.component.html',
  styleUrls: ['./sales-edit.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class SalesEditComponent implements OnInit, OnDestroy {
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
  branchList: any[];
  /**
   * Constructor
   *
   * @param {Router} router
   * @param {UserEditService} _userEditService
   */
  constructor(private cdr: ChangeDetectorRef, private _service: SalesService, private router: Router, private fb: FormBuilder, private activatedRoute: ActivatedRoute) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
  }

  // Public Methods
  // -----------------------------------------------------------------------------------------------------

  initForm() {
    this.editForm = this.fb.group({
      branch_id: [
        this.itemModel.branch_id,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      sequential_init: [
        this.itemModel.sequential_init,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      description: [
        this.itemModel.description,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      is_apply_invoice: [
        this.itemModel.is_apply_invoice,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      code: [
        this.itemModel.code,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ]
    });
  }

  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------
  /**
   * On init
   */
  ngOnInit(): void {
    this.itemModel = new Sales();
    this.itemModel.clear();
    this.initForm();
    this.getBranch();
    this.setHeader("Nueva", '../../sale/list');
    this.activatedRoute.params.subscribe((params) => {
      const id = params.id;
      if (id && id.length > 0) {
        this.setHeader("Editar", '../../list');
        this._service.getSaleId(id).subscribe(
          (item: any) => {
            if (item) {
              this.itemModel = item;
              this.initForm();
              this.cdr.detectChanges();
            }
          },
          (error) => { },
          () => { }
        );
      }
    });
  }

  setHeader(title: string, url: string) {
    this.contentHeader = {
      headerTitle: title + " punto de venta",
      actionButton: true,
      breadcrumb: {
        type: "",
        links: [
          {
            name: "Registros",
            isLink: true,
            link: url,
          },
        ],
      },
    };
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
    const editedItem = this.prepareItem();
    if (this.itemModel.id) {
      this.updateItem(editedItem);
      return;
    }
    this.addItem(editedItem);
  }

  updateItem(_item: Sales) {
    const sbUpdate = this._service.update(_item).pipe(
      catchError((errorMessage) => {
        if (errorMessage.status == 422) {
          const validationErrors = errorMessage.error.errors;
          Object.keys(validationErrors).forEach(prop => {
            const formControl = this.editForm.get(prop);
            if (formControl) {
              formControl.setErrors({
                serverError: validationErrors[prop]
              })
            }
          }
          )
        }
        this.loading = false;
        this.cdr.detectChanges();
        return of(null);
      }),
    ).subscribe((res: any) => {
      if (res) {
        this.goBackWithout();
        this.setMessageSuccess("Actualizado Correctamente")
      }
    });
    this.subscriptions.push(sbUpdate);
  }

  addItem(_item: Sales) {
    const sbCreate = this._service.create(_item).pipe(
      catchError((errorMessage) => {
        console.log(errorMessage);
        if (errorMessage.status == 422) {
          const validationErrors = errorMessage.error.errors;
          Object.keys(validationErrors).forEach(prop => {
            const formControl = this.editForm.get(prop);
            if (formControl) {
              formControl.setErrors({
                serverError: validationErrors[prop]
              })
            }
          }
          )
        }
        this.loading = false;
        this.cdr.detectChanges();
        return of(null);
      })
    ).subscribe((res: any) => {
      if (res) {
        this.goBackWithout();
        this.setMessageSuccess("Guardado Correctamente")
      }
    });
    this.subscriptions.push(sbCreate);
  }

  setMessageSuccess(message: string) {
    Swal.fire({
      icon: 'success',
      title: `${message}`,
      showConfirmButton: false,
      timer: 1500
    })
  }

  goBackWithout() {
    console.log("goBackWithout...");
    this.router.navigate(['/manager/sales/list'], { relativeTo: this.activatedRoute });
  }

  prepareItem(): Sales {
    const controls = this.editForm.controls;
    const _item = new Sales();
    _item.clear();
    if (this.itemModel.id) {
      _item.id = this.itemModel.id;
    }
    _item.sequential_init = controls["sequential_init"].value;
    _item.branch_id = controls["branch_id"].value;
    _item.description = controls["description"].value;
    _item.is_apply_invoice = controls["is_apply_invoice"].value;
    _item.code = controls["code"].value;
    return _item;

  }

  getBranch() {
    this._service.getBranch().subscribe(res => {
      if (res) {
        this.branchList = res;
      }
    }
      , err => {
        console.log("Estatus: ", err);
      }
    );
  }


  /**
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

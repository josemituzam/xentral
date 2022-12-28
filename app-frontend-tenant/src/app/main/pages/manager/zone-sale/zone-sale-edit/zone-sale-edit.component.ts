import { Component, OnInit, OnDestroy, ViewEncapsulation, ChangeDetectorRef } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { ZoneSale } from 'core/models/manager/zone-sale.model';
import { Subject, of, Subscription, Observable } from 'rxjs';
import { catchError, delay, finalize, tap } from 'rxjs/operators';
import Swal from 'sweetalert2'
import { ZoneSaleService } from 'core/services/manager/zone-sale.service';
@Component({
  selector: 'app-zone-sale-edit',
  templateUrl: './zone-sale-edit.component.html',
  styleUrls: ['./zone-sale-edit.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class ZoneSaleEditComponent implements OnInit, OnDestroy {
  // Public
  public url = this.router.url;
  public urlLastValue;
  public rows;
  public currentRow;
  public tempRow;
  public contentHeader: object
  editForm: FormGroup;
  itemModel: ZoneSale;
  private _unsubscribeAll: Subject<any>;
  loading = false;
  subscriptions: Subscription[] = [];
  /**
   * Constructor
   *
   * @param {Router} router
   * @param {UserEditService} _userEditService
   */
  constructor(private cdr: ChangeDetectorRef, private _service: ZoneSaleService, private router: Router, private fb: FormBuilder, private activatedRoute: ActivatedRoute) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
  }

  // Public Methods
  // -----------------------------------------------------------------------------------------------------

  initForm() {
    this.editForm = this.fb.group({
      name: [
        this.itemModel.name,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      code: [
        this.itemModel.code,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
    });
  }

  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------
  /**
   * On init
   */
  ngOnInit(): void {
    this.itemModel = new ZoneSale();
    this.itemModel.clear();
    this.initForm();
    this.setHeader("Nueva", '../../zone-sale/list');
    this.activatedRoute.params.subscribe((params) => {
      const id = params.id;
      if (id && id.length > 0) {
        this.setHeader("Editar", '../../list');
        this._service.getZoneSaleId(id).subscribe(
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
      headerTitle: title + " zona comercial",
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

  updateItem(_item: ZoneSale) {
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

  addItem(_item: ZoneSale) {
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
    this.router.navigate(['/manager/zone-sale/list'], { relativeTo: this.activatedRoute });
  }

  prepareItem(): ZoneSale {
    const controls = this.editForm.controls;
    const _item = new ZoneSale();
    _item.clear();
    if (this.itemModel.id) {
      _item.id = this.itemModel.id;
    }
    _item.name = controls["name"].value;
    _item.code = controls["code"].value;
    return _item;

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

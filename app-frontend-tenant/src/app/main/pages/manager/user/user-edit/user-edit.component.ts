import { Component, OnInit, OnDestroy, ViewEncapsulation, ViewChild, ChangeDetectorRef } from '@angular/core';
import { NgForm } from '@angular/forms';
import { NgbNavChangeEvent } from "@ng-bootstrap/ng-bootstrap";
import { FlatpickrOptions } from 'ng2-flatpickr';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { UserDetail } from 'core/models/manager/user-detail.model';
import { ActivatedRoute, Router } from '@angular/router';
import { UserDetailService } from 'core/services/manager/user-detail.service';
import { catchError, delay, finalize, tap } from 'rxjs/operators';
import { Subject, of, Subscription, Observable } from 'rxjs';
import { SearchCountryField, CountryISO, PhoneNumberFormat } from 'ngx-intl-tel-input';
import Swal from 'sweetalert2'
@Component({
  selector: 'app-user-edit',
  templateUrl: './user-edit.component.html',
  styleUrls: ['./user-edit.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class UserEditComponent implements OnInit, OnDestroy {
  // Public
  active;
  public url = this.router.url;
  public urlLastValue;
  public rows;
  public currentRow;
  public tempRow;
  public contentHeader: object
  editForm: FormGroup;
  itemModel: UserDetail;
  loading = false;
  public getTypeIdentification: any = [
    { id: 'IDE', name: 'Cédula' },
    { id: 'PTE', name: 'Pasaporte / Identificación tributaria el exterior' },
    { id: 'RUC', name: 'RUC' }];
  public typeIdentificator = 'RUC'
  // Private
  private _unsubscribeAll: Subject<any>;
  subscriptions: Subscription[] = [];
  separateDialCode = true;
  SearchCountryField = SearchCountryField;
  CountryISO = CountryISO;
  PhoneNumberFormat = PhoneNumberFormat;

  preferredCountries: CountryISO[] = [CountryISO.UnitedStates,
  CountryISO.UnitedKingdom];
  /**
   * Constructor
   *
   * @param {Router} router
   * @param {UserEditService} _userEditService
   */
  constructor(private _service: UserDetailService, private cdr: ChangeDetectorRef, private activatedRoute: ActivatedRoute, private router: Router, private fb: FormBuilder) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
  }


  onNavChange(changeEvent: NgbNavChangeEvent) {
    if (changeEvent.nextId === 1) {
      let currentUrl = this.router.url;
      this.router.navigateByUrl("/", { skipLocationChange: true }).then(() => {
        this.router.navigate([currentUrl]);
      });
    }
    if (changeEvent.nextId === 2) {
      this.cdr.detectChanges();
    }
  }

  // Public Methods
  // -----------------------------------------------------------------------------------------------------
  initForm() {
    this.editForm = this.fb.group({
      firstname: [
        this.itemModel.firstname,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      lastname: [
        this.itemModel.lastname,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      type_identification: [
        this.itemModel.type_identification,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      identification: [
        this.itemModel.identification,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      birthday_at: [
        this.itemModel.birthday_at,
        Validators.compose([Validators.maxLength(100)]),
      ],
      phone: [
        this.itemModel.phone,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      address: [
        this.itemModel.address,
        Validators.compose([Validators.maxLength(100)]),
      ],
      email: [this.itemModel.email,
      Validators.compose([Validators.required, Validators.maxLength(100), Validators.email])],
      cant_extra_time: [
        this.itemModel.cant_extra_time,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      day_extra_time: [
        this.itemModel.day_extra_time,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      zone_sale_id: [
        this.itemModel.zone_sale_id,
        Validators.compose([Validators.maxLength(100)]),
      ],
      description: [
        this.itemModel.description,
        Validators.compose([Validators.maxLength(250)]),
      ],
    });
  }


  updateItem(_item: UserDetail) {
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
    this.router.navigate(['/manager/user/list'], { relativeTo: this.activatedRoute });
  }

  addItem(_item: UserDetail) {
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
        this.router.navigate(["/manager/user/edit/", res?.obj?.id], {
          relativeTo: this.activatedRoute,
        });
        this.setMessageSuccess("Guardado Correctamente")
        this.cdr.detectChanges();

        // this.goBackWithout();

      }
    });
    this.subscriptions.push(sbCreate);
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


  prepareItem(): UserDetail {
    const controls = this.editForm.controls;
    const _item = new UserDetail();
    _item.clear();
    if (this.itemModel.id) {
      _item.id = this.itemModel.id;
    }
    _item.firstname = controls["firstname"].value;
    _item.lastname = controls["lastname"].value;
    _item.type_identification = controls["type_identification"].value;
    _item.identification = controls["identification"].value;
    _item.birthday_at = controls["birthday_at"].value;
    _item.phone = controls["phone"].value;
    _item.address = controls["address"].value;
    _item.email = controls["email"].value;
    _item.cant_extra_time = controls["cant_extra_time"].value;
    _item.day_extra_time = controls["day_extra_time"].value;
    _item.zone_sale_id = controls["zone_sale_id"].value;
    _item.description = controls["description"].value;
    return _item;
  }

  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------
  /**
   * On init
   */
  ngOnInit(): void {
    this.itemModel = new UserDetail();
    this.itemModel.clear();
    this.initForm();
    this.getZoneSale();
    this.setHeader("Nuevo", '../../user/list');
    this.activatedRoute.params.subscribe((params) => {
      const id = params.id;
      if (id && id.length > 0) {
        this.setHeader("Editar", '../../list');
        this._service.getUserId(id).subscribe(
          (item: any) => {
            if (item) {
              this.itemModel = item;
              this.itemModel.phone = JSON.parse(item.phone)?.nationalNumber;
              this.itemModel.email = item?.get_user.email;
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
      headerTitle: title + " usuario",
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

  zoneSaleList: any[];
  getZoneSale() {
    this._service.getZoneSale().subscribe(res => {
      if (res) {
        this.zoneSaleList = res;
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

import { Component, OnInit, OnDestroy, ViewEncapsulation, ChangeDetectorRef, AfterViewInit } from '@angular/core';
import { Router } from '@angular/router';
import { Company } from 'core/models/manager/company.model';
import { Subject, of, Subscription, Observable } from 'rxjs';
import {
  FormArray,
  FormBuilder,
  FormControl,
  FormGroup,
  Validators,
} from '@angular/forms';
import Swal from 'sweetalert2';
import { catchError, delay, finalize, tap } from 'rxjs/operators';
import { CompanyService } from 'core/services/manager/company.service';
import { SearchCountryField, CountryISO, PhoneNumberFormat } from 'ngx-intl-tel-input';
@Component({
  selector: 'app-company',
  templateUrl: './company.component.html',
  styleUrls: ['./company.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class CompanyComponent implements OnInit, OnDestroy, AfterViewInit {
  // Public
  separateDialCode = true;
  SearchCountryField = SearchCountryField;
  CountryISO = CountryISO;
  PhoneNumberFormat = PhoneNumberFormat;

  preferredCountries: CountryISO[] = [CountryISO.UnitedStates,
  CountryISO.UnitedKingdom];

  separateDialCode2 = true;
  SearchCountryField2 = SearchCountryField;
  CountryISO2 = CountryISO;
  PhoneNumberFormat2 = PhoneNumberFormat;

  preferredCountries2: CountryISO[] = [CountryISO.UnitedStates,
  CountryISO.UnitedKingdom];
  /////
  public url = this.router.url;
  public urlLastValue;
  public rows;
  public currentRow;
  public tempRow;
  loading = false;
  editForm: FormGroup;
  itemModel: Company;
  private _unsubscribeAll: Subject<any>;
  subscriptions: Subscription[] = [];
  public getTypeIdentification: any = [
    { id: 'IDE', name: 'Cédula' },
    { id: 'PTE', name: 'Pasaporte / Identificación tributaria el exterior' },
    { id: 'RUC', name: 'RUC' }];
  public typeIdentificator = 'RUC'
  // Private

  /**
   * Constructor
   *
   * @param {Router} router
   * @param {UserEditService} _userEditService
   */
  constructor(
    private fb: FormBuilder,
    private cdr: ChangeDetectorRef,
    private router: Router,
    private _service: CompanyService
  ) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
  }

  // Public Methods
  // -----------------------------------------------------------------------------------------------------


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
    this.updateItem(editedItem);
  }


  updateItem(_item: Company) {
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
        this.loading = false;
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

  prepareItem(): Company {
    const controls = this.editForm.controls;
    const _item = new Company();
    _item.clear();
    _item.id = this.itemModel.id;
    _item.name_company = controls["name_company"].value;
    _item.name_commercial = controls["name_commercial"].value;
    _item.type_identification = controls["type_identification"].value;
    _item.identification = controls["identification"].value;
    _item.is_accounting = controls["is_accounting"].value;
    _item.is_special = controls["is_special"].value;
    _item.address = controls["address"].value;
    _item.phone_principal = controls["phone_principal"].value;
    _item.phone_secondary = controls["phone_secondary"].value;
    _item.break_day = controls["break_day"].value;
    _item.decimal = controls["decimal"].value;
    _item.google_key = controls["google_key"].value;
    return _item;
  }

  // Public Methods
  // -----------------------------------------------------------------------------------------------------

  initForm() {
    this.editForm = this.fb.group({
      name_company: [
        this.itemModel?.name_company,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      name_commercial: [
        this.itemModel?.name_commercial,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      type_identification: [
        this.itemModel?.type_identification,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      identification: [
        this.itemModel?.identification,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      is_accounting: [
        this.itemModel?.is_accounting,
      ],
      is_special: [
        this.itemModel?.is_special,
      ],
      address: [
        this.itemModel?.address,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      phone_principal: [
        this.itemModel?.phone_principal,
        Validators.compose([Validators.required, Validators.maxLength(10)]),
      ],
      phone_secondary: [
        this.itemModel?.phone_secondary,
        Validators.compose([Validators.maxLength(100)]),
      ],
      break_day: [
        this.itemModel?.break_day,
        Validators.compose([Validators.required]),
      ],
      decimal: [
        this.itemModel?.decimal,
        Validators.compose([Validators.required]),
      ],
      google_key: [
        this.itemModel?.google_key,
        Validators.compose([Validators.required]),
      ],
    });
  }

  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------
  /**
   * On init
   */
  ngAfterViewInit(): void {



  }
  selectAddTagMethod(name) {
    return { id: '0', name: name };
  }
  public beakList = [
    { id: '0', name: 'Con cierre de tickets' },
    { id: '1', name: '1' },
    { id: '2', name: '2' },
    { id: '3', name: '3' },
    { id: '4', name: '4' },
    { id: '5', name: '5' },
    { id: '6', name: '6' },
    { id: '7', name: '7' },
    { id: '8', name: '8' },
    { id: '9', name: '9' },
    { id: '10', name: '10' },
    { id: '11', name: '11' },
    { id: '12', name: '12' },
    { id: '13', name: '13' },
    { id: '14', name: '14' },
    { id: '15', name: '15' },
    { id: '16', name: '16' },
    { id: '17', name: '17' },
    { id: '18', name: '18' },
    { id: '19', name: '19' },
    { id: '20', name: '20' },
    { id: '21', name: '21' },
    { id: '22', name: '22' },
    { id: '23', name: '23' },
    { id: '24', name: '24' },
    { id: '25', name: '25' },
    { id: '26', name: '26' },
    { id: '27', name: '27' },
    { id: '28', name: '28' },
    { id: '29', name: '29' },
    { id: '30', name: '30' },
    { id: '31', name: '31' }
  ];

  ngOnInit(): void {
    this.itemModel = new Company();
    this.itemModel.clear();
    this.initForm();
    this._service.getCompany().subscribe(
      (item: any) => {
        if (item) {
          this.itemModel = item;
          this.itemModel.phone_principal = JSON.parse(item.phone_principal)?.nationalNumber;
          this.itemModel.phone_secondary = JSON.parse(item.phone_secondary)?.nationalNumber;
          this.initForm();
        }
      },
      (error) => { console.log(error) },
      () => { }
    );
    this.cdr.detectChanges();
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

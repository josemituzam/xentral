import { Component, OnInit, OnDestroy, ViewEncapsulation, ViewChild, ChangeDetectorRef } from '@angular/core';
import { Router } from '@angular/router';
import {
  FormArray,
  FormBuilder,
  FormControl,
  FormGroup,
  Validators,
} from '@angular/forms';
import { DatePipe } from '@angular/common';
import { Subject, of, Subscription } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { FlatpickrOptions } from 'ng2-flatpickr';
import { cloneDeep } from 'lodash';
import { catchError, delay, finalize, tap } from 'rxjs/operators';
import { repeaterAnimation } from './form-repeater.animation';

import { SearchCountryField, CountryISO, PhoneNumberFormat } from 'ngx-intl-tel-input';
import { IspCustomerService } from 'core/services/ispcustomer.service';
import { IspCustomer } from 'core/models/ispcustomer.model';


@Component({
  selector: 'app-customer-edit',
  templateUrl: './customer-edit.component.html',
  styleUrls: ['./customer-edit.component.scss'],
  encapsulation: ViewEncapsulation.None,
  animations: [repeaterAnimation]
})
export class CustomerEditComponent implements OnInit, OnDestroy {

  separateDialCode = true;
  SearchCountryField = SearchCountryField;
  CountryISO = CountryISO;
  PhoneNumberFormat = PhoneNumberFormat;

  preferredCountries: CountryISO[] = [CountryISO.UnitedStates,
  CountryISO.UnitedKingdom];


  // Public
  public url = this.router.url;
  public activeMovField = true;
  public urlLastValue;
  public rows;
  public currentRow;
  public tempRow;
  public avatarImage: string;
  public contentHeader: object
  public loading = false;
  public typePeople = 'PN';
  public typeIdentificator = 'IDE'
  public typeNumber = 'MOV'
  public myYear = 0;
  public activeField = false;
  public titleName = 'Nombres';
  public titleNumber = 'Móvil';
  public titleStartedAt = 'Fecha de nacimiento';

  startDate: string;
  endDate: string;
  maxDate: string;

  editForm: FormGroup;
  itemModel: IspCustomer;

  //@ViewChild('accountForm') accountForm: NgForm;

  public birthDateOptions: FlatpickrOptions = {
    altInput: true
  };

  subscriptions: Subscription[] = [];

  public selectMultiLanguages = ['English', 'Spanish', 'French', 'Russian', 'German', 'Arabic', 'Sanskrit'];
  public selectMultiLanguagesSelected = [];


  public getTypePeople: any = [
    { id: 'PN', name: 'Persona Natural' },
    { id: 'PJ', name: 'Persona Jurídica' },
  ];

  public getTypeIdentification: any = [{ id: 'IDE', name: 'Cédula' },
  { id: 'PTE', name: 'Pasaporte / Identificación tributaria el exterior' }];

  public getTypeNumber: any = [{ id: 'FIJ', name: 'Fijo' },
  { id: 'MOV', name: 'Móvil' }];


  public getTypeGender: any = [
    { id: 'MAS', name: 'Másculino' },
    { id: 'FEM', name: 'Femenino' },
    { id: 'NAN', name: 'N/a' },
  ];




  // Private
  private _unsubscribeAll: Subject<any>;

  /**
   * Constructor
   *
   * @param {Router} router
   * @param {UserEditService} _userEditService
   */
  constructor(private datePipe: DatePipe, private router: Router, private fb: FormBuilder, private cdr: ChangeDetectorRef, private _service: IspCustomerService) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
  }

  // Public Methods
  // -----------------------------------------------------------------------------------------------------

  /**
   * Reset Form With Default Values
   */
  resetFormWithDefaultValues() {
    //this.accountForm.resetForm(this.tempRow);
  }

  initForm() {
    this.editForm = this.fb.group({
      type_people: [
        this.itemModel.type_people
      ],
      type_identification: [
        this.itemModel.type_identification
      ],
      identification: [
        this.itemModel.identification
      ],
      name_company: [
        this.itemModel.name_company
      ],
      firstname: [
        this.itemModel.firstname
      ],
      lastname: [
        this.itemModel.lastname
      ],
      started_at: [
        this.itemModel.started_at
      ],
      type_gender: [
        this.itemModel.type_gender
      ],
      address: [
        this.itemModel.address
      ],

      type_number: [
        this.itemModel.type_number
      ],
      phone_movil: [
        this.itemModel.phone_movil
      ],

      phone_fixed: [
        this.itemModel.phone_fixed
      ],
      email: [
        this.itemModel.email,
        Validators.compose([Validators.maxLength(100), Validators.email]),
      ],
      is_accounting: [
        this.itemModel.is_accounting
      ],
      is_disability: [
        this.itemModel.is_disability
      ],
      is_old: [
        this.itemModel.is_old
      ],
      is_bond: [
        this.itemModel.is_bond
      ],
      firstname_representative: [
        this.itemModel.firstname_representative
      ],

      lastname_representative: [
        this.itemModel.lastname_representative
      ],
      phone_representative: [
        this.itemModel.phone_representative
      ],
      contacts: this.fb.array([]),
    });
  }

  prepareItem(): IspCustomer {
    const controls = this.editForm.controls;
    const _item = new IspCustomer();
    _item.clear();
    _item.type_people = controls["type_people"].value;
    _item.type_identification = controls["type_identification"].value;
    _item.identification = controls["identification"].value;
    _item.name_company = controls["name_company"].value;
    _item.firstname = controls["firstname"].value;
    _item.lastname = controls["lastname"].value;
    _item.started_at = controls["started_at"].value;
    _item.type_gender = controls["type_gender"].value;
    _item.address = controls["address"].value;
    _item.type_number = controls["type_number"].value;
    _item.phone_movil = controls["phone_movil"].value;
    _item.phone_fixed = controls["phone_fixed"].value;
    _item.email = controls["email"].value;
    _item.is_accounting = controls["is_accounting"].value;
    _item.is_disability = controls["is_disability"].value;
    _item.is_old = controls["is_old"].value;
    _item.is_bond = controls["is_bond"].value;
    _item.firstname_representative = controls["firstname_representative"].value;
    _item.lastname_representative = controls["lastname_representative"].value;
    _item.phone_representative = controls["phone_representative"].value;
    return _item;
  }

  changeTypeNumber($event) {
    console.log($event);
    if ($event.id == 'MOV') {
      this.titleNumber = 'Móvil';
      this.activeMovField = true;
    } else {
      this.titleNumber = 'Fijo';
      this.activeMovField = false;
      this.editForm.controls['phone_fixed'].setValue(null);
    }

  }

  changeTypePeople($event) {
    this.getTypeIdentification = [];

    if ($event.id == 'PN') {
      this.typeIdentificator = 'IDE';
      this.titleStartedAt = 'Fecha de nacimiento';
      this.titleName = 'Nombres';
      this.getTypeIdentification.push({ id: 'IDE', name: 'Cédula' },
        { id: 'PTE', name: 'Pasaporte / Identificación tributaria el exterior' });
      this.activeField = false;
    } else {
      this.titleStartedAt = 'Fecha de creación';
      this.typeIdentificator = 'RUC';
      this.titleName = 'Razón social';
      this.getTypeIdentification.push({ id: 'RUC', name: 'RUC' });
      this.activeField = true;
    }
    this.itemModel.clear();
    this.cdr.detectChanges();
  }


  addRecord() {
    const item = this.fb.group({
      contact: '',
      parent: '',
      value_email: '',
      value_phone: '',
    });
    this.contacts.push(item);
  }

  removeItem(i: number) {
    this.contacts.removeAt(i);
  }

  get contacts() {
    return this.editForm.controls['contacts'] as FormArray;
  }

  /**
   * Upload Image
   *
   * @param event
   */
  uploadImage(event: any) {

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
    /* if (this.id) {
       // this.updateItem(editedItem);
       return;
     }*/
    this.addItem(editedItem);
  }

  addItem(_item: IspCustomer) {

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
        this.loading = false;
      }
    });
    this.subscriptions.push(sbCreate);
  }

  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------
  /**
   * On init
   */
  ngOnInit(): void {
    this.contentHeader = {
      headerTitle: 'Crear cliente',
      actionButton: true,
      breadcrumb: {
        type: '',
        links: [
          {
            name: 'Registros',
            isLink: true,
            link: '../../customer/list'
          },
        ]
      }
    };
    const dateFormat = 'yyyy-MM-dd';
    this.maxDate = this.endDate = this.datePipe.transform(new Date(), dateFormat);

    this.itemModel = new IspCustomer();
    this.itemModel.clear();
    this.initForm();
    this.addRecord();
  }

  getDate(): void {
    var started_at = this.editForm.get('started_at').value;
    var dateFormat = 'yyyy-MM-dd';
    var today_at = this.datePipe.transform(new Date(), dateFormat);
    var fechaInicio = new Date(started_at).getTime();
    var fechaFin = new Date(today_at).getTime();
    var diff = fechaFin - fechaInicio;
    this.myYear = Math.round((diff / (1000 * 60 * 60 * 24)) / 365);
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

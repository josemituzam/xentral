import { Component, OnInit, OnDestroy, ViewEncapsulation, ViewChild, ChangeDetectorRef } from '@angular/core';
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
import { ActivatedRoute, Router, NavigationEnd } from '@angular/router';
import { SearchCountryField, CountryISO, PhoneNumberFormat } from 'ngx-intl-tel-input';
import { IspCustomerService } from 'core/services/ispcustomer.service';
import { IspCustomer } from 'core/models/ispcustomer.model';
import { NgbNavChangeEvent } from '@ng-bootstrap/ng-bootstrap';
import Swal from 'sweetalert2'
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

  separateDialCode2 = true;
  SearchCountryField2 = SearchCountryField;
  CountryISO2 = CountryISO;
  PhoneNumberFormat2 = PhoneNumberFormat;

  preferredCountries2: CountryISO[] = [CountryISO.UnitedStates,
  CountryISO.UnitedKingdom];

  // Public
  public active = 1;
  public url = this.router.url;
  public activeMovField = true;
  public urlLastValue;
  public rows;
  public currentRow;
  public tempRow;
  public avatarImage: string;
  public contentHeader: object
  public loading = false;
  public loadingWith = false;
  public typePeople = 'PN';
  public typeIdentificator = 'IDE'
  public typeNumber = 'MOV'
  public myYear = 0;
  public activeField = false;
  public titleName = 'Nombres';
  public titleNumber = 'Móvil';
  public titleStartedAt = 'Fecha de nacimiento';
  public refresh = false;
  public activeMovFieldContact = true;
  startDate: string;
  endDate: string;
  maxDate: string;
  editForm: FormGroup;
  itemModel: IspCustomer;
  subscriptions: Subscription[] = [];

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
  constructor(private datePipe: DatePipe, private activatedRoute: ActivatedRoute, private router: Router, private fb: FormBuilder, private cdr: ChangeDetectorRef, private _service: IspCustomerService) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
  }

  initForm() {
    if (this.activeField == false) {
      this.editForm = this.fb.group({
        type_people: [
          this.itemModel.type_people,
          Validators.compose([Validators.required]),
        ],
        type_identification: [
          this.itemModel.type_identification,
          Validators.compose([Validators.required]),
        ],
        identification: [
          this.itemModel.identification,
          Validators.compose([Validators.required]),
        ],
        firstname: [
          this.itemModel.firstname,
          Validators.compose([Validators.required]),
        ],
        lastname: [
          this.itemModel.lastname,
          Validators.compose([Validators.required]),
        ],
        started_at: [
          this.itemModel.started_at
        ],
        type_gender: [
          this.itemModel.type_gender,
          Validators.compose([Validators.required]),
        ],
        address: [
          this.itemModel.address
        ],
        type_number: [
          this.itemModel.type_number,
          Validators.compose([Validators.required]),
        ],
        phone: [
          this.itemModel.phone,
          Validators.compose([Validators.required]),
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
      });
    } else {
      this.editForm = this.fb.group({
        type_people: [
          this.itemModel.type_people,
          Validators.compose([Validators.required]),
        ],
        type_identification: [
          this.itemModel.type_identification,
          Validators.compose([Validators.required]),
        ],
        identification: [
          this.itemModel.identification,
          Validators.compose([Validators.required]),
        ],
        name_company: [
          this.itemModel.name_company,
          Validators.compose([Validators.required]),
        ],

        started_at: [
          this.itemModel.started_at
        ],
        address: [
          this.itemModel.address,
          Validators.compose([Validators.required]),
        ],
        type_number: [
          this.itemModel.type_number,
          Validators.compose([Validators.required]),
        ],
        phone: [
          this.itemModel.phone,
          Validators.compose([Validators.required]),
        ],
        email: [
          this.itemModel.email,
          Validators.compose([Validators.maxLength(100), Validators.email]),
        ],
        is_accounting: [
          this.itemModel.is_accounting
        ],
        firstname_representative: [
          this.itemModel.firstname_representative,
          Validators.compose([Validators.required]),
        ],

        lastname_representative: [
          this.itemModel.lastname_representative,
          Validators.compose([Validators.required]),
        ],
        phone_representative: [
          this.itemModel.phone_representative,
          Validators.compose([Validators.required]),
        ],
      });
    }
  }


  onNavChange(changeEvent: NgbNavChangeEvent) {
    console.log(changeEvent.nextId);
    if (changeEvent.nextId == 2) {
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
        changeEvent.preventDefault();
        this.cdr.detectChanges();
        return;
      }
      const editedItem = this.prepareItem();
      this.addItem(editedItem, false, false);
    }
  }


  prepareItem(): IspCustomer {
    const controls = this.editForm.controls;
    const _item = new IspCustomer();
    _item.clear();
    if (this.activeField == false) {
      _item.type_people = controls["type_people"].value;
      _item.type_identification = controls["type_identification"].value;
      _item.identification = controls["identification"].value;
      _item.firstname = controls["firstname"].value;
      _item.lastname = controls["lastname"].value;
      _item.started_at = controls["started_at"].value;
      _item.type_gender = controls["type_gender"].value;
      _item.address = controls["address"].value;
      _item.type_number = controls["type_number"].value;
      _item.phone = controls["phone"].value;
      _item.email = controls["email"].value;
      _item.is_accounting = controls["is_accounting"].value;
      _item.is_disability = controls["is_disability"].value;
      _item.is_old = controls["is_old"].value;
      _item.is_bond = controls["is_bond"].value;
      return _item;
    } else {
      if (this.activeField == true) {
        _item.type_people = controls["type_people"].value;
        _item.type_identification = controls["type_identification"].value;
        _item.identification = controls["identification"].value;
        _item.name_company = controls["name_company"].value;
        _item.started_at = controls["started_at"].value;
        _item.address = controls["address"].value;
        _item.type_number = controls["type_number"].value;
        _item.phone = controls["phone"].value;
        _item.email = controls["email"].value;
        _item.is_accounting = controls["is_accounting"].value;
        _item.firstname_representative = controls["firstname_representative"].value;
        _item.lastname_representative = controls["lastname_representative"].value;
        _item.phone_representative = controls["phone_representative"].value;
        return _item;
      }
    }
  }

  changeTypeNumber($event) {
    if ($event.id == 'MOV') {
      this.titleNumber = 'Móvil';
      this.activeMovField = true;
    } else {
      this.titleNumber = 'Fijo';
      this.activeMovField = false;
    }
    this.editForm.controls['phone'].setValue(null);
  }

  changeTypePeople($event) {
    this.getTypeIdentification = [];
    this.refresh = true;
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
    this.initForm();
    setTimeout(() => this.refresh = false, 1500);
    this.cdr.detectChanges();
  }


  /**
   * Submit
   *
   * @param form
   */
  submit(withBack: boolean = false, back: boolean = false) {

    if (back == true) {
      this.loading = true;
    } else {
      this.loadingWith = true;
    }

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
      this.loadingWith = false;
      this.loading = false;
      this.cdr.detectChanges();
      return;
    }
    const editedItem = this.prepareItem();
    this.addItem(editedItem, withBack, back);
  }

  addItem(_item: IspCustomer, withBack: boolean = false, back: boolean = false) {

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
        this.loadingWith = false;
        this.cdr.detectChanges();
        return of(null);
      })
    ).subscribe((res: any) => {
      if (res) {
        console.log(res);
        this.itemModel = res.obj;
        this.loading = false;
        this.loadingWith = false;
        this.setMessageSuccess("Guardado Correctamente")
        if (back) {
          console.log("si tiene back");
          this.goBackWithout();
          return;
        }
        if (withBack) {
          console.log("si tiene withBack");
          this.refreshItem();
          return;
        }
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
    this.router.navigate(['/isp/customer/list'], { relativeTo: this.activatedRoute });
  }


  refreshItem() {
    let url = this.router.url;
    this.editForm.reset();
    url = `/isp/customer/add`;
    this.router.navigate([url], { relativeTo: this.activatedRoute });
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

import { Component, OnInit, OnDestroy, ViewEncapsulation, ViewChild, ChangeDetectorRef, Input } from '@angular/core';
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
import { catchError, delay, finalize, tap } from 'rxjs/operators';
import { repeaterAnimation } from '../customer-edit/form-repeater.animation';

import { SearchCountryField, CountryISO, PhoneNumberFormat } from 'ngx-intl-tel-input';
import { IspCustomerService } from 'core/services/isp/commercial/ispcustomer.service';
import { IspCustomer } from 'core/models/isp/commercial/ispcustomer.model';


@Component({
  selector: 'app-customer-contact',
  templateUrl: './customer-contact.component.html',
  styleUrls: ['./customer-contact.component.scss'],
  encapsulation: ViewEncapsulation.None,
  animations: [repeaterAnimation]
})
export class CustomerContactsComponent implements OnInit, OnDestroy {
  separateDialCode3 = true;
  SearchCountryField3 = SearchCountryField;
  CountryISO3 = CountryISO;
  PhoneNumberFormat3 = PhoneNumberFormat;

  preferredCountries3: CountryISO[] = [CountryISO.UnitedStates,
  CountryISO.UnitedKingdom];

  // Public
  @Input() customerId: string;

  public activeNav = 0;
  public active = 2;
  public url = this.router.url;
  public activeMovField = true;
  public urlLastValue;
  public rows;
  public currentRow;
  public tempRow;
  public avatarImage: string;
  public loading = false;
  public typeNumber = 'MOV'
  public activeField = false;
  public refresh = false;

  public activeMovFieldContact = true;

  startDate: string;
  endDate: string;
  maxDate: string;

  editForm: FormGroup;
  itemModel: IspCustomer;

  subscriptions: Subscription[] = [];

  public getTypeNumber: any = [{ id: 'FIJ', name: 'Fijo' },
  { id: 'MOV', name: 'Móvil' }];






  // Private
  private _unsubscribeAll: Subject<any>;

  /**
   * Constructor
   *
   * @param {Router} router
   * @param {UserEditService} _userEditService
   */
  constructor(private router: Router, private fb: FormBuilder, private cdr: ChangeDetectorRef, private _service: IspCustomerService) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
  }

  // Public Methods
  // -----------------------------------------------------------------------------------------------------

  initForm() {
    this.editForm = this.fb.group({
      type_number: [
        this.itemModel.type_number,
      ],
      contacts: this.fb.array([]),
    });

  }

  prepareItem(): IspCustomer {
    const controls = this.editForm.controls;
    const _item = new IspCustomer();
    _item.clear();
    _item.id = this.customerId;
    _item.contacts = controls["contacts"].value;
    return _item;
  }

  addRecord() {
    const item = this.fb.group({
      name: '',
      name_parent: '',
      email: '',
      phone: '0',
      type_number: 'MOV',
    });
    this.contacts.push(item);
  }


  removeItem(i: number) {
    this.contacts.removeAt(i);
  }

  get contacts() {
    return this.editForm.controls['contacts'] as FormArray;
  }

  changeTypeNumber(i) {
    this.contacts.at(i).get('phone').setValue(null);
  }

  /**
   * Submit
   *
   * @param form
   */
  submit() {
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
    this.addItem(editedItem);
  }

  addItem(_item: any) {
    const sbCreate = this._service.createContactCustomer(_item).pipe(
      catchError((errorMessage) => {
        console.log(errorMessage);
        if (errorMessage.status == 422) {
          const validationErrors = errorMessage.error.errors;
          Object.keys(validationErrors).forEach(prop => {
            const formControl = this.contacts.at(errorMessage.error.isvalid).get(prop);
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
        if (this.customerId) {
          this.getContactCustomer(this.customerId)

        }
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
    this.itemModel = new IspCustomer();
    this.itemModel.clear();
    this.initForm();

    if (this.customerId) {
      this.getContactCustomer(this.customerId);
    } else {
      this.addRecord();
    }

    this.cdr.detectChanges();
  }


  getContactCustomer(id: string) {
    this._service.getContactCustomer(id).subscribe(res => {
      if (res) {
        console.log(res)
        //this.initForm();
        for (let item of res) {
          var phone = JSON.parse(item.phone)
          const obj = this.fb.group({
            name: item.name,
            name_parent: item.name_parent,
            email: item.email,
            phone: typeof JSON.parse(item?.phone) !== "string" ? phone?.number : phone,
            type_number: item.type_number,
          });

          this.contacts.push(obj);
        }

        this.cdr.detectChanges();
        // this.initForm();

        /* this.initForm();
         this.addRecord(); */
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
import { Component, OnInit, OnDestroy, ViewEncapsulation, ViewChild, ChangeDetectorRef, EventEmitter } from '@angular/core';
import {
  FormArray,
  FormBuilder,
  FormControl,
  FormGroup,
  Validators,
} from '@angular/forms';
import Stepper from 'bs-stepper';
import { DatePipe } from '@angular/common';
import { Subject, of, Subscription, Observable, concat, throwError } from 'rxjs';
import { catchError, debounceTime, distinctUntilChanged, switchMap, tap, map, filter } from 'rxjs/operators';
import { FlatpickrOptions } from 'ng2-flatpickr';
import { cloneDeep } from 'lodash';
import { ActivatedRoute, Router, NavigationEnd } from '@angular/router';
import { SearchCountryField, CountryISO, PhoneNumberFormat } from 'ngx-intl-tel-input';
import { IspCustomerService } from 'core/services/isp/commercial/ispcustomer.service';
import { IspCustomer } from 'core/models/isp/commercial/ispcustomer.model';
import Swal from 'sweetalert2'
import { WebcamImage, WebcamInitError, WebcamUtil } from 'ngx-webcam';
import { CropperComponent } from 'angular-cropperjs';
import { NgbModal, NgbNavChangeEvent } from '@ng-bootstrap/ng-bootstrap';
import { CustomerCameraComponent } from '../customer-camera/customer-camera.component';
@Component({
  selector: 'app-customer-create',
  templateUrl: './customer-create.component.html',
  styleUrls: ['./customer-create.component.scss'],
  encapsulation: ViewEncapsulation.None,
})
export class CustomerCreateComponent implements OnInit, OnDestroy {
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


  // Wizard
  private horizontalWizardStepper: Stepper;
  private verticalWizardStepper: Stepper;
  private modernWizardStepper: Stepper;
  private modernVerticalWizardStepper: Stepper;
  private bsStepper;

  public croppedResult = "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png";

  /**
   * Horizontal Wizard Stepper Next
   *
   * @param data
   */
  horizontalWizardStepperNext(data) {
    if (data.form.valid === true) {
      this.horizontalWizardStepper.next();
    }
  }
  /**
   * Horizontal Wizard Stepper Previous
   */
  horizontalWizardStepperPrevious() {
    this.horizontalWizardStepper.previous();
  }

  /**
   * Vertical Wizard Stepper Next
   */
  verticalWizardNext() {
    this.verticalWizardStepper.next();
  }
  // Wizard

  // Public
  public active = 4;
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

  public getTypeIdentification: any = [{ id: 'IDE', name: 'Cédula' }, { id: 'RUC', name: 'RUC' },
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
  constructor(private modalService: NgbModal, private datePipe: DatePipe, private activatedRoute: ActivatedRoute, private router: Router, private fb: FormBuilder, private cdr: ChangeDetectorRef, private _service: IspCustomerService) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
  }


  ///////////////////////////////////////////////////////////
  public loadingValidate = false;
  public disableBtnIdentifier = false;
  setType($event) {
    if ($event.id == 'PTE') {
      this.disableBtnIdentifier = true;
    } else {
      this.disableBtnIdentifier = false;
    }
    this.cdr.detectChanges();
  }


  validateCustomer() {
    this.loadingValidate = true;
    const ide = this.editForm.get('identification').value;
    const type = this.editForm.get('type_identification').value;
    const typePeople = this.editForm.get('type_people').value;
    if (!ide) {

      Swal.fire({
        icon: 'error',
        title: `No se ha digitado nada en el campo de identificación`,
        showConfirmButton: false,
        timer: 1500
      })
      this.loadingValidate = false;
      this.cdr.detectChanges();
      return;

    }
    this._service.validateCustomer(ide, type).subscribe(res => {
      if (res) {
        if (typePeople == 'PN') {

          if (type == 'IDE') {
            if (!res?.data?.error) {
              var fullname = res?.data?.Nombres_y_apellidos;
              var lastnameSplit = fullname?.split(' ', 2)
              var lastname = lastnameSplit.join(' ');
              this.editForm.get("lastname").setValue(lastname);

              var firstnametArray = [];
              var firstnameSplit = fullname?.split(' ');
              for (let i = 2; i < firstnameSplit.length; i++) {
                firstnametArray.push(firstnameSplit[i]);
              }

              var firstname = firstnametArray.join(' ');
              this.editForm.get("firstname").setValue(firstname);
            }
          } else {
            if (!res?.data?.error) {
              var company = res?.data?.main[0];

              var fullname = company?.agenteRepresentante;
              var lastnameSplit = fullname?.split(' ', 2)
              var lastname = lastnameSplit.join(' ');
              this.editForm.get("lastname").setValue(lastname);

              var firstnametArray = [];
              var firstnameSplit = fullname?.split(' ');
              for (let i = 2; i < firstnameSplit.length; i++) {
                firstnametArray.push(firstnameSplit[i]);
              }

              var firstname = firstnametArray.join(' ');
              this.editForm.get("firstname").setValue(firstname);

            }
          }


        } else {

        }



        this.loadingValidate = false;
        this.cdr.detectChanges();
      }
    }
      , err => {
        console.log("Estatus: ", err);
        this.loadingValidate = false;
        this.cdr.detectChanges();
      }
    );

  }

  ///////////////////////////////////////////////////////

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
          Validators.compose([Validators.required, Validators.maxLength(100)]),
        ],
        firstname: [
          this.itemModel.firstname,
          Validators.compose([Validators.required, Validators.maxLength(100)]),
        ],
        lastname: [
          this.itemModel.lastname,
          Validators.compose([Validators.required, Validators.maxLength(100)]),
        ],
        started_at: [
          this.itemModel.started_at,
          Validators.compose([Validators.required]),
        ],
        type_gender: [
          this.itemModel.type_gender,
          Validators.compose([Validators.required]),
        ],
        address: [
          this.itemModel.address,
          Validators.compose([Validators.required, Validators.maxLength(100)]),
        ],
        type_number: [
          this.itemModel.type_number,
          Validators.compose([Validators.required]),
        ],
        phone: [
          this.itemModel.phone,
          Validators.compose([Validators.required, Validators.maxLength(100)]),
        ],
        email: [
          this.itemModel.email,
          Validators.compose([Validators.maxLength(100), Validators.required, Validators.email]),
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
        contentFile: [""],
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
          Validators.compose([Validators.required, Validators.maxLength(100)]),
        ],
        name_company: [
          this.itemModel.name_company,
          Validators.compose([Validators.required, Validators.maxLength(100)]),
        ],

        started_at: [
          this.itemModel.started_at,
          Validators.compose([Validators.required]),
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
          Validators.compose([Validators.required, Validators.maxLength(100)]),
        ],
        email: [
          this.itemModel.email,
          Validators.compose([Validators.maxLength(100), Validators.required, Validators.email]),
        ],
        is_accounting: [
          this.itemModel.is_accounting
        ],
        firstname_representative: [
          this.itemModel.firstname_representative,
          Validators.compose([Validators.required, Validators.maxLength(100)]),
        ],

        lastname_representative: [
          this.itemModel.lastname_representative,
          Validators.compose([Validators.required, Validators.maxLength(100)]),
        ],
        phone_representative: [
          this.itemModel.phone_representative,
          Validators.compose([Validators.required, Validators.maxLength(100)]),
        ],
        contentFile: [""],
      });
    }
  }

  modalCamera() {
    const modalRef = this.modalService.open(CustomerCameraComponent, {
      centered: true,
      backdrop: 'static',
      size: 'lg' // size: 'xs' | 'sm' | 'lg' | 'xl'
    });

    modalRef.result.then((result) => {
      if (result) {
        this.croppedResult = result;
        this.editForm.get("contentFile").setValue(result);
      }
    });
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
      console.log(editedItem)
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
      _item.photo = controls["contentFile"].value;
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
        _item.photo = controls["contentFile"].value;
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
      this.getTypeIdentification.push({ id: 'IDE', name: 'Cédula' }, { id: 'RUC', name: 'RUC' },
        { id: 'PTE', name: 'Pasaporte / Identificación tributaria el exterior' });
      this.activeField = false;
    } else {
      this.titleStartedAt = 'Fecha de creación';
      this.typeIdentificator = 'RUC';
      this.titleName = 'Razón social';
      this.getTypeIdentification.push({ id: 'RUC', name: 'RUC' });
      this.activeField = true;
    }
    this.croppedResult = "https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png";
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

    //this.horizontalWizardStepper.next();
    // return;
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

  nextStep() {
    this.horizontalWizardStepper.next();
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
        this.itemModel = res.obj;
        console.log(this.itemModel);
        this.loading = false;
        this.loadingWith = false;
        this.horizontalWizardStepper.next();
        this.setMessageSuccess("Guardado Correctamente")
        this.cdr.detectChanges();
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
    this.horizontalWizardStepper = new Stepper(document.querySelector('#stepper1'), {});

    this.bsStepper = document.querySelectorAll('.bs-stepper');
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

  getValidateContact() {
    this._service.validateContact(this.itemModel.id).subscribe(res => {
      if (res) {
        if (res.msg == '0') {
          Swal.fire({
            icon: 'error',
            title: `Debe tener al menos un contacto`,
            showConfirmButton: false,
            timer: 1500
          })
        } else {
          this.horizontalWizardStepper.next();
        }
      }
    }
      , err => {
        console.log("Estatus: ", err);
      }
    );
  }


  getValidateFile() {
    this._service.validateFile(this.itemModel.id).subscribe(res => {
      if (res) {
        if (res.msg == '0') {
          Swal.fire({
            icon: 'error',
            title: `Debe subir al menos un archivo`,
            showConfirmButton: false,
            timer: 1500
          })
        } else {
          this.horizontalWizardStepper.next();
        }
      }
    }
      , err => {
        console.log("Estatus: ", err);
      }
    );
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

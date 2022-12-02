import { Component, OnInit, OnDestroy, ViewEncapsulation, ViewChild, ChangeDetectorRef } from '@angular/core';
import { NgForm } from '@angular/forms';
import { AbstractControl, Validators } from '@angular/forms';
import { FormGroup, FormBuilder } from '@angular/forms';
import { Subject, of, Subscription, Observable, concat, throwError } from 'rxjs';
import { FlatpickrOptions } from 'ng2-flatpickr';

import { catchError, debounceTime, distinctUntilChanged, switchMap, tap, map, filter } from 'rxjs/operators';
import { ActivatedRoute, Router, NavigationEnd } from '@angular/router';
import Swal from 'sweetalert2'
import { IspContract } from 'core/models/isp/commercial/ispcontract.model';
import { IspContractService } from 'core/services/isp/commercial/ispcontract.service';
import { DatePipe } from '@angular/common';
import { IspPlanService } from 'core/services/isp/commercial/ispplan.service';
import { IspSectorService } from 'core/services/isp/commercial/ispsector.service';
import { State, City } from 'country-state-city';
import { IspSector } from 'core/models/isp/commercial/ispsector.model';
@Component({
  selector: 'app-contract-edit',
  templateUrl: './contract-edit.component.html',
  styleUrls: ['./contract-edit.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class ContractEditComponent implements OnInit, OnDestroy {
  // Public
  public url = this.router.url;
  public urlLastValue;
  public loading = false;
  public rows;
  public currentRow;
  public tempRow;
  public avatarImage: string;
  public contentHeader: object;
  lastMilesList: any[];
  paymentsList: any[];
  sectorList: any[];
  anotherProviderList: any[];
  planList: any[];
  templateContractList: any[];
  minimunPermanenceList: any[];
  editForm: FormGroup;

  itemModel: IspContract;
  @ViewChild('accountForm') accountForm: NgForm;

  public isCollapsed0 = false;
  public isCollapsed1 = true;
  openSearchSector() {
    this.isCollapsed0 = !this.isCollapsed0
    this.isCollapsed1 = true;
  }
  openAddSector() {
    this.editForm.controls['sector_id'].setValue(null);
    this.isCollapsed1 = !this.isCollapsed1
    this.isCollapsed0 = true;
  }

  public getCompartition: any = [{ id: 'A', name: '1:1' },
  { id: 'B', name: '1:2' }, { id: 'C', name: '1:4' }, { id: 'D', name: '1:8' }];

  public birthDateOptions: FlatpickrOptions = {
    altInput: true
  };

  public selectMultiLanguages = ['English', 'Spanish', 'French', 'Russian', 'German', 'Arabic', 'Sanskrit'];
  public selectMultiLanguagesSelected = [];

  // Private
  private _unsubscribeAll: Subject<any>;
  subscriptions: Subscription[] = [];

  marker = {
    position: { lat: -0.784725, lng: -80.237961 },
  };

  /**
   * Constructor
   *
   * @param {Router} router
   * @param {UserEditService} _userEditService
   */
  constructor(private _serviceSector: IspSectorService, private router: Router, private activatedRoute: ActivatedRoute, private _servicePlan: IspPlanService, private _service: IspContractService, private fb: FormBuilder, private cdr: ChangeDetectorRef) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
  }


  // Sectores
  submitSector() {
    const controls = this.editForm.controls.sectorGroup;
    if (controls.invalid) {
      Object.keys(controls["controls"]).forEach((controlName) => {
        console.log(
          "invalid editForm " + controlName + " = ",
          controls["controls"][controlName].status
        );
        controls["controls"][controlName].markAsTouched();
      });
      this.cdr.detectChanges();
      return;
    }

    const editedItem = this.prepareSectorItem();

    this.addSectorItem(editedItem);
  }

  addSectorItem(_item: IspSector) {
    const sbCreate = this._serviceSector
      .create(_item)
      .pipe(
        catchError((errorMessage) => {
          console.log(errorMessage);
          if (errorMessage.status == 422) {
            const validationErrors = errorMessage.error.errors;
            Object.keys(validationErrors).forEach((prop) => {
              const formControl = this.editForm.get("sectorGroup").get(prop);
              console.log(formControl)
              console.log(prop)
              if (formControl) {
                formControl.setErrors({
                  serverError: validationErrors[prop],
                });

                console.log(this.editForm.get("sectorGroup"))
              }
            });
          }
          this.cdr.detectChanges();
          return of(null);
        })
      )
      .subscribe((res: any) => {
        if (res) {
          this.getSector();
          this.editForm.controls['sector_id'].setValue(res?.obj?.id);
          Swal.fire("Exito!", "Tu registro ha sido creado.", "success");
          this.editForm.controls.sectorGroup.reset();
          this.openSearchSector();
        }
      });
    this.subscriptions.push(sbCreate);
  }

  prepareSectorItem(): IspSector {
    const controls = this.editForm.controls.sectorGroup;
    const _item = new IspSector();
    _item.clear();
    _item.sector = controls["controls"]["sector"].value;
    _item.location = controls["controls"]["location"].value;
    _item.city = controls["controls"]["city"].value;
    _item.state = controls["controls"]["state"].value;
    _item.latitude = this.marker.position.lat.toString();
    _item.longitude = this.marker.position.lng.toString();
    return _item;
  }

  public data: any;

  //Tag
  selectAddTagMethod(name) {
    return { name: name };
  }
  //Tag
  getLocationCity($event) {
    this.center = {
      lat: parseFloat($event.latitude),
      lng: parseFloat($event.longitude),
    };
    this.zoom = 13;
    this.marker = {
      position: {
        lat: parseFloat($event.latitude),
        lng: parseFloat($event.longitude),
      },
    };

    this.getLocation($event.name);
  }
  getState() {
    this._serviceSector.getCountry().subscribe((data) => {
      this.stateList = State.getStatesOfCountry(data.country);
    });
  }
  getLocation(city: string) {
    this._serviceSector.getLocation(city).subscribe((data) => {
      this.locationList = data.obj
    });
  }

  getCity($event) {
    console.log($event);
    this.editForm.controls['sectorGroup'].get('city').setValue(null);
    this.center = {
      lat: parseFloat($event.latitude),
      lng: parseFloat($event.longitude),
    };
    this.cityList = City.getCitiesOfState(
      $event.countryCode,
      $event.isoCode,
    );
    this.cdr.detectChanges();
  }
  locationList: any[] = [];
  stateList: any[] = [];
  cityList: any[] = [];
  zoom = 12;
  center!: google.maps.LatLngLiteral;
  options: google.maps.MapOptions = {
    zoomControl: true,
    scrollwheel: false,
    disableDefaultUI: true,
    fullscreenControl: true,
    disableDoubleClickZoom: true,
    mapTypeId: "hybrid",
    // maxZoom:this.maxZoom,
    // minZoom:this.minZoom,
  };
  eventHandler(event: any, name: string) {
    if (name === "mapClick") {
      const lat = event.latLng.lat();
      const lng = event.latLng.lng();
      this.marker = { position: { lat: lat, lng: lng } };
    }
  }
  // Sectores

  // Public Methods
  // -----------------------------------------------------------------------------------------------------

  /**
   * Reset Form With Default Values
   */
  resetFormWithDefaultValues() {
    this.accountForm.resetForm(this.tempRow);
  }





  initForm() {
    const today = new DatePipe("en-US").transform(new Date(), "yyyy-MM-dd");
    this.editForm = this.fb.group({
      emission_at: [today],
      type_service: [],
      break_at: [today],
      customer_id: [],
      username: [],
      sector_id: [],
      address_contract: [],
      contract_version_id: [],
      payment_id: [],


      plan_id: [],
      minimun_permanence_id: [],
      installation_cost: [],
      month_cost: [],
      compartition: [],
      is_permanence_cost: [this.itemModel.is_permanence_cost],
      permanence_cost: [],

      is_reconnection_cost: [this.itemModel.is_reconnection_cost],
      reconnection_cost: [],
      is_from_another_provider: [this.itemModel.is_from_another_provider],
      another_provider_id: [],
      is_pay_to_invoice: [this.itemModel.is_pay_to_invoice],
      is_apply_arcotel: [this.itemModel.is_apply_arcotel],
      is_not_cut_for_debt: [this.itemModel.is_not_cut_for_debt],
      is_not_generate_invoice_service: [this.itemModel.is_not_generate_invoice_service],

      sectorGroup: this.fb.group({
        sector: [null,
          Validators.compose([
            Validators.required,
            Validators.maxLength(250),
          ])],
        location: [null,
          Validators.compose([
            Validators.required,
            Validators.maxLength(250),
          ])],
        state: [null, Validators.compose([
          Validators.required
        ])],
        city: [null, Validators.compose([
          Validators.required
        ])],
        marker: [this.marker]
      }),




    });
  }

  inputPermanence($event) {
    if ($event.target.checked == true) {
      this.editForm.controls.permanence_cost.enable();
    } else {
      this.editForm.controls.permanence_cost.disable();
    }
  }

  inputReconnection($event) {
    if ($event.target.checked == true) {
      this.editForm.controls.reconnection_cost.enable();
    } else {
      this.editForm.controls.reconnection_cost.disable();
    }
    this.cdr.detectChanges();
  }

  inputSupplier($event) {
    if ($event.target.checked == true) {
      this.editForm.controls.another_provider_id.enable();
    } else {
      this.editForm.controls.another_provider_id.disable();
    }
    this.cdr.detectChanges();
  }


  getCustomerAddress($event) {
    this.editForm.controls['address_contract']?.setValue($event?.address);
  }

  /**
   * Submit
   *
   * @param form
   */
  submit(withBack: boolean = false, back: boolean = false) {
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

  goBackWithout() {
    console.log("goBackWithout...");
    this.router.navigate(['/isp/contract/list'], { relativeTo: this.activatedRoute });
  }


  updateItem(_item: IspContract) {
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

  addItem(_item: IspContract) {
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


  prepareItem(): IspContract {
    const controls = this.editForm.controls;
    const _item = new IspContract();
    _item.clear();
    if (this.itemModel.id) {
      _item.id = this.itemModel.id;
    }

    return _item;

  }


  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------
  /**
   * On init
   */
  ngOnInit(): void {
    navigator.geolocation.getCurrentPosition((position) => {
      this.center = {
        lat: position.coords.latitude,
        lng: position.coords.longitude,
      };
    });

    this.itemModel = new IspContract();
    this.itemModel.clear();
    this.initForm();
    this.getCustomers();
    this.getPayments();
    this.getLastMiles();
    this.getSector();
    this.getState();
    this.getMinimunPermanence();
    this.getTemplateContract();
    this.getAnotherProvider();
    this.editForm.controls.reconnection_cost.disable();
    this.editForm.controls.another_provider_id.disable();

    this.setHeader("Nuevo", '../../contract/list');
    this.activatedRoute.params.subscribe((params) => {
      const id = params.id;

      if (id && id.length > 0) {
        this.setHeader("Editar", '../../list');
        /*this._service.getPlanId(id).subscribe(
          (item: any) => {
            if (item) {
              this.initForm();
              this.cdr.detectChanges();
            }
          },
          (error) => { },
          () => { }
        );*/
      }
    });

  }


  ///////////////////////////////////////////////////////////
  customers$: Observable<any>;
  customerLoading = false;
  customersInput$ = new Subject<string>();
  selectedMovie: any;
  minLengthTerm = 3;
  getCustomers() {
    this.customers$ = concat(
      of([]), // default items
      this.customersInput$.pipe(
        filter(res => {
          return res !== null && res.length >= this.minLengthTerm
        }),
        distinctUntilChanged(),
        debounceTime(800),
        tap(() => this.customerLoading = true),
        switchMap(term => {

          return this._service.getCustomers(term).pipe(
            catchError(() => of([])), // empty list on error
            tap(() => this.customerLoading = false)
          )
        })
      )
    );
  }
  ///////////////////////////////////////////////////////

  getPayments() {
    this._service.getPayments().subscribe(res => {
      if (res) {
        this.paymentsList = res;
      }
    }
      , err => {
        console.log("Estatus: ", err);
      }
    );
  }

  getLastMiles() {
    this._servicePlan.getLastMiles().subscribe(res => {
      if (res) {
        this.lastMilesList = res;
      }
    }
      , err => {
        console.log("Estatus: ", err);
      }
    );
  }


  getPlan($event) {
    this.selectedPlan = null;
    this.editForm.controls['compartition'].setValue(null);
    this.editForm.controls['minimun_permanence_id'].setValue(null);
    this.editForm.controls['installation_cost'].setValue(null);
    this.editForm.controls['month_cost'].setValue(null);
    this.editForm.controls['plan_id'].setValue(null);
    this._service.getPlans($event.id).subscribe((data) => {
      this.planList = data
    });
  }

  public selectedPlan: any[];
  getPlanSelected($event) {
    console.log($event);
    this.editForm.controls['compartition'].setValue($event.compartition);
    this.editForm.controls['minimun_permanence_id'].setValue($event?.plandetail[0]?.minimun_permanence_id);
    this.editForm.controls['installation_cost'].setValue($event?.plandetail[0]?.installation_cost);
    this.editForm.controls['month_cost'].setValue($event?.plandetail[0]?.month_cost);
    this.selectedPlan = $event;

  }


  getSector() {
    this._service.getSectors().subscribe((data) => {
      this.sectorList = data
    });
  }

  getAnotherProvider() {
    this._service.getAnotherProviders().subscribe((data) => {
      this.anotherProviderList = data
    });
  }

  getTemplateContract() {
    this._service.getTemplateContracts().subscribe((data) => {
      this.templateContractList = data
    });
  }

  getMinimunPermanence() {
    this._servicePlan.getMinimunPermanences().subscribe((data) => {
      this.minimunPermanenceList = data
    });
  }

  setLocation($event) {
    this.center = {
      lat: parseFloat($event.latitude),
      lng: parseFloat($event.longitude),
    };
    this.marker = {
      position: {
        lat: parseFloat($event.latitude),
        lng: parseFloat($event.longitude),
      },
    };
  }





  setHeader(title: string, url: string) {
    this.contentHeader = {
      headerTitle: title + " contrato",
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
   * On destroy
   */
  ngOnDestroy(): void {
    // Unsubscribe from all subscriptions
    this._unsubscribeAll.next();
    this._unsubscribeAll.complete();
  }


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

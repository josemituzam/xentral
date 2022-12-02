import {
  Component,
  OnInit,

  OnDestroy,
  ViewEncapsulation,
  ViewChild,
  ChangeDetectorRef,
  ElementRef,
  NgZone,
  AfterViewInit
} from "@angular/core";
//import { Router } from "@angular/router";
import {
  FormArray,
  FormBuilder,
  FormControl,
  FormGroup,
  Validators,
} from '@angular/forms';
import { DatePipe } from "@angular/common";
import { Subject, of, Subscription } from "rxjs";
import { takeUntil } from "rxjs/operators";
import { FlatpickrOptions } from "ng2-flatpickr";
import { cloneDeep } from "lodash";
import { catchError, delay, finalize, tap } from "rxjs/operators";
import Swal from "sweetalert2";
import {
  SearchCountryField,
  CountryISO,
  PhoneNumberFormat,
} from "ngx-intl-tel-input";
import { ActivatedRoute, Router, NavigationEnd } from '@angular/router';
import { GoogleMap } from "@angular/google-maps";
import { IspSector } from "core/models/isp/commercial/ispsector.model";
import { IspSectorService } from "core/services/isp/commercial/ispsector.service";
import { State, City } from 'country-state-city';
@Component({
  selector: "app-sector-edit",
  templateUrl: "./sector-edit.component.html",
  styleUrls: ["./sector-edit.component.scss"],
  encapsulation: ViewEncapsulation.None
})
export class SectorEditComponent implements OnInit, AfterViewInit {
  @ViewChild("search")
  public searchElementRef!: ElementRef;
  @ViewChild(GoogleMap)
  public map!: GoogleMap;

  //Tag
  public locationList: any[] = [];
  selectAddTagMethod(name) {
    return { location: name };
  }
  //Tag


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
  latitude!: any;
  longitude!: any;
  id: string;
  separateDialCode = true;
  SearchCountryField = SearchCountryField;
  CountryISO = CountryISO;
  PhoneNumberFormat = PhoneNumberFormat;

  preferredCountries: CountryISO[] = [
    CountryISO.UnitedStates,
    CountryISO.UnitedKingdom,
  ];

  // Public
  public url = this.router.url;
  public activeMovField = true;
  public urlLastValue;
  public rows;
  public currentRow;
  public tempRow;
  public avatarImage: string;
  public contentHeader: object;
  public loading = false;
  public typePeople = "PN";
  public typeNumber = "MOV";
  public myYear = 0;
  public activeField = false;
  public titleName = "Nombres";
  public titleNumber = "Móvil";
  public titleStartedAt = "Fecha de nacimiento";

  stateList: any[] = [];
  cityList: any[] = [];

  startDate: string;
  endDate: string;
  maxDate: string;
  descriptionvalue: any;
  editForm: FormGroup;
  itemModel: IspSector;

  //@ViewChild('accountForm') accountForm: NgForm;

  public birthDateOptions: FlatpickrOptions = {
    altInput: true,
  };

  subscriptions: Subscription[] = [];

  public selectMultiLanguages = [
    "English",
    "Spanish",
    "French",
    "Russian",
    "German",
    "Arabic",
    "Sanskrit",
  ];
  public selectMultiLanguagesSelected = [];

  public getDescripcion = []; // [{id: 1, province: "hola"}, {id:2, province: "mana"}];
  public descriptionValue;

  // Private
  private _unsubscribeAll: Subject<any>;

  /**
   * Constructor
   *
   * @param {Router} router
   * @param {UserEditService} _userEditService
   */
  constructor(
    private datePipe: DatePipe,
    private router: Router,
    private fb: FormBuilder,
    private cdr: ChangeDetectorRef,
    private _service: IspSectorService,
    private ngZone: NgZone
    , private activatedRoute: ActivatedRoute,
  ) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf("/") + 1);
  }

  mapOptions: google.maps.MapOptions = {
    center: { lat: -0.784725, lng: -80.237961 },
    zoom: 18,
    mapTypeId: "satellite",
  };

  marker = {
    position: { lat: -0.784725, lng: -80.237961 },
  };

  resetFormWithDefaultValues() {
    //this.accountForm.resetForm(this.tempRow);
  }

  ngAfterViewInit(): void {
    // Binding autocomplete to search input control
    let autocomplete = new google.maps.places.Autocomplete(
      this.searchElementRef.nativeElement
    );
    // Align search box to center
    this.map.controls[google.maps.ControlPosition.TOP_CENTER].push(
      this.searchElementRef.nativeElement
    );
    autocomplete.addListener("place_changed", () => {
      this.ngZone.run(() => {
        //get the place result
        let place: google.maps.places.PlaceResult = autocomplete.getPlace();

        //verify result
        if (place.geometry === undefined || place.geometry === null) {
          return;
        }

        //set latitude, longitude and zoom
        this.latitude = place.geometry.location?.lat();
        this.longitude = place.geometry.location?.lng();
        this.center = {
          lat: this.latitude,
          lng: this.longitude,
        };
        this.marker = {
          position: { lat: this.latitude, lng: this.longitude },
        };
      });
    });
  }

  initForm() {
    this.editForm = this.fb.group({
      sector: [this.itemModel.sector,
      Validators.compose([
        Validators.required,
        Validators.maxLength(250),
      ])],
      location: [this.itemModel.location,
      Validators.compose([
        Validators.required,
        Validators.maxLength(250),
      ])],
      state: [this.itemModel.state, Validators.compose([
        Validators.required
      ])],
      city: [this.itemModel.city, Validators.compose([
        Validators.required
      ])],
      marker: [this.marker]
    });
  }



  eventHandler(event: any, name: string) {
    if (name === "mapClick") {
      const lat = event.latLng.lat();
      const lng = event.latLng.lng();
      this.marker = { position: { lat: lat, lng: lng } };
    }
  }

  /**
   * Submit
   *
   * @param form
   */



  submit() {
    this.loading = true;
    //console.log(this.editForm);
    const controls = this.editForm.controls;
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

  updateItem(_item: IspSector) {
    const sbUpdate = this._service
      .update(_item)
      .pipe(
        catchError((errorMessage) => {
          console.log(errorMessage);
          if (errorMessage.status == 422) {
            const validationErrors = errorMessage.error.errors;
            Object.keys(validationErrors).forEach((prop) => {
              const formControl = this.editForm.get(prop);
              if (formControl) {
                formControl.setErrors({
                  serverError: validationErrors[prop],
                });
              }
            });
          }
          this.loading = false;
          this.cdr.detectChanges();
          return of(null);
        })
      )
      .subscribe((res: any) => {
        console.log(res);
        if (res) {
          this.loading = false;
          Swal.fire("Exito!", "Tu registro ha sido editado.", "success");
          this.goBackWithout();
        }
      });
    this.subscriptions.push(sbUpdate);
  }

  addItem(_item: IspSector) {
    const sbCreate = this._service
      .create(_item)
      .pipe(
        catchError((errorMessage) => {
          console.log(errorMessage);
          if (errorMessage.status == 422) {
            const validationErrors = errorMessage.error.errors;
            Object.keys(validationErrors).forEach((prop) => {
              const formControl = this.editForm.get(prop);
              if (formControl) {
                formControl.setErrors({
                  serverError: validationErrors[prop],
                });
              }
            });
          }
          //aqui alert
          this.loading = false;
          this.cdr.detectChanges();
          return of(null);
        })
      )
      .subscribe((res: any) => {
        if (res) {
          this.loading = false;
          Swal.fire("Exito!", "Tu registro ha sido creado.", "success");
          this.goBackWithout();
        }
      });
    this.subscriptions.push(sbCreate);
  }

  goBackWithout() {
    console.log("goBackWithout...");
    this.router.navigate(['/isp/sector/list'], { relativeTo: this.activatedRoute });
  }

  prepareItem(): IspSector {
    const controls = this.editForm.controls;
    const _item = new IspSector();
    _item.clear();
    if (this.itemModel.id) {
      _item.id = this.itemModel.id;
    }
    _item.sector = controls["sector"].value;
    _item.location = controls["location"].value;
    _item.city = controls["city"].value;
    _item.state = controls["state"].value;
    _item.latitude = this.marker.position.lat.toString();
    _item.longitude = this.marker.position.lng.toString();
    return _item;
  }

  getState() {
    this._service.getCountry().subscribe((data) => {
      this.stateList = State.getStatesOfCountry(data.country);
    });
  }

  getLocation(city: string) {
    this._service.getLocation(city).subscribe((data) => {
      this.locationList = data.obj
    });
  }


  getCity($event) {
    this.editForm.controls['city'].setValue(null);
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


  ngOnInit(): void {
    navigator.geolocation.getCurrentPosition((position) => {
      this.center = {
        lat: position.coords.latitude,
        lng: position.coords.longitude,
      };
    });
    this.itemModel = new IspSector();
    this.itemModel.clear();
    this.initForm();
    this.setHeader("Nuevo", '../../sector/list');
    this.getState();
    this.activatedRoute.params.subscribe((params) => {
      const id = params.id;
      if (id && id.length > 0) {
        this.setHeader("Editar", '../../list');
        this._service.getSectorId(id).subscribe(
          (item: any) => {
            if (item) {
              this.itemModel = item.objSector;
              this.marker = {
                position: {
                  lat: parseFloat(item?.objSector?.latitude),
                  lng: parseFloat(item?.objSector?.longitude),
                },
              };
              navigator.geolocation.getCurrentPosition((position) => {
                this.center = {
                  lat: parseFloat(item.objSector.latitude),
                  lng: parseFloat(item.objSector.longitude),
                };
              });
              this.itemModel.city = item.objSector?.location?.city
              this.itemModel.state = item.objSector?.location?.state
              this.itemModel.location = item.objSector?.location?.location
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
      headerTitle: title + " sector",
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
import {
  Component,
  OnInit,
  OnDestroy,
  ViewEncapsulation,
  ViewChild,
  ChangeDetectorRef,
  ElementRef,
  NgZone,
} from "@angular/core";
import { Router } from "@angular/router";
import {
  FormArray,
  FormBuilder,
  FormControl,
  FormGroup,
  Validators,
} from "@angular/forms";
import { DatePipe } from "@angular/common";
import { Subject, of, Subscription } from "rxjs";
import { takeUntil } from "rxjs/operators";
import { FlatpickrOptions } from "ng2-flatpickr";
import { cloneDeep } from "lodash";
import { catchError, delay, finalize, tap } from "rxjs/operators";
import { repeaterAnimation } from "./form-repeater.animation";
import Swal from "sweetalert2";

import {
  SearchCountryField,
  CountryISO,
  PhoneNumberFormat,
} from "ngx-intl-tel-input";
import { IspSector } from "../../../../../../core/models/ispsector.model";
import { IspSectorService } from "../../../../../../core/services/ispsector.service";
import { DescriptionSector } from "../../../../../../core/models/ispcustomer.model";
import { GoogleMap } from "@angular/google-maps";
@Component({
  selector: "app-sector-edit",
  templateUrl: "./sector-edit.component.html",
  styleUrls: ["./sector-edit.component.scss"],
  encapsulation: ViewEncapsulation.None,
  animations: [repeaterAnimation],
})
export class SectorEditComponent implements OnInit {
  @ViewChild("search")
  public searchElementRef!: ElementRef;
  @ViewChild(GoogleMap)
  public map!: GoogleMap;

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

        console.log({ place }, place.geometry.location?.lat());

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
        this.itemModel.name = place.name;
        const controls = this.editForm.controls;
        this.itemModel.isp_parish_id = controls["description"].value;
        this.initForm();
      });
    });
  }

  initForm() {
    //const controls = this.editForm.controls;
    this.editForm = this.fb.group({
      name: [this.itemModel.name],
      description: [this.itemModel.isp_parish_id],
      //marker : [this.marker]
    });
    if (this.id) {
      this.editForm.controls['description'].setValue(parseInt(this.itemModel.isp_parish_id));
    }
  }

  eventHandler(event: any, name: string) {
    //console.log(event, name);
    // Add marker on double click event
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
    if (this.id) {
      console.log("entro");
      this.updateItem(editedItem);
      return;
    }
    this.addItem(editedItem);
  }

  updateItem(_item: IspSector) {
    const sbUpdate = this._service
      .putIspSector(_item)
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
          console.log(res);
          this.loading = false;
          Swal.fire("Exito!", "Tu registro ha sido editado.", "success");

          this.router.navigate(["isp/sector/list"]);
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

          this.router.navigate(["isp/sector/list"]);
        }
      });
    this.subscriptions.push(sbCreate);
  }

  prepareItem(): IspSector {
    const controls = this.editForm.controls;
    const _item = new IspSector();
    _item.clear();
    _item.is_active = true;
    _item.name = controls["name"].value;
    _item.isp_parish_id = controls["description"].value;
    _item.latitude = this.marker.position.lat.toString();
    _item.longitude = this.marker.position.lng.toString();
    if (this.id) {
      _item.id = this.id;
    }
    return _item;
  }

  getDescriptions() {
    this._service.getDescriptions().subscribe((data) => {
      console.log("LISTA SELECT");
      console.log(data);
      this.getDescripcion = data;
    });
  }

  ngOnInit(): void {
    navigator.geolocation.getCurrentPosition((position) => {
      this.center = {
        lat: position.coords.latitude,
        lng: position.coords.longitude,
      };
    });
    const dateFormat = "yyyy-MM-dd";
    this.maxDate = this.endDate = this.datePipe.transform(
      new Date(),
      dateFormat
    );

    this.itemModel = new IspSector();
    this.itemModel.clear();
    this.initForm();
    this.getDescriptions();
    //this.addRecord();
    console.log(this.url);
    let auxUrl = this.url.split("edit/");
    this.id = auxUrl[1];
    if (this.id) {
      this.setHeader("Editar");
      this.getSectorToEdit(this.id);
      //this.editForm.controls['name'].setValue(this.name)
      //this.editForm.controls['description'].setValue(this.description)
    } else {
      this.setHeader("Nuevo");
    }
  }

  getSectorToEdit(id) {
    this._service.getSectorById(id).subscribe((data) => {
      this.itemModel = data;
      this.initForm();
      this.cdr.detectChanges();
      console.log("modelo");
      console.log(this.itemModel);
      this.marker = {
        position: {
          lat: parseFloat(this.itemModel.latitude),
          lng: parseFloat(this.itemModel.longitude),
        },
      };
      this.mapOptions = {
        center: {
          lat: parseFloat(this.itemModel.latitude),
          lng: parseFloat(this.itemModel.longitude),
        },
        zoom: 18,
        mapTypeId: "satellite",
      };
      navigator.geolocation.getCurrentPosition((position) => {
        this.center = {
          lat: parseFloat(this.itemModel.latitude),
          lng: parseFloat(this.itemModel.longitude),
        };
      });
    });
  }
  setHeader(title: string) {
    this.contentHeader = {
      headerTitle: title + " Sector",
      actionButton: true,
      breadcrumb: {
        type: "",
        links: [
          {
            name: "Registros",
            isLink: true,
            link: "../../sector/list",
          },
        ],
      },
    };
  }
  getDate(): void {
    var started_at = this.editForm.get("started_at").value;
    var dateFormat = "yyyy-MM-dd";
    var today_at = this.datePipe.transform(new Date(), dateFormat);
    var fechaInicio = new Date(started_at).getTime();
    var fechaFin = new Date(today_at).getTime();
    var diff = fechaFin - fechaInicio;
    this.myYear = Math.round(diff / (1000 * 60 * 60 * 24) / 365);
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

import { Component, OnInit, OnDestroy, ViewEncapsulation, ViewChild, ChangeDetectorRef } from '@angular/core';
import { NgForm } from '@angular/forms';
import { FormControl, FormGroup, FormBuilder, Validators } from '@angular/forms';
import { Subject, of, Subscription, Observable, concat, throwError } from 'rxjs';
import { FlatpickrOptions } from 'ng2-flatpickr';
import { NgbNavChangeEvent } from "@ng-bootstrap/ng-bootstrap";
import { catchError, debounceTime, distinctUntilChanged, switchMap, tap, map, filter } from 'rxjs/operators';
import { ActivatedRoute, Router, NavigationEnd } from '@angular/router';
import Swal from 'sweetalert2'
import { IspContract } from 'core/models/isp/commercial/ispcontract.model';
import { IspContractService } from 'core/services/isp/commercial/ispcontract.service';
import { DatePipe } from '@angular/common';
import { IspPlanService } from 'core/services/isp/commercial/ispplan.service';
import { IspSectorService } from 'core/services/isp/commercial/ispsector.service';
import { Country, State, City } from 'country-state-city';
import { ICountry, IState, ICity } from 'country-state-city'
import { IspSector } from 'core/models/isp/commercial/ispsector.model';
@Component({
    selector: 'app-contract-edit',
    templateUrl: './contract-edit.component.html',
    styleUrls: ['./contract-edit.component.scss'],
    encapsulation: ViewEncapsulation.None
})
export class ContractEditComponent implements OnInit, OnDestroy {
    // Public
    active;
    public url = this.router.url;
    public urlLastValue;
    public loading = false;
    public rows;
    public currentRow;
    public tempRow;
    public data: any;
    public avatarImage: string;
    public contentHeader: object;
    lastMilesList: any[];
    paymentsList: any[];
    sectorList: any[];

    planList: any[];
    templateContractList: any[];
    minimunPermanenceList: any[];
    editForm: FormGroup;

    //Tag
    public locationList: any[] = [];
    selectAddLocation(name) {
        return { location: name };
    }

    public anotherProviderList: any[];
    selectAddProvider(name) {
        return { name: name };
    }
    //Tag

    itemModel: IspContract;
    @ViewChild('accountForm') accountForm: NgForm;

    public isCollapsed0 = false;
    public isCollapsed1 = true;

    public getCompartition: any = [{ id: '1:1', name: '1:1' },
    { id: '1:2', name: '1:2' }, { id: '1:4', name: '1:4' }, { id: '1:8', name: '1:8' }];

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

    public selectedPlan: any[];

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

    openSearchSector() {
        this.isCollapsed0 = !this.isCollapsed0
        this.isCollapsed1 = true;
    }
    openAddSector() {
        this.editForm.controls['contractGroup'].get('sector_id').setValue(null);
        //this.editForm.controls['sector_id'].setValue(null);
        this.isCollapsed1 = !this.isCollapsed1
        this.isCollapsed0 = true;
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
                            if (formControl) {
                                formControl.setErrors({
                                    serverError: validationErrors[prop],
                                });
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
                    this.editForm.controls['contractGroup'].get('sector_id').setValue(res?.obj?.id);
                    //this.editForm.controls['sector_id'].setValue(res?.obj?.id);
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
            contractGroup: this.fb.group({
                emission_at: [this.itemModel.emission_at == null ? today : this.itemModel.emission_at],
                adviser_id: [this.itemModel.adviser_id],
                break_day: [this.itemModel.break_day],
                customer_id: [
                    this.itemModel.customer_id
                ],
                username: [this.itemModel.username],
                sector_id: [this.itemModel.sector_id],
                address_contract: [this.itemModel.address_contract],
                contract_version_id: [this.itemModel.contract_version_id],
                payment_id: [this.itemModel.payment_id],
                plan_id: [this.itemModel.plan_id],
                last_mile_id: [this.itemModel.last_mile_id],
                minimun_permanence_id: [this.itemModel.minimun_permanence_id],
                installation_cost: [this.itemModel.installation_cost],
                month_cost: [this.itemModel.month_cost],
                compartition: [this.itemModel.compartition],
                is_permanence_cost: [this.itemModel.is_permanence_cost],
                permanence_cost: [this.itemModel.permanence_cost],
                is_reconnection_cost: [this.itemModel.is_reconnection_cost],
                reconnection_cost: [this.itemModel.reconnection_cost],
                is_from_another_provider: [this.itemModel.is_from_another_provider],
                another_provider_id: [this.itemModel.another_provider_id],
                is_pay_to_invoice: [this.itemModel.is_pay_to_invoice],
                is_apply_arcotel: [this.itemModel.is_apply_arcotel],
                is_not_cut_for_debt: [this.itemModel.is_not_cut_for_debt],
                is_not_generate_invoice_service: [this.itemModel.is_not_generate_invoice_service],
            }),

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

    setInputs(permanence: any, reconnection: any, supplier: any) {

        if (permanence == 1) {
            this.editForm.controls['contractGroup'].get('permanence_cost').enable();
        } else {
            this.editForm.controls['contractGroup'].get('permanence_cost').disable();
        }
        if (reconnection == 1) {
            this.editForm.controls['contractGroup'].get('reconnection_cost').enable();
        } else {
            this.editForm.controls['contractGroup'].get('reconnection_cost').disable();
        }
        if (supplier == 1) {
            this.editForm.controls['contractGroup'].get('another_provider_id').enable();
        } else {
            this.editForm.controls['contractGroup'].get('another_provider_id').disable();
        }

    }

    inputPermanence($event) {
        if ($event.target.checked == true) {
            this.editForm.controls['contractGroup'].get('permanence_cost').enable();
        } else {
            this.editForm.controls['contractGroup'].get('permanence_cost').disable();
        }
    }

    inputReconnection($event) {
        if ($event.target.checked == true) {
            this.editForm.controls['contractGroup'].get('reconnection_cost').enable();
        } else {
            this.editForm.controls['contractGroup'].get('reconnection_cost').disable();
        }
        this.cdr.detectChanges();
    }

    inputSupplier($event) {
        if ($event.target.checked == true) {
            this.editForm.controls['contractGroup'].get('another_provider_id').enable();
        } else {
            this.editForm.controls['contractGroup'].get('another_provider_id').disable();
        }
        this.cdr.detectChanges();
    }


    getCustomerAddress($event) {
        this.editForm.controls['contractGroup'].get('address_contract').setValue($event?.address);
    }

    /**
     * Submit
     *
     * @param form
     */
    submit() {
        this.loading = true;

        const controls = this.editForm.controls.contractGroup;
        /** check form */
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
        const editedItem = this.prepareItem();
        if (this.itemModel.id) {
            this.updateItem(editedItem);
            return;
        }
        this.addItem(editedItem);
    }

    goBackWithout() {
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
                this.router.navigate(["/isp/contract/edit/", res?.obj?.id], {
                    relativeTo: this.activatedRoute,
                });
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

    beakList: any[];
    selectAddTagMethod(name) {
        return { id: '0', name: name };
    }
    getBreakDay() {
        this._service.getBreakDay().subscribe(res => {
            if (res) {
                this.beakList = res;
            }
        }
            , err => {
                console.log("Estatus: ", err);
            }
        );
    }



    prepareItem(): IspContract {
        const controls = this.editForm.controls.contractGroup;
        const _item = new IspContract();
        _item.clear();
        if (this.itemModel.id) {
            _item.id = this.itemModel.id;
        }

        _item.compartition = controls["controls"]["compartition"].value;
        _item.minimun_permanence_id = controls["controls"]["minimun_permanence_id"].value;
        _item.installation_cost = controls["controls"]["installation_cost"].value;
        _item.month_cost = controls["controls"]["month_cost"].value;

        _item.address_contract = controls["controls"]["address_contract"].value;
        _item.adviser_id = controls["controls"]["adviser_id"].value;
        _item.another_provider_id = controls["controls"]["another_provider_id"].value;
        _item.break_day = controls["controls"]["break_day"].value;
        _item.plan_id = controls["controls"]["plan_id"].value;
        _item.contract_version_id = controls["controls"]["contract_version_id"].value;
        _item.customer_id = controls["controls"]["customer_id"].value;
        _item.emission_at = controls["controls"]["emission_at"].value;
        _item.is_apply_arcotel = controls["controls"]["is_apply_arcotel"].value;
        _item.is_from_another_provider = controls["controls"]["is_from_another_provider"].value;
        _item.is_not_cut_for_debt = controls["controls"]["is_not_cut_for_debt"].value;
        _item.is_not_generate_invoice_service = controls["controls"]["is_not_generate_invoice_service"].value;
        _item.is_pay_to_invoice = controls["controls"]["is_pay_to_invoice"].value;
        _item.is_permanence_cost = controls["controls"]["is_permanence_cost"].value;
        _item.is_reconnection_cost = controls["controls"]["is_reconnection_cost"].value;
        _item.payment_id = controls["controls"]["payment_id"].value;
        _item.permanence_cost = controls["controls"]["permanence_cost"].value;
        _item.reconnection_cost = controls["controls"]["reconnection_cost"].value;
        _item.sector_id = controls["controls"]["sector_id"].value;
        _item.username = controls["controls"]["username"].value;
        return _item;
    }

    public customerObj: any[];
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
        this.getBreakDay();
        this.getSector();
        this.getState();
        this.getMinimunPermanence();
        this.getTemplateContract();
        this.getAnotherProvider();
        this.editForm.controls['contractGroup'].get('reconnection_cost').disable();
        this.editForm.controls['contractGroup'].get('another_provider_id').disable();
        this.editForm.controls['contractGroup'].get('emission_at').disable();
        this.setHeader("Nuevo", '../../contract/list');
        this.activatedRoute.params.subscribe((params) => {
            const id = params.id;

            if (id && id.length > 0) {
                this.setHeader("Editar", '../../list');
                this.getContract(id);
            }
        });

    }

    getContract(id: string) {
        this._service.getContractId(id).subscribe(
            (item: any) => {
                if (item) {
                    this.itemModel = item.obj;
                    this.itemModel.compartition = item.obj?.get_contract_plan?.compartition;
                    this.itemModel.last_mile_id = item.obj?.get_contract_plan?.get_plan?.last_mile_id;
                    this.itemModel.minimun_permanence_id = item.obj?.get_contract_plan?.minimun_permanence_id;
                    this.itemModel.installation_cost = item.obj?.get_contract_plan?.installation_cost;
                    this.itemModel.month_cost = item.obj?.get_contract_plan?.month_cost;
                    this.itemModel.is_permanence_cost = item.obj?.get_contract_plan?.is_permanence_cost;
                    this.itemModel.permanence_cost = item.obj?.get_contract_plan?.permanence_cost;
                    this.getPlan({ id: item.obj?.get_contract_plan?.get_plan?.last_mile_id });
                    this.itemModel.plan_id = item.obj?.get_contract_plan?.plan_id;
                    var array = []
                    array.push(item.obj?.get_customer)
                    this.customers$ = of(array);
                    this.marker = {
                        position: {
                            lat: parseFloat(item.obj?.get_sector?.latitude),
                            lng: parseFloat(item.obj?.get_sector?.longitude),
                        },
                    };
                    navigator.geolocation.getCurrentPosition(() => {
                        this.center = {
                            lat: parseFloat(item.obj?.get_sector?.latitude),
                            lng: parseFloat(item.obj?.get_sector?.longitude),
                        };
                    });
                    this.zoom = 15;
                    this.setInputs(item.obj?.is_permanence_cost, item.obj?.is_reconnection_cost, item.obj?.is_from_another_provider)
                    this.initForm();
                    this.cdr.detectChanges();
                }
            },
            (error) => { },
            () => { }
        );
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
        this.editForm.controls['contractGroup'].get('compartition').setValue(null);
        this.editForm.controls['contractGroup'].get('minimun_permanence_id').setValue(null);
        this.editForm.controls['contractGroup'].get('installation_cost').setValue(null);
        this.editForm.controls['contractGroup'].get('month_cost').setValue(null);
        this.editForm.controls['contractGroup'].get('plan_id').setValue(null);
        this._service.getPlans($event.id).subscribe((data) => {
            this.planList = data
        });
    }
    getPlanSelected($event) {
        this.editForm.controls['contractGroup'].get('compartition').setValue($event.compartition);
        this.editForm.controls['contractGroup'].get('minimun_permanence_id').setValue($event?.get_plan_detail[0]?.minimun_permanence_id);
        this.editForm.controls['contractGroup'].get('installation_cost').setValue($event?.get_plan_detail[0]?.installation_cost);
        this.editForm.controls['contractGroup'].get('month_cost').setValue($event?.get_plan_detail[0]?.month_cost);
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

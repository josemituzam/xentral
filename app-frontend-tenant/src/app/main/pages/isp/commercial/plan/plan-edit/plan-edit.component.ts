import { Component, OnInit, OnDestroy, ViewEncapsulation, ViewChild, ChangeDetectorRef } from '@angular/core';
import { NgForm } from '@angular/forms';
import { AbstractControl, Validators } from '@angular/forms';
import { FormGroup, FormBuilder } from '@angular/forms';
import { Subject, of, Subscription, Observable } from 'rxjs';
import { FlatpickrOptions } from 'ng2-flatpickr';
import { IspPlanService } from 'core/services/isp/commercial/ispplan.service';
import { IspPlan } from 'core/models/isp/commercial/ispplan.model';
import { catchError, delay, finalize, tap } from 'rxjs/operators';
import { ActivatedRoute, Router, NavigationEnd } from '@angular/router';
import Swal from 'sweetalert2'
import { IspContractService } from 'core/services/isp/commercial/ispcontract.service';
@Component({
  selector: 'app-plan-edit',
  templateUrl: './plan-edit.component.html',
  styleUrls: ['./plan-edit.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class PlanEditComponent implements OnInit, OnDestroy {
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
  editForm: FormGroup;
  itemModel: IspPlan;
  @ViewChild('accountForm') accountForm: NgForm;

  public getType: any = [{ id: 'K', name: 'K' },
  { id: 'M', name: 'M' }];

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

  /**
   * Constructor
   *
   * @param {Router} router
   * @param {UserEditService} _userEditService
   */
  constructor(private router: Router, private activatedRoute: ActivatedRoute, private _service: IspPlanService, private fb: FormBuilder, private cdr: ChangeDetectorRef) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
  }

  // Public Methods
  // -----------------------------------------------------------------------------------------------------

  /**
   * Reset Form With Default Values
   */
  resetFormWithDefaultValues() {
    this.accountForm.resetForm(this.tempRow);
  }

  initForm() {
    this.editForm = this.fb.group({
      name: [this.itemModel.name],
      description: [this.itemModel.description],
      last_mile_id: [this.itemModel.last_mile_id],
      increase: [this.itemModel.increase],
      type_increase: [this.itemModel.type_increase],
      downfall: [this.itemModel.downfall],
      type_downfall: [this.itemModel.type_downfall],
      compartition: [this.itemModel.compartition],
      installation_cost: [this.itemModel.installation_cost],
      month_cost: [this.itemModel.month_cost],
      penalty_amount: [this.itemModel.penalty_amount],
      meters_free: [this.itemModel.meters_free],
      additional_meter_cost: [this.itemModel.additional_meter_cost],
      minimun_permanence_id: [this.itemModel.minimun_permanence_id],
    });
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
    this.router.navigate(['/isp/plan/list'], { relativeTo: this.activatedRoute });
  }


  updateItem(_item: IspPlan) {
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

  addItem(_item: IspPlan) {
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


  prepareItem(): IspPlan {
    const controls = this.editForm.controls;
    const _item = new IspPlan();
    _item.clear();
    if (this.itemModel.id) {
      _item.id = this.itemModel.id;
    }
    _item.name = controls["name"].value;
    _item.description = controls["description"].value;
    _item.last_mile_id = controls["last_mile_id"].value;
    _item.increase = controls["increase"].value;
    _item.type_increase = controls["type_increase"].value;
    _item.downfall = controls["downfall"].value;
    _item.type_downfall = controls["type_downfall"].value;
    _item.compartition = controls["compartition"].value;
    _item.installation_cost = controls["installation_cost"].value;
    _item.month_cost = controls["month_cost"].value;
    _item.penalty_amount = controls["penalty_amount"].value;
    _item.meters_free = controls["meters_free"].value;
    _item.additional_meter_cost = controls["additional_meter_cost"].value;
    _item.minimun_permanence_id = controls["minimun_permanence_id"].value;
    return _item;

  }

  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------
  /**
   * On init
   */
  ngOnInit(): void {
    this.itemModel = new IspPlan();
    this.itemModel.clear();
    this.initForm();
    this.getLastMiles();
    this.getMinimunPermanence();
    this.setHeader("Nuevo", '../../plan/list');
    this.activatedRoute.params.subscribe((params) => {
      const id = params.id;
      if (id && id.length > 0) {
        this.setHeader("Editar", '../../list');
        this._service.getPlanId(id).subscribe(
          (item: any) => {
            if (item) {
              this.itemModel = item.objPlan;
              this.itemModel.installation_cost = item.objPlan?.plandetail[0]?.installation_cost;
              this.itemModel.month_cost = item.objPlan?.plandetail[0]?.month_cost;
              this.itemModel.penalty_amount = item.objPlan?.plandetail[0]?.penalty_amount;
              this.itemModel.meters_free = item.objPlan?.plandetail[0]?.meters_free;
              this.itemModel.additional_meter_cost = item.objPlan?.plandetail[0]?.additional_meter_cost;
              this.itemModel.minimun_permanence_id = item.objPlan?.plandetail[0]?.minimun_permanence_id;
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
  minimunPermanenceList: any[];
  getMinimunPermanence() {
    this._service.getMinimunPermanences().subscribe((data) => {
      this.minimunPermanenceList = data
    });
  }

  setHeader(title: string, url: string) {
    this.contentHeader = {
      headerTitle: title + " plan",
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


  getLastMiles() {
    this._service.getLastMiles().subscribe(res => {
      if (res) {
        this.lastMilesList = res;
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
}

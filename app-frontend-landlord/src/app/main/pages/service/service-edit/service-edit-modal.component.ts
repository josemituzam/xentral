import {
  Component,
  OnInit,
  Input,
  OnDestroy,
  ChangeDetectorRef,
  ChangeDetectionStrategy,
} from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { Observable, of, Subscription } from 'rxjs';
import { FormGroup, FormBuilder, Validators, FormArray } from "@angular/forms";
import { catchError, delay, finalize, tap } from 'rxjs/operators';
import Swal from 'sweetalert2'
import { Service } from 'app/core/models/service.model';
import { ServiceService } from 'app/core/services';

import { repeaterAnimation } from './form-repeater.animation';
@Component({
  selector: 'service-edit-modal',
  templateUrl: './service-edit-modal.component.html',
  styleUrls: ['./service-edit-modal.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush,
  animations: [repeaterAnimation]
})
export class ServiceEditModalComponent implements OnInit, OnDestroy {
  id: string;
  name: string;
  description: string;
  service_details: [];
  // max_users: number;
  title: string;
  itemModel: Service;
  editForm: FormGroup;
  // arrCantUsers: FormArray;
  public loading = false;
  subscriptions: Subscription[] = [];
  errorMessage = '';
  public items = [];


  constructor(
    private cdr: ChangeDetectorRef,
    private fb: FormBuilder,
    private _service: ServiceService,
    public modal: NgbActiveModal) { }

  ngOnInit(): void {
    this.itemModel = new Service();
    this.itemModel.clear();
    this.initForm();
    if (this.id) {
      this.updateForm();
    } else {
      this.title = "Nuevo";
    }
   // this.addRecord();
  }
  /**
   * Init form
   */
  initForm() {
    //console.log(this.fb.array(this.add().map(items => this.fb.group(items))));
    this.editForm = this.fb.group({
      name: [
        this.itemModel.name,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      description: [
        this.itemModel.description,
        Validators.compose([Validators.maxLength(300)]),
      ],
      service_detail: new FormArray([])
    });
  }

  updateForm() {
    this.title = "Editar";
    this.editForm.controls['name'].patchValue(this.name)
    this.editForm.controls['description'].patchValue(this.description)
    if (this.service_details.length > 0) {
      this.service_details.map((item: any) => {
        const itemForm = this.fb.group({
          min_users: item.min_users,
          max_users: item.max_users,
          price_monthly: item.price_monthly,
        });

        this.service_detail.push(itemForm);
      });
    }
  }

  get service_detail(): FormArray {
    return this.editForm.get("service_detail") as FormArray
  }

  newRecord(): FormGroup {
    var numA = 0;
    var arraY = [];
    arraY = this.editForm.get("service_detail").value;

    arraY.forEach(function (item) {
      numA = item["max_users"] + 1;
    })

    return this.fb.group({
      min_users: numA == 0 ? 1 : numA,
      max_users: 0,
      price_monthly: 0
    })
  }

  addRecord() {
    this.service_detail.push(this.newRecord());
  }

  removeRecord(i: number) {
    this.service_detail.removeAt(i);
  }

  prepareItem(): Service {
    const controls = this.editForm.controls;
    const _item = new Service();
    _item.clear();
    if (this.id) {
      _item.id = this.id;
    }
    _item.name = controls["name"].value;
    _item.description = controls["description"].value;
    _item.service_detail = controls["service_detail"].value;
    return _item;
  }

  submit() {
    this.loading = true;
    const controls = this.editForm.controls;
    /** check form */
    if (this.editForm.invalid) {
      Object.keys(controls).forEach((controlName) => {
        controls[controlName].markAsTouched();
      });
      this.loading = false;
      this.cdr.detectChanges();
      return;
    }

    for (let item of this.editForm.get("service_detail").value) {
      if (item["max_users"] < item["min_users"]) {
        this.loading = false;
        this.setMessageError(`Redistribuir los usuarios`)
        this.cdr.detectChanges();
        return;
      }
    }

    const editedItem = this.prepareItem();
    if (this.id) {
      this.updateItem(editedItem);
      return;
    }
    this.addItem(editedItem);
  }

  /**
  * Método para guardar un registro
  */
  addItem(_item: Service) {

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
        this.setMessageSuccess("Guardado Correctamente")
        this.modal.close()
      }
    });
    this.subscriptions.push(sbCreate);

  }
  /**
    * Método para actualizar un registro
    */
  updateItem(_item: Service) {
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
        this.modal.close()
      }
    });
    this.subscriptions.push(sbUpdate);
  }

  setMessageError(message: string) {
    Swal.fire({
      icon: 'error',
      title: `${message}`,
      showConfirmButton: false,
      timer: 1500
    })
  }

  setMessageSuccess(message: string) {
    Swal.fire({
      icon: 'success',
      title: `${message}`,
      showConfirmButton: false,
      timer: 1500
    })
  }

  ngOnDestroy(): void {
    this.subscriptions.forEach(sb => sb.unsubscribe());
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

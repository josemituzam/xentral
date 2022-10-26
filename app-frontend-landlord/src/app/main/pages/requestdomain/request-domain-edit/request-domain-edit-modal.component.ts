import {
  Component,
  OnInit,
  Input,
  OnDestroy,
  ChangeDetectorRef,
  ChangeDetectionStrategy,
} from '@angular/core';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { of, Subscription } from 'rxjs';
import { FormGroup, FormBuilder, Validators } from "@angular/forms";
import { catchError } from 'rxjs/operators';
import Swal from 'sweetalert2'
import { RequestDomainService, ServiceService } from 'app/core/services';
import { RequestDomain } from 'app/core/models/request-domain.model';
import { Service } from 'app/core/models/service.model';
@Component({
  selector: 'request-domain-edit-modal',
  templateUrl: './request-domain-edit-modal.component.html',
  styleUrls: ['./request-domain-edit-modal.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush,
})
export class RequestDomainEditModalComponent implements OnInit, OnDestroy {
  id: string;
  name: string;
  description: string;
  title: string;
  itemModel: RequestDomain;
  editForm: FormGroup;
  serviceList: Service[];
  public loading = false;
  subscriptions: Subscription[] = [];
  setDomainService: any[] = [];
  setCantUserService: any[] = [];
  setMaxUserService: any[] = [];


  errorMessage = '';
  public mergedPwdShow = false;

  constructor(
    private cdr: ChangeDetectorRef,
    private fb: FormBuilder,
    private _service: RequestDomainService,
    private _serviceService: ServiceService,
    public modal: NgbActiveModal) { }

  ngOnInit(): void {
    this.itemModel = new RequestDomain();
    this.itemModel.clear();
    this.initForm();
    this.setServices();
  }

  getStatus($event, id, name, max_user) {
    var band = 0;
    if ($event.target.checked == true) {
      band = 1;

      this.setCantUserService.push({
        service_id: id,
        is_active: band,
        name: name,
        max_user: max_user
      });

    } else {
      var filerOption = this.setCantUserService.filter(
        (item) => item.service_id !== id
      );
      this.setCantUserService.push({
        service_id: id,
        is_active: band,
        name: name,
        max_user: max_user
      });
      this.setCantUserService = [];
      this.setCantUserService = filerOption;
    }


    const resultado = this.setDomainService.find(
      (obj) => obj.service_id === id
    );
    if (resultado == undefined) {
      this.setDomainService.push({
        service_id: id,
        is_active: band,
      });
    } else {
      var filerOption = this.setDomainService.filter(
        (item) => item.service_id !== id
      );
      this.setDomainService = [];
      filerOption.push({
        service_id: id,
        is_active: band,
      });
      this.setDomainService = filerOption;
    }
    console.log(this.setDomainService)


  }

  getCantUser(value, id) {
    const resultado = this.setMaxUserService.find(
      (obj) => obj.service_id === id
    );
    if (resultado == undefined) {
      this.setMaxUserService.push({
        service_id: id,
        max_users: value,
      });
    } else {
      var filerOption = this.setMaxUserService.filter(
        (item) => item.service_id !== id
      );
      this.setMaxUserService = [];
      filerOption.push({
        service_id: id,
        max_users: value,
      });
      this.setMaxUserService = filerOption;
    }

    console.log(this.setMaxUserService);
  }

  /**
   * Init form
   */
  initForm() {
    this.editForm = this.fb.group({
      fullname: [
        this.itemModel.fullname,
        Validators.compose([Validators.maxLength(300), Validators.required]),
      ],
      email: [
        this.itemModel.email,
        Validators.compose([Validators.maxLength(300), Validators.email, Validators.required]),
      ],
      password: [
        this.itemModel.password,
        Validators.compose([Validators.maxLength(300), Validators.required]),
      ],
      domain_name: [
        this.itemModel.domain_name,
        Validators.compose([Validators.maxLength(300), Validators.required]),
      ],
      company_name: [
        this.itemModel.company_name,
        Validators.compose([Validators.maxLength(300), Validators.required]),
      ],
    });
    if (this.id) {
      this.title = "Editar";
      this.editForm.controls['name'].setValue(this.name)
      this.editForm.controls['description'].setValue(this.description)
    } else {
      this.title = "Nuevo";
    }
  }

  /**
   * Returns prepared data for save
   */
  prepareItem(): RequestDomain {
    const controls = this.editForm.controls;
    const _item = new RequestDomain();
    _item.clear();
    _item.fullname = controls['fullname'].value;
    _item.email = controls['email'].value;
    _item.password = controls['password'].value;
    _item.domain_name = controls['domain_name'].value;
    _item.company_name = controls['company_name'].value;
    _item.maxUserService = this.setMaxUserService;
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
  addItem(_item: RequestDomain) {
    const sbCreate = this._service.create(_item).pipe(
      catchError((errorMessage) => {
        this.loading = false;
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
        window.open(res.url_tenant);
        this.loading = false;
        this.setMessage("Tenant creado correctamente")
        this.modal.close()
      }
    });
    this.subscriptions.push(sbCreate);

  }
  /**
    * Método para actualizar un registro
    */
  updateItem(_item: RequestDomain) {
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
        this.setMessage("Actualizado Correctamente")
        this.modal.close()
      }
    });
    this.subscriptions.push(sbUpdate);
  }



  /**
    * Método para obtener la lista de los servicios
    */
  setServices() {
    this._serviceService
      .getServices()
      .subscribe((res: any) => {
        if (res) {
          this.serviceList = res;
          console.log(this.serviceList);
          this.cdr.detectChanges();
        }
      });
  }

  setMessage(message: string) {
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

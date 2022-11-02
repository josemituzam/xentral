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
import { DomainService } from 'app/core/models/domain_service.model';
@Component({
  selector: 'service-edit-modal',
  templateUrl: './service-edit-modal.component.html',
  styleUrls: ['./service-edit-modal.component.scss'],
  changeDetection: ChangeDetectionStrategy.OnPush,
})
export class ServiceEditModalComponent implements OnInit, OnDestroy {
  id: string;
  name: string;
  description: string;
  title: string;
  itemModel: DomainService;
  editForm: FormGroup;
  serviceList: Service[];
  public loading = false;
  subscriptions: Subscription[] = [];
  objDomainService: any[] = [];
  setContractService: any[] = [];
  maxContractService: any[] = [];
  errorMessage = '';
  public mergedPwdShow = false;

  constructor(
    private cdr: ChangeDetectorRef,
    private fb: FormBuilder,
    private _service: RequestDomainService,
    private _serviceService: ServiceService,
    public modal: NgbActiveModal) { }

  ngOnInit(): void {
    this.getDomainService(this.id)
    // this.setServices();
    this.initForm();
  }

  getCantUser(value, id) {
    const resultado = this.maxContractService.find(
      (obj) => obj.service_id === id
    );
    if (resultado == undefined) {
      this.maxContractService.push({
        service_id: id,
        max_contracts: value,
      });
    } else {
      var filerOption = this.maxContractService.filter(
        (item) => item.service_id !== id
      );
      this.maxContractService = [];
      filerOption.push({
        service_id: id,
        max_contracts: value,
      });
      this.maxContractService = filerOption;
    }
  }



  /**
   * Init form
   */
  initForm() {
    this.editForm = this.fb.group({
      maxContractService: [
      ],
    });
  }

  /**
   * Returns prepared data for save
   */
  prepareItem(): DomainService {
    const controls = this.editForm.controls;
    const _item = new DomainService();
    _item.clear();
    _item.request_domain_id = this.id;
    _item.maxContractService = this.maxContractService;
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
    this.updateItem(editedItem);
    console.log(editedItem);
  }

  /**
  * Método para guardar un registro
  */
  /**
  * Método para actualizar un registro
  */
  updateItem(_item: any) {
    const sbUpdate = this._service.putDomainServices(_item).pipe(
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
      }),
    ).subscribe((res: any) => {
      console.log(res);
      if (res) {
        console.log(res);
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
  getDomainService(id: any) {
    this._service
      .getDomainServices(id)
      .subscribe((res: any) => {
        if (res) {
          for (let item of res.obj) {
            console.log(item);
            if (item.max_contracts != 0) {
              this.setContractService.push({
                service_id: item.id,
                is_active: item.checked,
                name: item.name,
                max_contracts: item.max_contracts,
              });

              this.maxContractService.push({
                service_id: item.id,
                max_contracts: item.max_contracts,
              });
            }

          }
          this.objDomainService = res.obj;
          this.cdr.detectChanges();
        }
      });
  }


  getStatus($event, id, name, max_contracts) {
    var band = 0;
    if ($event.target.checked == true) {
      band = 1;
      this.setContractService.push({
        service_id: id,
        is_active: band,
        name: name,
        max_contracts: max_contracts == undefined? 0 : max_contracts,
      });

    } else {
      var filerOption = this.setContractService.filter(
        (item) => item.service_id !== id
      );
      console.log(filerOption);
      this.maxContractService = [];

      for (let item of filerOption) {
        this.maxContractService.push({
          service_id: item.service_id,
          max_contracts: item.max_contracts == undefined? 0 : max_contracts,
        });
      }

      this.setContractService.push({
        service_id: id,
        is_active: band,
        name: name,
        max_contracts: max_contracts == undefined? 0 : max_contracts,
      });
      this.setContractService = [];

      this.setContractService = filerOption;
    }
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

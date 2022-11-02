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
  itemModel: RequestDomain;
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
  }

  getCantUser(value, id) {

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
    _item.maxContractService = this.maxContractService;
    return _item;
  }

  submit() {

  }

  /**
  * Método para guardar un registro
  */
  addItem(_item: RequestDomain) {


  }
  /**
    * Método para actualizar un registro
    */
  updateItem(_item: RequestDomain) {

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
        max_contracts: max_contracts
      });

    } else {
      var filerOption = this.setContractService.filter(
        (item) => item.service_id !== id
      );
      this.setContractService.push({
        service_id: id,
        is_active: band,
        name: name,
        max_contracts: max_contracts
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

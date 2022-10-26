import { Component, OnInit, ChangeDetectorRef, Output, EventEmitter, Input } from '@angular/core'
import { FormGroup, FormBuilder, Validators } from "@angular/forms";
import { CoreSidebarService } from '@core/components/core-sidebar/core-sidebar.service';
import { Service } from 'app/core/models/service.model';
import { catchError } from 'rxjs/operators';
import { of } from 'rxjs';
import { ServiceService } from 'app/core/services';
import Swal from 'sweetalert2'

@Component({
  selector: 'app-new-service-sidebar',
  templateUrl: './new-service-sidebar.component.html'
})
export class NewServiceSidebarComponent implements OnInit {
  itemModel: Service;
  public loading = false;
  public contentHeader: object
  public mergedPwdShow = false;
  editForm: FormGroup;

  @Output() getTable = new EventEmitter();

  @Input()
  serviceId: string;

  /**
   * Constructor
   *
   * @param {CoreSidebarService} _coreSidebarService
   */
  constructor(
    private _coreSidebarService: CoreSidebarService,
    private fb: FormBuilder,
    private _service: ServiceService,
    private cdr: ChangeDetectorRef
  ) { }

  /**
   * Toggle the sidebar
   *
   * @param name
   */
  toggleSidebar(name): void {
    this._coreSidebarService.getSidebarRegistry(name).toggleOpen();
  }

  /**
   * Submit
   *
   * @param form
   */
  submit() {
    this.loading = true;
    const controls = this.editForm.controls;
    /** check form */
    if (this.editForm.invalid) {
      Object.keys(controls).forEach(controlName => {
        console.log("invalid editForm " + controlName + " = ", controls[controlName].status);
        controls[controlName].markAsTouched()
      }
      );
      this.loading = false;
      this.cdr.detectChanges();
      return;
    }
    const editedItem = this.prepareItem();
    this.addItem(editedItem);
  }

  ngOnInit(): void {
    this.fields();
  }


  /**
 * Init form
 */
  initForm() {
    this.editForm = this.fb.group({
      name: [
        this.itemModel.name,
        Validators.compose([Validators.maxLength(100), Validators.required]),
      ],
      description: [
        this.itemModel.description,
        Validators.compose([Validators.maxLength(300)]),
      ],
    });
  }


  /**
  * Returns prepared data for save
  */
  prepareItem(): Service {
    const controls = this.editForm.controls;
    const _item = new Service();
    _item.clear();
    _item.name = controls['name'].value;
    _item.description = controls['description'].value;
    return _item;
  }

  addItem(_item: Service) {
    this._service.create(_item).pipe(
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
        return of(null);
      })
    ).subscribe((res: any) => {
      if (res) {
        this.getTable.emit();
        this.loading = false;
        this.fields();
        this.setMessage("Guardado Correctamente")
        this.toggleSidebar('new-sidebar');
      }
    });
  }

  fields() {
    this.itemModel = new Service();
    this.itemModel.clear();
    this.initForm();
  }


  setMessage(message: string) {
    Swal.fire({
      icon: 'success',
      title: `${message}`,
      showConfirmButton: false,
      timer: 1500
    })
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

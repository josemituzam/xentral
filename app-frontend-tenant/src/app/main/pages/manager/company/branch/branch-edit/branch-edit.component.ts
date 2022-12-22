import { Component, OnInit, OnDestroy, ViewEncapsulation, ChangeDetectorRef } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { FormGroup, FormBuilder } from '@angular/forms';
import { ZoneSale } from 'core/models/manager/zone-sale.model';
import { AbstractControl, Validators } from '@angular/forms';
import { Subject, of, Subscription, Observable } from 'rxjs';
import { catchError, delay, finalize, tap } from 'rxjs/operators';
import Swal from 'sweetalert2'
import { BranchService } from 'core/services/manager/branch.service';
import { Branch } from 'core/models/manager/branch.model';
@Component({
  selector: 'app-branch-edit',
  templateUrl: './branch-edit.component.html',
  styleUrls: ['./branch-edit.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class BranchEditComponent implements OnInit, OnDestroy {
  // Public
  public url = this.router.url;
  public urlLastValue;
  public rows;
  public currentRow;
  public tempRow;
  public contentHeader: object
  editForm: FormGroup;
  itemModel: Branch;
  private _unsubscribeAll: Subject<any>;
  loading = false;
  subscriptions: Subscription[] = [];
  /**
   * Constructor
   *
   * @param {Router} router
   * @param {UserEditService} _userEditService
   */
  constructor(private cdr: ChangeDetectorRef, private _service: BranchService, private router: Router, private fb: FormBuilder, private activatedRoute: ActivatedRoute) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
  }

  // Public Methods
  // -----------------------------------------------------------------------------------------------------

  initForm() {
    this.editForm = this.fb.group({
      name: [
        this.itemModel.name,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      description: [
        this.itemModel.description,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      code: [
        this.itemModel.code,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      address: [
        this.itemModel.address,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      phone: [
        this.itemModel.phone,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      extention: [
        this.itemModel.extention,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      email: [
        this.itemModel.email,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
    });
  }

  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------
  /**
   * On init
   */
  ngOnInit(): void {
    this.itemModel = new Branch();
    this.itemModel.clear();
    this.initForm();
    this.setHeader("Nueva", '../../zone-sale/list');
    this.activatedRoute.params.subscribe((params) => {
      const id = params.id;
      if (id && id.length > 0) {
        this.setHeader("Editar", '../../list');
        this._service.getBranchId(id).subscribe(
          (item: any) => {
            if (item) {
              this.itemModel = item;
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
      headerTitle: title + " sucursal",
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
  * Submit
  *
  * @param form
  */
  submit() {
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

  updateItem(_item: Branch) {
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

  addItem(_item: Branch) {
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

  goBackWithout() {
    console.log("goBackWithout...");
    this.router.navigate(['/manager/branch/list'], { relativeTo: this.activatedRoute });
  }

  prepareItem(): Branch {
    const controls = this.editForm.controls;
    const _item = new Branch();
    _item.clear();
    if (this.itemModel.id) {
      _item.id = this.itemModel.id;
    }
    _item.name = controls["name"].value;
    _item.description = controls["description"].value;
    _item.code = controls["code"].value;
    _item.address = controls["address"].value;
    _item.phone = controls["phone"].value;
    _item.extention = controls["extention"].value;
    _item.email = controls["email"].value;
    return _item;
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

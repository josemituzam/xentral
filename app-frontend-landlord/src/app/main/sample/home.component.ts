import { Component, OnInit, ChangeDetectorRef } from '@angular/core'
import { FormGroup, FormBuilder, Validators } from "@angular/forms";
import { RequestDomain } from 'app/core/models/request-domain.model';
import { RequestDomainService } from 'app/core/services';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {
  itemModel: RequestDomain;
  constructor(private fb: FormBuilder, private _requestDomainService: RequestDomainService, private cdr: ChangeDetectorRef) { }
  public loading = false;
  public contentHeader: object
  public mergedPwdShow = false;
  editForm: FormGroup;


  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------

  /**
   * On init
   */
  ngOnInit() {
    this.itemModel = new RequestDomain();
    this.itemModel.clear();
    this.initForm();

    this.contentHeader = {
      headerTitle: 'Home',
      actionButton: true,
      breadcrumb: {
        type: '',
        links: [
          {
            name: 'Home',
            isLink: true,
            link: '/'
          },
          {
            name: 'Sample',
            isLink: false
          }
        ]
      }
    }
  }


  /**
  * Init form
  */
  initForm() {
    this.editForm = this.fb.group({
      firstname: [
        this.itemModel.firstname,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      lastname: [
        this.itemModel.lastname,
        Validators.compose([Validators.maxLength(300), Validators.required]),
      ],
      email: [
        this.itemModel.email,
        Validators.compose([Validators.maxLength(300), Validators.required]),
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
  }


  onSubmit() {
    this.loading = true;
    const controls = this.editForm.controls;
    /** check form */
    if (this.editForm.invalid) {
      Object.keys(controls).forEach(controlName => {
        console.log("invalid editForm " + controlName + " = ", controls[controlName].status);
        controls[controlName].markAsTouched()
      }

      );
      this.cdr.detectChanges();
      return;
    }



    const editedItem = this.prepareItem();

    this.addItem(editedItem);
  }

  /**
    * Returns prepared data for save
    */
  prepareItem(): RequestDomain {
    const controls = this.editForm.controls;
    const _item = new RequestDomain();
    _item.clear();
    _item.firstname = controls['firstname'].value;
    _item.lastname = controls['lastname'].value;
    _item.email = controls['email'].value;
    _item.password = controls['password'].value;
    _item.domain_name = controls['domain_name'].value;
    _item.company_name = controls['company_name'].value;
    return _item;
  }

  addItem(_item: RequestDomain) {
    const addSubscription = this._requestDomainService.create(_item).subscribe((item: RequestDomain) => {
      if (item) {
        console.log(item);
        this.loading = false;
      }
    }, err => {
      this.loading = false;
    }
    );
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

import { Component, OnInit, OnDestroy, ViewEncapsulation, ViewChild, ChangeDetectorRef, Input, EventEmitter, Output } from '@angular/core';
import { Router } from '@angular/router';
import {
  FormArray,
  FormBuilder,
  FormControl,
  FormGroup,
  Validators,
} from '@angular/forms';
import { Subject, of, Subscription } from 'rxjs';
import { IspCustomerService } from 'core/services/isp/commercial/ispcustomer.service';
import { IspCustomer } from 'core/models/isp/commercial/ispcustomer.model';
import { FileUploader } from 'ng2-file-upload';
import { CropperComponent } from 'angular-cropperjs';
import { catchError, delay, finalize, tap } from 'rxjs/operators';
const URL = 'https://your-url.com';
@Component({
  selector: 'app-customer-documentation',
  templateUrl: './customer-documentation.component.html',
  styleUrls: ['./customer-documentation.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class CustomerDocumentationComponent implements OnInit, OnDestroy {

  //imageICO: any = "https://upload.wikimedia.org/wikipedia/commons/f/f3/C%C3%A9dula_electr%C3%B3nica_Ecuador_%28Enero_2021%29.png";
  // Public
  @Input() customerId: string;

  public uploader: FileUploader = new FileUploader({
    url: URL,
    isHTML5: true
  });

  public hexp = 500;
  public wexp = 500;

  @ViewChild('angularCropper') angularCrooper: CropperComponent;

  photoIde = null;

  public url = this.router.url;
  public activeMovField = true;
  public urlLastValue;
  public rows;
  public currentRow;
  public tempRow;
  public avatarImage: string;
  public loading = false;
  public typeNumber = 'MOV'
  public activeField = false;
  public refresh = false;

  public croppedResult: string;

  public activeMovFieldContact = true;

  public titleOneFile = "Subir archivo .png/.jpg";
  public titleTwoFile = "Subir documento pdf";

  startDate: string;
  endDate: string;
  maxDate: string;

  editForm: FormGroup;
  itemModel: IspCustomer;

  subscriptions: Subscription[] = [];
  @Output() nextStep: EventEmitter<any> = new EventEmitter();


  // Private
  private _unsubscribeAll: Subject<any>;

  /**
   * Constructor
   *
   * @param {Router} router
   * @param {UserEditService} _userEditService
   */
  constructor(private router: Router, private fb: FormBuilder, private cdr: ChangeDetectorRef, private _service: IspCustomerService) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
  }

  // Public Methods
  // -----------------------------------------------------------------------------------------------------

  initForm() {
    this.editForm = this.fb.group({
      filename: [""],
      fileContent: [""],
      ideName: [""],
      ideContent: [""],
    });

  }

  public getCroppedImage() {
    this.croppedResult = this.angularCrooper.cropper.getCroppedCanvas().toDataURL();
    this.editForm.get("ideContent").setValue(this.croppedResult);
  }

  public getFileTwo(event: EventEmitter<File[]>) {
    const file: File = event[0];
    const name = file.name;
    this.titleTwoFile = name;
    console.log(file)
    console.log(name)
    this.editForm.get("fileContent").setValue(file);
    this.editForm.get("filename").setValue(name);
  }


  public getFileOne(event: EventEmitter<File[]>) {
    const file: File = event[0];
    const name = file.name;
    this.titleOneFile = name;
    console.log(file);
    this.editForm.get("ideName").setValue(name);

    this.readBase64(file)
      .then(function (data) {
        console.log(data);
      })

  }

  public readBase64(file): Promise<any> {
    var reader = new FileReader();
    var future = new Promise((resolve, reject) => {
      reader.addEventListener("load", () => {
        resolve(reader.result);

        this.photoIde = reader.result;

      }, false);


      reader.addEventListener("error", function (event) {
        reject(event);
      }, false);

      reader.readAsDataURL(file);
    });
    return future;
  }


  prepareItem(): any {
    const controls = this.editForm.controls;
    const formData = new FormData();
    formData.append("id", this.customerId);
    formData.append("filename", controls["filename"].value);
    formData.append("fileContent", controls["fileContent"].value);
    formData.append("ideName", controls["ideName"].value);
    formData.append("ideContent", controls["ideContent"].value);


    /*const _item = {
      id: this.customerId,
      filename: controls["filename"].value,
      fileContent: controls["fileContent"].value,
      ideName: controls["ideName"].value,
      ideContent: controls["ideContent"].value
    };*/
    return formData;
  }



  /**
   * Submit
   *
   * @param form
   */
  submit() {
    // this.nextStep.emit();
    // return;
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
    console.log(editedItem);
    this.addItem(editedItem);
  }

  addItem(_item: any) {
    const sbCreate = this._service.uploadContent(_item).pipe(
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
      //  this.nextStep.emit();
    });
    this.subscriptions.push(sbCreate);
  }

  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------
  /**
   * On init
   */
  ngOnInit(): void {
    this.initForm();

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

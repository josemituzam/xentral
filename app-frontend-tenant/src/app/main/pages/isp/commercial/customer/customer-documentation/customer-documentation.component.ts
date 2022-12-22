import { Component, OnInit, ViewEncapsulation, ViewChild, ChangeDetectorRef, Input, EventEmitter, Output } from '@angular/core';
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
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { FileModalComponent } from './file-modal/file-modal.component';
const URL = 'https://your-url.com';
@Component({
  selector: 'app-customer-documentation',
  templateUrl: './customer-documentation.component.html',
  styleUrls: ['./customer-documentation.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class CustomerDocumentationComponent implements OnInit {

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
  public filesList: any[];

  // Private
  private _unsubscribeAll: Subject<any>;

  /**
   * Constructor
   *
   * @param {Router} router
   * @param {UserEditService} _userEditService
   */
  constructor(private modalService: NgbModal, private router: Router, private fb: FormBuilder, private cdr: ChangeDetectorRef, private _service: IspCustomerService) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
  }


  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------
  /**
   * On init
   */
  ngOnInit(): void {
    this.getFiles(this.customerId)
  }

  getFiles(customerId: string) {
    this._service.getFiles(customerId).subscribe(res => {
      if (res) {
        this.filesList = res;
      }
    }
      , err => {
        console.log("Estatus: ", err);
      }
    );
  }

  upload(obj: any) {
    const modalRef = this.modalService.open(FileModalComponent, {
      centered: true,
      backdrop: 'static',
      size: 'lg' // size: 'xs' | 'sm' | 'lg' | 'xl'
    });
    console.log(obj);
    modalRef.componentInstance.fileId = obj.id;
    modalRef.componentInstance.type = obj.type
    modalRef.componentInstance.title = obj.name;
    modalRef.result.then(
      () => this.getFiles(this.customerId),
      () => { }
    );
  }

  download(path) {
    const link = document.createElement('a');
    link.setAttribute('target', '_blank');
    link.setAttribute('href', path);
    link.setAttribute('download', `products.pdf`);
    document.body.appendChild(link);
    link.click();
    link.remove();
  }
}

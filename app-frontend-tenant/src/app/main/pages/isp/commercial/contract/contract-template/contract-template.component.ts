import { Component, OnInit, OnDestroy, ViewEncapsulation, ViewChild, ChangeDetectorRef, Input, Output, EventEmitter } from '@angular/core';
import { Router } from '@angular/router';
import {
  FormArray,
  FormBuilder,
  FormControl,
  FormGroup,
  Validators,
} from '@angular/forms';
import { DatePipe } from '@angular/common';
import { Subject, of, Subscription } from 'rxjs';
import { catchError, delay, finalize, tap } from 'rxjs/operators';

import { IspCustomerService } from 'core/services/isp/commercial/ispcustomer.service';
import { IspCustomer } from 'core/models/isp/commercial/ispcustomer.model';
import { IspContractService } from 'core/services/isp/commercial/ispcontract.service';
//import * as ClassicEditor from '@ckeditor/ckeditor5-build-classic';
//import * as DecoupledEditor from '@ckeditor/ckeditor5-build-decoupled-document';
//import PageBreak from '@ckeditor/ckeditor5-page-break/src/pagebreak';
//import Editor from './ckeditor';
import Swal from 'sweetalert2'
import { ContractLinkComponent } from './contract-link/contract-link.component';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
@Component({
  selector: 'app-contract-template',
  templateUrl: './contract-template.component.html',
  styleUrls: ['./contract-template.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class ContractTemplateComponent implements OnInit, OnDestroy {

  public url = this.router.url;
  public urlLastValue;
  public rows;
  public currentRow;
  public tempRow;
  //customEditor = Editor;
  name = "ng2-ckeditor";
  ckeConfig: any;
  mycontent: string;
  log: string = "";
  @ViewChild("myckeditor") ckeditor: any;

  @Input() contractId: string;
  @Input() template: string;
  @Input() contractTemplateId: string;
  @Input() isGenerated: number;
  @Input() isSigned: number;
  @Output() newItemEvent = new EventEmitter<string>();

  //public Editor = DecoupledEditor;

  subscriptions: Subscription[] = [];
  editForm: FormGroup;
  signatureList: any[];


  // Private
  private _unsubscribeAll: Subject<any>;

  /**
   * Constructor
   *
   * @param {Router} router
   * @param {UserEditService} _userEditService
   */
  constructor(private modalService: NgbModal, private router: Router, private fb: FormBuilder, private cdr: ChangeDetectorRef, private _service: IspContractService) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
    this.mycontent = `<p>My html content</p>`;
  }

  // Public Methods
  // -----------------------------------------------------------------------------------------------------

  initForm() {
    this.editForm = this.fb.group({
      html: [],
    });

  }

  prepareItem(): any {
    const controls = this.editForm.controls;
    let _item = {
      html: controls["html"].value,
      contract_template_id: this.contractTemplateId,
      contract_id: this.contractId,
    };

    return _item;
  }


  activeChange($event, id) {
    var band = 0;
    if ($event.target.checked == true) {
      band = 1;
    }
    var obj = {
      id: id,
      is_active: band,
    };
    this._service.putSignatureActive(obj).subscribe(
      (item: any) => {
        if (item) {
          this.getTemplateSignature(this.contractTemplateId)
        }
      },
      (err) => {
      }
    );
    this.cdr.detectChanges();
  }

  requiredChange($event, id) {
    var band = 0;
    if ($event.target.checked == true) {
      band = 1;
    }
    var obj = {
      id: id,
      is_required: band,
    };
    this._service.putSignatureRequired(obj).subscribe(
      (item: any) => {
        if (item) {
          this.getTemplateSignature(this.contractTemplateId)
        }
      },
      (err) => {
      }
    );
    this.cdr.detectChanges();
  }
  public loading = false;
  public loadingDownload = false;
  public loadingLink = false;
  /**
   * Submit
   *
   * @param form
   */
  submit() {
    this.loading = true;
    const editedItem = this.prepareItem();
    Swal.fire({
      title: '¿Desea generar el contrato?',
      text: "Cuando se genere no podrá generar un nuevo contrato",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Aceptar'
    }).then((result) => {
      if (result.isConfirmed) {
        this._service.generateContract(editedItem).subscribe(
          (item: any) => {
            if (item) {
              Swal.fire(
                'Realizado!',
                'Ahora puede descargar o generar un enlace para la firma del contrato.',
                'success'
              )
              this.loading = false;
              this.newItemEvent.emit(this.contractId);
            }
          },
          (err) => {
            console.log(err);
            this.loading = false;
          }
        );
      } else {
        this.loading = false;
      }
    })
    this.cdr.detectChanges();

  }

  downloadPdf() {
    this.loadingDownload = true;
    this._service.downloadPdf(this.contractId, this.contractTemplateId).subscribe(
      (item: any) => {
        if (item) {
          this.loadingDownload = false;
        }
      },
      (err) => {
        console.log(err);
        this.loadingDownload = false;
      }
    );
    this.cdr.detectChanges();
  }

  linkGenerated() {
    this.loadingLink = true;
    this._service.getLinkGenerated(this.contractId, this.contractTemplateId).subscribe(
      (item: any) => {
        if (item) {
          const modalRef = this.modalService.open(ContractLinkComponent, {
            centered: true,
            backdrop: 'static',
            size: 'lg' // size: 'xs' | 'sm' | 'lg' | 'xl'
          });
          modalRef.componentInstance.link = item
          this.loadingLink = false;
        }
      },
      (err) => {
        console.log(err);
        if (err.status == 429) {
          Swal.fire("Acción no válida!", err.error.msg , "error");
        }
        this.loadingLink = false;
      }
    );
    this.cdr.detectChanges();
  }

  addItem(_item: any) {

  }

  onEditorChange(event) {
    //console.log(event);
  }

  onChange(event: any): void {
    //console.log(event);
    //console.log(this.mycontent);
    //this.log += new Date() + "<br />";
  }

  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------
  /**
   * On init
   */
  ngOnInit(): void {
    this.ckeConfig = {
      extraPlugins:
        "easyimage,dialogui,dialog,a11yhelp,about,basicstyles,bidi,blockquote,clipboard," +
        "button,panelbutton,panel,floatpanel,colorbutton,colordialog,menu," +
        "contextmenu,dialogadvtab,div,elementspath,enterkey,entities,popup," +
        "filebrowser,find,fakeobjects,flash,floatingspace,listblock,richcombo," +
        "font,format,forms,horizontalrule,htmlwriter,iframe,image,indent," +
        "indentblock,indentlist,justify,link,list,liststyle,magicline," +
        "maximize,newpage,pagebreak,pastefromword,pastetext,preview,print," +
        "removeformat,resize,save,menubutton,scayt,selectall,showblocks," +
        "showborders,smiley,sourcearea,specialchar,stylescombo,tab,table," +
        "tabletools,templates,toolbar,undo,wysiwygarea"
    };
    this.initForm();
    this.editForm.get('html').setValue(this.template);
    this.getTemplateSignature(this.contractTemplateId)
  }

  getTemplateSignature(contractTemplateId: string) {
    this._service.getContractTemplateSignature(contractTemplateId).subscribe(
      (item: any) => {
        if (item) {
          this.signatureList = item;
          this.cdr.detectChanges();
        }
      },
      (error) => { },
      () => { }
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

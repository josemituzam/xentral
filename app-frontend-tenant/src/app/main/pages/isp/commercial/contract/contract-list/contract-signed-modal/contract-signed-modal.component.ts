import { Component, OnInit, OnDestroy, ViewEncapsulation, ChangeDetectorRef, EventEmitter, Output } from '@angular/core';
import { Router } from '@angular/router';
import {
  FormBuilder
} from '@angular/forms';
import { Subject, Subscription } from 'rxjs';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { IspContractService } from 'core/services/isp/commercial/ispcontract.service';
import { FileUploader } from 'ng2-file-upload';
import Swal from 'sweetalert2'
const URL = 'https://your-url.com';
@Component({
  selector: 'app-contract-signed-modal',
  templateUrl: './contract-signed-modal.component.html',
  styleUrls: ['./contract-signed-modal.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class ContractSignedModalComponent implements OnInit, OnDestroy {
  public url = this.router.url;
  public urlLastValue;
  public rows;
  public currentRow;
  public tempRow;
  public loading = false;
  id: string;
  type: string;
  subscriptions: Subscription[] = [];
  // Private
  private _unsubscribeAll: Subject<any>;
  path: string;

  /**
   * Constructor
   *
   * @param {Router} router
   */

  constructor(private _service: IspContractService, public modal: NgbActiveModal, private router: Router, private fb: FormBuilder, private cdr: ChangeDetectorRef) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
  }

  ngOnInit(): void {
    if (this.type == 'viewContract') {
      this.getSanitazedPath(this.id);
    }
  }
  public uploader: FileUploader = new FileUploader({
    url: URL,
    isHTML5: true
  });
  public titleFile = "Subir el contrato en pdf";
  public file: any;

  public getFile(event: EventEmitter<File[]>) {
    const file: File = event[0];
    const name = file.name;
    this.titleFile = name;
    this.file = file;
  }

  getSanitazedPath(id: string) {
    this._service.getContractSigned(id).subscribe(
      (item: any) => {
        if (item) {
          this.path = item?.obj;
          this.cdr.detectChanges();
        }
      },
      (error) => { },
      () => { }
    );
  }


  submitFile() {
    this.loading = true;
    Swal.fire({
      title: '¿Está seguro(a)?',
      text: 'El estado del contrato cambiará a Pre-alta',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Si, guardar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        const formData = new FormData();
        formData.append("id", this.id);
        formData.append("path", this.file);
        formData.append("type", this.type);

        this._service.uploadContract(formData).subscribe(res => {
          if (res) {
            this.modal.close('close')
            this.loading = false;
          }
        }
          , err => {
            this.loading = false;
            console.log("Estatus: ", err);
          }
        );
      }
    });
  }

  ngOnDestroy(): void {

  }
}

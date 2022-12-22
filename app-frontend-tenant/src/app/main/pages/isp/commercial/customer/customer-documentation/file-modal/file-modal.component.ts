import { Component, OnInit, OnDestroy, ViewEncapsulation, ViewChild, ChangeDetectorRef, Input, EventEmitter, Output } from '@angular/core';
import { Router } from '@angular/router';
import {
  FormBuilder
} from '@angular/forms';
import { WebcamImage, WebcamInitError, WebcamUtil } from 'ngx-webcam';
import { CropperComponent } from 'angular-cropperjs';
import { Subject, of, Subscription, Observable } from 'rxjs';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import Swal from 'sweetalert2'
import { IspCustomerService } from 'core/services';
import { FileUploader } from 'ng2-file-upload';
const URL = 'https://your-url.com';
@Component({
  selector: 'app-file-modal',
  templateUrl: './file-modal.component.html',
  styleUrls: ['./file-modal.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class FileModalComponent implements OnInit, OnDestroy {

  public url = this.router.url;
  public urlLastValue;
  public rows;
  public currentRow;
  public tempRow;
  public loading = false;
  subscriptions: Subscription[] = [];
  // Private
  private _unsubscribeAll: Subject<any>;

  @ViewChild('angularCropper') angularCrooper: CropperComponent;

  fileId: string;
  type: string;
  title: string;

  

  public uploader: FileUploader = new FileUploader({
    url: URL,
    isHTML5: true
  });
  public titleFile = "Subir documento pdf";
  public file: any;

  // Hacer Toogle on/off
  public hexp = 400;
  public wexp = 400;
  public mostrarWebcam = true;
  public permitirCambioCamara = true;
  public multiplesCamarasDisponibles = false;
  public croppedResult: string;
  public dispositivoId: string;
  public opcionesVideo: MediaTrackConstraints = {
    //width: {ideal: 1024};
    //height: {ideal: 576}
  }
  // Errores al iniciar la cámara 
  public errors: WebcamInitError[] = [];

  // Ultima captura o foto 
  public imagenWebcam: WebcamImage = null;

  // Cada Trigger para una nueva captura o foto 
  public trigger: Subject<void> = new Subject<void>();

  // Cambiar a la siguiente o anterior cámara 
  private siguienteWebcam: Subject<boolean | string> = new Subject<boolean | string>();

  public showCapture = false;
  public triggerCaptura(): void {
    this.showCapture = true;
    this.trigger.next();
  }
  /**
   * Constructor
   *
   * @param {Router} router
   */
  constructor(public _service: IspCustomerService, public modal: NgbActiveModal, private router: Router, private fb: FormBuilder, private cdr: ChangeDetectorRef) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
  }

  initForm() {

  }

  prepareItem(): any {

  }

  public getFile(event: EventEmitter<File[]>) {
    const file: File = event[0];
    const name = file.name;
    this.titleFile = name;
    this.file = file;
  }

  submitImage() {
    this.loading = true;
    Swal.fire({
      title: '¿Está seguro(a)?',
      text: 'No podrá seguir editando la imágen',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Si, guardar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        const item = {
          id: this.fileId,
          path: this.croppedResult,
          type: this.type
        }
        this._service.updateFiles(item).subscribe(res => {
          if (res) {
            this.modal.close('close')
          }
        }
          , err => {
            console.log("Estatus: ", err);
          }
        );
      }
    });
  }

  submitFile() {
    this.loading = true;
    Swal.fire({
      title: '¿Está seguro(a)?',
      text: 'Se guardará el archivo actual',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Si, guardar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {
        const formData = new FormData();
        formData.append("id", this.fileId);
        formData.append("path", this.file);
        formData.append("type", this.type);

        this._service.updateFiles(formData).subscribe(res => {
          if (res) {
            this.modal.close('close')
          }
        }
          , err => {
            console.log("Estatus: ", err);
          }
        );
      }
    });
  }

  ngOnInit(): void {
    setTimeout(() => {
      WebcamUtil.getAvailableVideoInputs()
        .then((mediaDevices: MediaDeviceInfo[]) => {
          this.multiplesCamarasDisponibles = mediaDevices && mediaDevices.length > 1;
        });
    }, 1000);
  }

  ngOnDestroy(): void {

  }

  public showCamera(): void {
    this.mostrarWebcam = true;
    this.showCapture = false;
    this.loading = false;
    this.croppedResult = undefined;
  }

  public getCroppedImage() {
    this.croppedResult = this.angularCrooper.cropper.getCroppedCanvas().toDataURL();
  }

  public handleInitError(error: WebcamInitError): void {
    this.errors.push(error);
  }

  public showNextWebcam(directionOnDeviceId: boolean | string): void {
    this.siguienteWebcam.next(directionOnDeviceId);
  }

  public handleImage(imagenWebcam: WebcamImage): void {
    this.imagenWebcam = imagenWebcam;
  }

  public cameraSwitched(dispositivoId: string): void {
    this.dispositivoId = dispositivoId;
  }

  public get triggerObservable(): Observable<void> {
    return this.trigger.asObservable();
  }

  public get nextWebcamObservable(): Observable<boolean | string> {
    return this.siguienteWebcam.asObservable();
  }

}

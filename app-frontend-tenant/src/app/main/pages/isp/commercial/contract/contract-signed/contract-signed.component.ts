import { AfterViewInit, Component, OnDestroy, OnInit, ViewEncapsulation, ViewChild, ChangeDetectorRef } from '@angular/core';
import { ActivatedRoute, Router, NavigationEnd } from '@angular/router';
import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';
import { CoreSidebarService } from '@core/components/core-sidebar/core-sidebar.service';
import SignaturePad from 'signature_pad';
import { IspContractService } from 'core/services/isp/commercial/ispcontract.service';
import { CoreConfigService } from '@core/services/config.service';
import Swal from 'sweetalert2'
@Component({
  selector: 'app-contract-signed',
  templateUrl: './contract-signed.component.html',
  styleUrls: ['./contract-signed.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class ContractSignedComponent implements OnInit, OnDestroy, AfterViewInit {
  // Public
  public url = this.router.url;
  public urlLastValue;
  public apiData;
  public sidebarToggleRef = false;
  public paymentSidebarToggle = false;
  public path: any;

  @ViewChild('firmaDigital', { static: true }) signaturePadElement: any;
  signaturePad: any;
  firma: any;

  // Private
  private _unsubscribeAll: Subject<any>;

  /**
   * Constructor
   *
   * @param {Router} router
   * @param {InvoiceEditService} _invoiceEditService
   * @param {CoreSidebarService} _coreSidebarService
   */
  constructor(
    private cdr: ChangeDetectorRef,
    private _service: IspContractService,
    private activatedRoute: ActivatedRoute,
    private router: Router,
    private _coreSidebarService: CoreSidebarService,
    private _coreConfigService: CoreConfigService
  ) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
    this._coreConfigService.config = {
      layout: {
        navbar: {
          hidden: true
        },
        footer: {
          hidden: true
        },
        menu: {
          hidden: true
        },
        customizer: false,
        enableLocalStorage: false
      }
    }
  }

  // Public Methods
  // -----------------------------------------------------------------------------------------------------

  contractId: string;
  tokenId: string;
  contractTemplateId: string;
  signatures: any;
  signaturesCount: any;
  customer: any;

  ngAfterViewInit(): void {

    this.signaturePad = new SignaturePad(this.signaturePadElement?.nativeElement);

  }

  /*cambiarColor() {
    const rojo = Math.round(Math.random() * 255);
    const verde = Math.round(Math.random() * 255);
    const azul = Math.round(Math.random() * 255);
    const color = 'rgb(' + rojo + ',' + verde + ',' + azul + ')'
    this.signaturePad.penColor = color;
  }*/

  limpiarFirma() {
    this.signaturePad.clear();
  }

  deshacer() {
    const datos = this.signaturePad.toData();
    if (datos) {
      datos.pop();
      this.signaturePad.fromData(datos);
    }
  }

  descargar(dataUrl: any, nombre: string) {
    if (navigator.userAgent.indexOf('Safary') > -1 && navigator.userAgent.indexOf('Chrome') === -1) {
      window.open(dataUrl);
    } else {
      const blob = this.UrlToBlob(dataUrl);
      const url = window.URL.createObjectURL(blob);
      const a = document.createElement('a');
      a.href = url;
      a.download = nombre;
      this.firma = blob;
      document.body.appendChild(a);
      a.click();
      window.URL.revokeObjectURL(url);
    }
  }

  UrlToBlob(dataURL: any) {
    const partes = dataURL.split(';base64,');
    const contentType = partes[0].split(':')[1];
    const raw = window.atob(partes[1]);
    const rawL = raw.length;
    const array = new Uint8Array(rawL);
    for (let i = 0; i < rawL; i++) {
      array[i] = raw.charCodeAt(i);
    }
    return new Blob([array], { type: contentType });

  }

  loadinFinish = false;
  finish() {
    this.loadinFinish = true;
    let item = {
      contract_template_id: this.contractTemplateId,
      contract_id: this.contractId,
      token_id: this.tokenId
    }
    this._service.finishSignature(item).subscribe(res => {
      if (res) {
        this.isSigned = res?.isSigned;
        this.loadinFinish = false;
        location.reload();
        Swal.fire("Bienvenido!", "Tu contrato ha sido firmado.", "success");
      }
    }
      , err => {
        console.log("Estatus: ", err);
        this.loadinFinish = false;
      }
    );
    this.cdr.detectChanges();
  }

  loadingSave = false;
  isSigned: any;
  submit() {
    if (this.signaturePad.isEmpty()) {
      alert('Deve firmar el documento');
    } else {
      const u = this.signaturePad.toDataURL();
      this.loadingSave = true;
      Swal.fire({
        title: '¿Desea guardar la firma?',
        text: "No podrá modificar la firma",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Aceptar'
      }).then((result) => {
        if (result.isConfirmed) {
          const formData = new FormData();
          formData.append("contract_template_id", this.contractTemplateId);
          formData.append("signature_id", this.signatures?.id);
          formData.append("signature", u);
          formData.append("contract_id", this.contractId);
          formData.append("token_id", this.tokenId);
          this._service.saveSignature(formData).subscribe(res => {
            if (res) {
              this.signatures = res?.objTemplateSignature;
              this.signaturesCount = res?.objCount;
              this.signaturePad.clear();
              this.loadingSave = false;

            }
          }
            , err => {
              console.log("Estatus: ", err);
              this.loadingSave = false;
            }
          );
        } else {
          this.loadingSave = false;
        }
      })
      this.cdr.detectChanges();
    }
  }


  /*guardarJPG() {
    if (this.signaturePad.isEmpty()) {
      alert('Deve firmar el documento');
    } else {
      const u = this.signaturePad.toDataURL();
      this.descargar(u, 'firma.jpg');
      this.firma = u;
    }
  }*/
  /* guardarSVG() {
     if (this.signaturePad.isEmpty()) {
       alert('Deve firmar el documento');
     } else {
       const u = this.signaturePad.toDataURL('image/svg+xml');
       this.descargar(u, 'firma.svg');
       this.firma = u;
     }
   }*/
  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------
  /**
   * On init
   */

  ngOnInit(): void {
    this.activatedRoute.params.subscribe(params => {
      this.contractId = params['contractId'];
      this.contractTemplateId = params['contractTemplateId'];
      this.tokenId = params['tokenId'];
      const expires = this.activatedRoute.snapshot.queryParams["expires"];
      const signature = this.activatedRoute.snapshot.queryParams["signature"];
      this._service.getContractSignedCustomer(this.contractId, this.contractTemplateId, this.tokenId, expires, signature).subscribe(res => {
        if (res) {
          this.isSigned = res?.isSigned;
          this.path = res?.path;
          this.signaturesCount = res?.objCount;
          this.signatures = res?.objTemplateSignature;
          this.customer = res?.objCustomer;
          this.cdr.detectChanges();
        }
      }
        , err => {
          console.log(err);
          if (err.status == '403') {
            this.router.navigate(['/ext/contract/signed/expired'], { relativeTo: this.activatedRoute });
          }
        }
      );
    });
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

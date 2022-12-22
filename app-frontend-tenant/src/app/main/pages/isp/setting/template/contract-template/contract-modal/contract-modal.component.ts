import { Component, OnInit, OnDestroy, ViewEncapsulation, ChangeDetectorRef, EventEmitter, Output } from '@angular/core';
import { Router } from '@angular/router';
import {
  FormBuilder
} from '@angular/forms';
import { Subject, Subscription } from 'rxjs';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import { TemplateContractService } from 'core/services/isp/setting/templatecontract.service';
@Component({
  selector: 'app-contract-modal',
  templateUrl: './contract-modal.component.html',
  styleUrls: ['./contract-modal.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class ContractModalComponent implements OnInit, OnDestroy {
  public url = this.router.url;
  public urlLastValue;
  public rows;
  public currentRow;
  public tempRow;
  public loading = false;
  title: string;
  id: string;
  subscriptions: Subscription[] = [];
  // Private
  private _unsubscribeAll: Subject<any>;
  path: string;

  /**
   * Constructor
   *
   * @param {Router} router
   */

  constructor( private _service: TemplateContractService, public modal: NgbActiveModal, private router: Router, private fb: FormBuilder, private cdr: ChangeDetectorRef) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
  }

  ngOnInit(): void {
    this.getSanitazedPath(this.id);
  }

  getSanitazedPath(id: string) {
    this._service.getTemplateContractId(id).subscribe(
      (item: any) => {
        if (item) {
          this.path = item?.obj?.path;
          this.cdr.detectChanges();
        }
      },
      (error) => { },
      () => { }
    );
  }

  ngOnDestroy(): void {

  }
}

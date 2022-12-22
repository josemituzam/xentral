import { Component, OnInit, OnDestroy, ViewEncapsulation, ViewChild, ChangeDetectorRef, Input, EventEmitter, Output } from '@angular/core';
import { Router } from '@angular/router';
import {
  FormBuilder, FormGroup
} from '@angular/forms';
import { Subject, of, Subscription, Observable } from 'rxjs';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';
import Swal from 'sweetalert2'
@Component({
  selector: 'app-contract-link',
  templateUrl: './contract-link.component.html',
  styleUrls: ['./contract-link.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class ContractLinkComponent implements OnInit, OnDestroy {

  public url = this.router.url;
  public urlLastValue;
  public rows;
  public currentRow;
  public tempRow;
  public loading = false;
  subscriptions: Subscription[] = [];
  // Private
  private _unsubscribeAll: Subject<any>;
  editForm: FormGroup;
  link: string;
  /**
   * Constructor
   *
   * @param {Router} router
   */
  constructor(public modal: NgbActiveModal, private router: Router, private fb: FormBuilder, private cdr: ChangeDetectorRef) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
  }

  initForm() {
    this.editForm = this.fb.group({
      link: ['']
    });



  }

  copyCode(inputTextValue) {
    const selectBox = document.createElement('textarea');
    selectBox.style.position = 'fixed';
    selectBox.value = inputTextValue;
    document.body.appendChild(selectBox);
    selectBox.focus();
    selectBox.select();
    document.execCommand('copy');
    document.body.removeChild(selectBox);
  }


  ngOnInit(): void {
    this.initForm();
    this.editForm.controls['link'].setValue(this.link);
    this.editForm.controls['link'].disable();
  }

  ngOnDestroy(): void {

  }

}

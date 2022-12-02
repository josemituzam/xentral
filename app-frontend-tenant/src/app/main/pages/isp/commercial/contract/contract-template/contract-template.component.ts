import { Component, OnInit, OnDestroy, ViewEncapsulation, ViewChild, ChangeDetectorRef, Input } from '@angular/core';
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
//import * as ClassicEditor from '@ckeditor/ckeditor5-build-classic';
//import * as DecoupledEditor from '@ckeditor/ckeditor5-build-decoupled-document';
//import PageBreak from '@ckeditor/ckeditor5-page-break/src/pagebreak';
//import Editor from './ckeditor';
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


  //public Editor = DecoupledEditor;

  subscriptions: Subscription[] = [];
  editForm: FormGroup;


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
    this.mycontent = `<p>My html content</p>`;
  }

  // Public Methods
  // -----------------------------------------------------------------------------------------------------

  initForm() {
    this.editForm = this.fb.group({

    });

  }

  prepareItem(): any {

    return null;
  }

  /**
   * Submit
   *
   * @param form
   */
  submit() {
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
      this.cdr.detectChanges();
      return;
    }


    const editedItem = this.prepareItem();
    this.addItem(editedItem);
  }

  addItem(_item: any) {

  }

  onEditorChange(event) {
    console.log(event);
  }

  onChange(event: any): void {
    console.log(event);
    console.log(this.mycontent);
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

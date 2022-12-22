import { Component, OnInit, OnDestroy, ViewEncapsulation, ViewChild, ChangeDetectorRef } from '@angular/core';
import { NgForm } from '@angular/forms';
import { AbstractControl, Validators } from '@angular/forms';
import { FormGroup, FormBuilder } from '@angular/forms';
import { Subject, of, Subscription, Observable } from 'rxjs';
import { ActivatedRoute, Router, NavigationEnd } from '@angular/router';
import Swal from 'sweetalert2'
import { TemplateContractService } from 'core/services/isp/setting/templatecontract.service';
import { TemplateContract } from 'core/models/isp/setting/templatecontract.model';
import { catchError, delay, finalize, tap } from 'rxjs/operators';

@Component({
  selector: 'template-contract-edit',
  templateUrl: './template-contract-edit.component.html',
  styleUrls: ['./template-contract-edit.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class TemplateContractEditComponent implements OnInit, OnDestroy {
  // Public

  public url = this.router.url;
  public urlLastValue;
  public rows;
  public currentRow;
  public loading = false;
  public contentHeader: object;
  public tempRow;
  //customEditor = Editor;
  name = "ng2-ckeditor";
  ckeConfig: any;
  mycontent: string;
  log: string = "";
  @ViewChild("myckeditor") ckeditor: any;
  editForm: FormGroup;
  itemModel: any;

  // Private
  private _unsubscribeAll: Subject<any>;
  subscriptions: Subscription[] = [];

  public getTypeSize: any = [{ id: 'A4', name: 'A4' },
  { id: 'A5', name: 'A5' }];

  public getTypeOrientation: any = [{ id: 'portrait', name: 'Vertical' },
  { id: 'landscape', name: 'Horizontal' }];

  /**
   * Constructor
   *
   * @param {Router} router
   * @param {UserEditService} _userEditService
   */
  constructor(private _service: TemplateContractService, private router: Router, private activatedRoute: ActivatedRoute, private fb: FormBuilder, private cdr: ChangeDetectorRef) {
    this._unsubscribeAll = new Subject();
    this.urlLastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
  }

  // Public Methods
  // -----------------------------------------------------------------------------------------------------

  onEditorChange(event) {
    //console.log(event);
  }

  onChange(event: any): void {
    //console.log(event);
    //console.log(this.mycontent);
    //this.log += new Date() + "<br />";
  }

  initForm() {
    this.editForm = this.fb.group({
      name: [
        this.itemModel.name,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      size: [
        this.itemModel.size,
        Validators.compose([Validators.required]),
      ],
      template_code: [
        this.itemModel.template_code,
        Validators.compose([Validators.maxLength(100)]),
      ],
      orientation: [
        this.itemModel.orientation,
        Validators.compose([Validators.required]),
      ],
      html: [
        this.itemModel.html,
        Validators.compose([Validators.required]),
      ],
      margin_bottom: [
        this.itemModel.margin_bottom,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      margin_left: [
        this.itemModel.margin_left,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      margin_top: [
        this.itemModel.margin_top,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ],
      margin_right: [
        this.itemModel.margin_right,
        Validators.compose([Validators.required, Validators.maxLength(100)]),
      ]
    });
  }

  setMargin($event) {
    var margin_top = 0;
    var margin_bottom = 0;
    var margin_right = 0;
    var margin_left = 0;
    if ($event.id == 'A4') {
      margin_top = 20;
      margin_bottom = 20;
      margin_right = 25;
      margin_left = 25;
    } else {
      margin_top = 20;
      margin_bottom = 20;
      margin_right = 25;
      margin_left = 25;
    }

    this.editForm.get("margin_top").setValue(margin_top);
    this.editForm.get("margin_bottom").setValue(margin_bottom);
    this.editForm.get("margin_right").setValue(margin_right);
    this.editForm.get("margin_left").setValue(margin_left);
  }
  /**
   * Submit
   *
   * @param form
   */
  submit() {
    this.loading = true;

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
    if (this.itemModel.id) {
      this.updateItem(editedItem);
      return;
    }
    this.addItem(editedItem);
  }

  goBackWithout() {
    console.log("goBackWithout...");
    this.router.navigate(['/isp/template/contract/list'], { relativeTo: this.activatedRoute });
  }

  updateItem(_item: TemplateContract) {
    const sbUpdate = this._service.update(_item).pipe(
      catchError((errorMessage) => {
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
      }),
    ).subscribe((res: any) => {
      if (res) {
        this.goBackWithout();
        this.setMessageSuccess("Actualizado Correctamente")
      }
    });
    this.subscriptions.push(sbUpdate);
  }

  addItem(_item: TemplateContract) {
    const sbCreate = this._service.create(_item).pipe(
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
      if (res) {
        this.goBackWithout();
        this.setMessageSuccess("Guardado Correctamente")
      }
    });
    this.subscriptions.push(sbCreate);
  }

  setMessageSuccess(message: string) {
    Swal.fire({
      icon: 'success',
      title: `${message}`,
      showConfirmButton: false,
      timer: 1500
    })
  }


  prepareItem(): TemplateContract {
    const controls = this.editForm.controls;
    const _item = new TemplateContract();
    _item.clear();
    if (this.itemModel.id) {
      _item.id = this.itemModel.id;
    }
    _item.name = controls["name"].value;
    _item.template_code = controls["template_code"].value;
    _item.orientation = controls["orientation"].value;
    _item.html = controls["html"].value;
    _item.margin_bottom = controls["margin_bottom"].value;
    _item.margin_left = controls["margin_left"].value;
    _item.margin_top = controls["margin_top"].value;
    _item.margin_right = controls["margin_right"].value;
    _item.size = controls["size"].value;

    return _item;
  }

  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------
  /**
   * On init
   */
  ngOnInit(): void {
    this.itemModel = new TemplateContract();
    this.itemModel.clear();
    this.getCkEditor();
    this.initForm();
    this.setHeader("Nueva", '../../list');
    this.activatedRoute.params.subscribe((params) => {
      const id = params.id;
      if (id && id.length > 0) {
        this.setHeader("Editar", '../../list');
        this._service.getTemplateContractId(id).subscribe(
          (item: any) => {
            if (item) {
              this.itemModel = item.obj;

              this.initForm();
              this.cdr.detectChanges();
            }
          },
          (error) => { },
          () => { }
        );
      }
    });
  }


  getCkEditor() {
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


  setHeader(title: string, url: string) {
    this.contentHeader = {
      headerTitle: title + " plantilla",
      actionButton: true,
      breadcrumb: {
        type: "",
        links: [
          {
            name: "Registros",
            isLink: true,
            link: url,
          },
        ],
      },
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

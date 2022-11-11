// Angular
import { Component, OnInit, Inject, ChangeDetectionStrategy, OnDestroy, Input, NgZone, Output, EventEmitter } from '@angular/core';


// Lodash
import * as _lodash from 'lodash';
// RxJS
import { Observable, of, Subscription, forkJoin } from 'rxjs';
// Lodash
import { each, find, some } from 'lodash';
//import { Content } from 'src/app/core/pms';

import { AbstractControl, Validators } from '@angular/forms';
import { FormGroup, FormBuilder } from '@angular/forms';

import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';

// Translate
import { TranslateService } from '@ngx-translate/core';

// Services and Models


declare const Tagify: any;

import Swal from 'sweetalert2/dist/sweetalert2.js';

@Component({
	selector: 'kt-content-edit-dialog',
	templateUrl: './content-edit.dialog.component.html',
	changeDetection: ChangeDetectionStrategy.Default,
})
export class ContentEditDialogComponent implements OnInit, OnDestroy {

	// Public properties
	hasFormErrors: boolean = false;
	viewLoading: boolean = false;
	loadingAfterSubmit: boolean = false;


	uploadFileForm: FormGroup;

	referenceId: string;
	type: string;
	contentId: string;
	description: string;

	tagObs: Observable<any>[];

	@Input() title;

	keywords: any;

	//@Output() dataReturn = new EventEmitter<any>();

	//listDocumentsStore: any[] = [];


	// Private properties
	private componentSubscriptions: Subscription;

	/**
	 * Component constructor
	 *
	 * @param dialogRef: MatDialogRef<RoleEditDialogComponent>
	 * @param data: any
	 * @param store: Store<AppState>
	 */
	constructor(
		public activeModal: NgbActiveModal,
		private zone: NgZone,
		private fb: FormBuilder,
		private translate: TranslateService,
	) { }

	/**
	 * @ Lifecycle sequences => https://angular.io/guide/lifecycle-hooks
	 */

	/**
	 * On init
	 */
	ngOnInit() {


		this.createForm();



	}



	/**
	 * Init form
	 */
	createForm() {

		this.uploadFileForm = this.fb.group({
			//filename: [{value: this.content.filename, disabled: this.content.id.length > 0}],
			filename: [''],
			description: [{ value: this.description, disabled: this.contentId }, Validators.required],
			contentFile: [{ value: '', disabled: this.contentId }, Validators.required]
		});
	}

	/**
	 * Reset
	 */
	reset() {
		this.hasFormErrors = false;
		//this.loadingSubject.next(false);
		this.uploadFileForm.markAsPristine();
		this.uploadFileForm.markAsUntouched();
		this.uploadFileForm.updateValueAndValidity();
	}

	onFileChange(event) {

		if (event.target.files.length > 0) {
			console.log("se seteo valor de file");
			const file = event.target.files[0];
			const name = file.name;
			this.uploadFileForm.get('contentFile').setValue(file);
			this.uploadFileForm.get('filename').setValue(name);
		}
	}

	getTextSelect(): string {

		if (this.uploadFileForm.get('filename').value) {
			// tslint:disable-next-line:no-string-throw
			return this.uploadFileForm.get('filename').value;
		}

		// tslint:disable-next-line:no-string-throw
		return 'Seleccionar archivo';
	}


	/**
	 * On destroy
	 */
	ngOnDestroy() {
		if (this.componentSubscriptions) {
			this.componentSubscriptions.unsubscribe();
		}
	}

	/**
	 * Save data
	 */
	onSubmit() {




	}

	savePermissions(roleId: number) {
	}



	/**
	 * Close alert
	 *
	 * @param $event: Event
	 */
	onAlertClose($event) {
		this.hasFormErrors = false;
	}



	/** UI */
	/**
	 * Returns component title
	 */
	getTitle(): string {

		if (this.contentId) {
			return `Editar contenido`;
		}

		// tslint:disable-next-line:no-string-throw
		return 'Nuevo Documento';
	}



	getTextSaveButton(): string {

		if (this.contentId) {
			// tslint:disable-next-line:no-string-throw
			return `Grabar`;
		}

		// tslint:disable-next-line:no-string-throw
		return 'Agregar';
	}

	isValidField(controlName: string): boolean {
		if (this.uploadFileForm) {
			const control = this.uploadFileForm.controls[controlName];
			const result = control.invalid && (control.dirty || control.touched);
			return result;
		}

	}

	/**
	   * Checking control validation
	   *
	   * @param controlName: string => Equals to formControlName
	   * @param validationType: string => Equals to valitors name
	   */
	isControlHasError(controlName: string, validationType: string): boolean {

		if (this.uploadFileForm) {
			const control = this.uploadFileForm.controls[controlName];
			if (!control) {
				return false;
			}

			const result = control.hasError(validationType) && (control.dirty || control.touched);
			return result;
		}

	}



}

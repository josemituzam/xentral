// Angular
import { Component, OnInit, Inject, ChangeDetectionStrategy, OnDestroy, Input, NgZone, Output, EventEmitter } from '@angular/core';


// Lodash
import * as _lodash from 'lodash';
// RxJS
import { Observable, of, Subscription, forkJoin } from 'rxjs';
//import { Content } from 'src/app/core/pms';
import { FileUploader } from 'ng2-file-upload';
import { AbstractControl, Validators } from '@angular/forms';
import { FormGroup, FormBuilder } from '@angular/forms';
import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';

// Translate
import { TranslateService } from '@ngx-translate/core';

// Services and Models
const URL = 'https://your-url.com';
@Component({
	selector: 'app-document-edit',
	templateUrl: './document-edit.component.html',
	styleUrls: ['./document-edit.component.scss'],
	changeDetection: ChangeDetectionStrategy.Default,
})
export class DocumentEditComponent implements OnInit, OnDestroy {

	// Public properties
	hasFormErrors: boolean = false;
	viewLoading: boolean = false;
	loadingAfterSubmit: boolean = false;

	public uploader: FileUploader = new FileUploader({
		url: URL,
		isHTML5: true
	});

	public hasAnotherDropZoneOver: boolean = false;
	public hasBaseDropZoneOver: boolean = false;
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
		public modal: NgbActiveModal,
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


		//this.createForm();



	}


	fileOverBase(e: any): void {
		this.hasBaseDropZoneOver = e;
	}

	fileOverAnother(e: any): void {
		this.hasAnotherDropZoneOver = e;
	}

	public onFileSelected(event: EventEmitter<File[]>) {
		const file: File = event[0];

		console.log(file);

		this.readBase64(file)
			.then(function (data) {
				console.log(data);
			})

	}

	public readBase64(file): Promise<any> {
		var reader = new FileReader();
		var future = new Promise((resolve, reject) => {
			reader.addEventListener("load", function () {
				resolve(reader.result);
			}, false);

			reader.addEventListener("error", function (event) {
				reject(event);
			}, false);

			reader.readAsDataURL(file);
		});
		return future;
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

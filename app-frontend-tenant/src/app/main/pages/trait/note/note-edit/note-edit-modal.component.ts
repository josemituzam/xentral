// Angular
import { Component, OnInit, Inject, ChangeDetectionStrategy, OnDestroy, Input, NgZone, Output , EventEmitter } from '@angular/core';


// Lodash
import * as _lodash from 'lodash';
// RxJS
import { Observable, of, Subscription,forkJoin} from 'rxjs';
// Lodash
import { each, find, some } from 'lodash';
//import { Comment } from 'src/app/core/pms';

import { AbstractControl, Validators } from '@angular/forms';
import { FormGroup, FormBuilder } from '@angular/forms';

import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';

// Translate
import { TranslateService } from '@ngx-translate/core';

// Services and Models
import {
	Comment,
	Tag,
	CommentService
} from '../../../../core/pms';

declare const Tagify: any;

@Component({
	selector: 'kt-comment-edit-dialog',
	templateUrl: './comment-edit.dialog.component.html', 
	changeDetection: ChangeDetectionStrategy.Default,
})
export class CommentEditDialogComponent implements OnInit, OnDestroy { 
	
	// Public properties
	comment: Comment;
	comment$: Observable<Comment>;
	hasFormErrors: boolean = false;
	viewLoading: boolean = false;
	loadingAfterSubmit: boolean = false;


	commentFileForm: FormGroup;

	referenceId: string;
	type : string;
	commentId: string;
	name: string;

	tagListStore: Tag[] = [];
	tagList: Tag[] = [];

	tagObs : Observable<any>[];


	tagListAdd: Tag[] = [];
	tagListRemove: Tag[] = [];


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
		private commentServices: CommentService,
		private translate: TranslateService,
		) { }

	/**
	 * @ Lifecycle sequences => https://angular.io/guide/lifecycle-hooks
	 */

	/**
	 * On init
	 */
	ngOnInit() {

		
		this.comment = new Comment();
		this.comment.clear();
		this.createForm();

		
		

		
	}

	/**
	 * Init form
	 */
	createForm() {

		this.commentFileForm = this.fb.group({
			name: [ this.name , Validators.required]
		});
	}

	/**
	 * Reset
	 */
	reset() {
		this.hasFormErrors = false;
		//this.loadingSubject.next(false);
		this.commentFileForm.markAsPristine();
		this.commentFileForm.markAsUntouched();
		this.commentFileForm.updateValueAndValidity();
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
		this.hasFormErrors = false;
		this.loadingAfterSubmit = false;

		this.hasFormErrors = false;
		const controls = this.commentFileForm.controls;
		/** check form */
		if (this.commentFileForm.invalid) {
			Object.keys(controls).forEach(controlName => {
				console.log("invalid editForm "+controlName+" = ",controls[controlName].status);
				controls[controlName].markAsTouched()
			}
				
			);
			this.hasFormErrors = true;

			return;
		}


		
		let comment = new Comment();
		comment.name = controls['name'].value;
		comment.moduleShortCode = this.type;
		comment.referenceId = this.referenceId;
		comment.id = this.commentId

		this.commentServices.updateComment(comment).subscribe(result => {
			console.log("updateComment: ", result);

			this.createForm();
			this.commentFileForm.markAsPristine();
			this.commentFileForm.markAsUntouched();
			this.commentFileForm.updateValueAndValidity();

			this.activeModal.close('ok');
			
		},
			error => {

			},
			() => {

			}
		);
		
		


	}

	savePermissions(roleId: number){
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
		
		if (this.commentId) {
			return `Editar contenido`;
		}

		// tslint:disable-next-line:no-string-throw
		return 'Nuevo Documento';
	}

	/**
	 * Returns is title valid
	 */
	isTitleValid(): boolean {
		return (this.comment && this.comment.name && this.comment.name.length > 0);
	}


	getTextSaveButton(): string {
		
		if (this.commentId) {
			// tslint:disable-next-line:no-string-throw
			return `Grabar`;
		}

		// tslint:disable-next-line:no-string-throw
		return 'Agregar';
	}

	isValidField(controlName: string): boolean {
		if (this.commentFileForm) {
			const control = this.commentFileForm.controls[controlName];
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

		if (this.commentFileForm) {
			const control = this.commentFileForm.controls[controlName];
			if (!control) {
				return false;
			}

			const result = control.hasError(validationType) && (control.dirty || control.touched);
			return result;
		}

	}


	
}

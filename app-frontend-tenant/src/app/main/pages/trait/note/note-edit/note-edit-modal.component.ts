// Angular
import {
	Component,
	OnInit,
	Input,
	OnDestroy,
	ChangeDetectorRef,
	ChangeDetectionStrategy,
} from '@angular/core';

// Lodash
import * as _lodash from 'lodash';
// RxJS
import { Observable, of, Subscription, forkJoin } from 'rxjs';
// Lodash
import { catchError, delay, finalize, tap } from 'rxjs/operators';
//import { Comment } from 'src/app/core/pms';

import { AbstractControl, Validators } from '@angular/forms';
import { FormGroup, FormBuilder } from '@angular/forms';

import { NgbActiveModal } from '@ng-bootstrap/ng-bootstrap';

// Translate
import { TranslateService } from '@ngx-translate/core';
import { Note } from 'core/models/note.model';
import { NoteService } from 'core/services/note.service';

import Swal from 'sweetalert2'
declare const Tagify: any;

@Component({
	selector: 'app-note-edit-modal',
	templateUrl: './note-edit-modal.component.html',
	changeDetection: ChangeDetectionStrategy.Default,
})
export class NoteEditComponent implements OnInit, OnDestroy {

	// Public propertie
	hasFormErrors: boolean = false;
	itemModel: Note;
	public loading = false;
	private subscriptions: Subscription[] = [];

	editForm: FormGroup;

	referenceId: string;
	type: string;
	note: string;
	id: string;



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
		private cdr: ChangeDetectorRef,
		private _service: NoteService,
		public modal: NgbActiveModal,
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
		this.itemModel = new Note();
		this.itemModel.clear();
		this.initForm();
	}

	/**
	 * Init form
	 */
	initForm() {
		this.editForm = this.fb.group({
			note: [this.note, Validators.compose([Validators.maxLength(300), Validators.required])]
		});
	}


	/**
	 * Reset
	 */
	reset() {
		this.hasFormErrors = false;
		//this.loadingSubject.next(false);
		this.editForm.markAsPristine();
		this.editForm.markAsUntouched();
		this.editForm.updateValueAndValidity();
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
		this.updateItem(editedItem);

	}

	updateItem(_item: Note) {
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
				this.loading = false;
				this.setMessageSuccess("Actualizado Correctamente")
				this.modal.close()
			}
		});
		this.subscriptions.push(sbUpdate);
	}

	setMessageSuccess(message: string) {
		Swal.fire({
			icon: 'success',
			title: `${message}`,
			showConfirmButton: false,
			timer: 1500
		})
	}

	prepareItem(): Note {
		const controls = this.editForm.controls;
		const _item = new Note();
		_item.clear();
		_item.id = this.id;
		_item.reference_id = this.referenceId;
		_item.note = controls['note'].value;
		_item.module_short_code = this.type;
		return _item;
	}



	/**
	 * Close alert
	 *
	 * @param $event: Event
	 */
	onAlertClose($event) {
		this.hasFormErrors = false;
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

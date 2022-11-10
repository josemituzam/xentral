import { AfterViewInit, AfterViewChecked, NgZone } from '@angular/core';
// Angular
import { Component, OnInit, ElementRef, ViewChild, ChangeDetectionStrategy, OnDestroy, ChangeDetectorRef, Input } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { CoreConfigService } from '@core/services/config.service';
// RXJS
import { catchError, delay, finalize, tap } from 'rxjs/operators';
import { fromEvent, merge, Observable, of, Subscription } from 'rxjs';
// LODASH
import { each, find } from 'lodash';

import Swal from 'sweetalert2/dist/sweetalert2.js';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { FormGroup, Validators, FormBuilder } from '@angular/forms';
import { Note } from 'core/models/note.model';
import { NoteService } from 'core/services/note.service';
import { TypesUtilsService } from 'core/helpers/types-utils.service';

@Component({
	selector: 'app-note-list',
	templateUrl: './note-list.component.html',
	changeDetection: ChangeDetectionStrategy.OnPush
})
export class NoteListComponent implements OnInit, OnDestroy {
	private subscriptions: Subscription[] = [];
	editForm: FormGroup;
	@Input() referenceId: string;
	@Input() type: string;
	noteList: Comment[];
	itemModel: Note;
	public loading = false;

	/**
	 *
	 * @param activatedRoute: ActivatedRoute
	 * @param store: Store<AppState>
	 * @param router: Router
	 * @param layoutUtilsService: LayoutUtilsService
	 * @param subheaderService: SubheaderService
	 */
	constructor(
		private modalService: NgbModal,
		private fb: FormBuilder,
		private cdr: ChangeDetectorRef,
		private _service: NoteService,
		private typesUtilsService: TypesUtilsService) { }


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
		this.addItem(editedItem);
	}


	isActiveNew(note: any) {
		return this.typesUtilsService.dateEqualsToday(note.created_at);
	}

	isUpdateNote(note: any) {

		var created = new Date(note.created_at);
		var updated = new Date(note.updated_at);

		if (created.getTime() == updated.getTime()) {
			return false;
		} else {
			return true;
		}
	}


	getNotes(referenceId, type) {

		this.noteList = [];

		this._service.getNotes(referenceId, type).subscribe(res => {
			this.noteList = res;
			console.log("this.commentList: ", this.noteList);

			console.log("loadComments detectChanges");
			this.cdr.detectChanges();

		},
			error => {
				this.cdr.detectChanges();
			},
			() => {
				this.cdr.detectChanges();
			}
		);
	}

	addItem(_item: Note) {
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
				this.loading = false;
				this.setMessageSuccess("Guardado Correctamente")
				this.getNotes('a30e0dbe-8214-4470-9779-4e907bc9507a', this.type);
				this.editForm.reset();
				this.cdr.detectChanges();
			}
		});
		this.subscriptions.push(sbCreate);
	}

	editItem() {

	}

	setMessageSuccess(message: string) {
		Swal.fire({
			icon: 'success',
			title: `${message}`,
			showConfirmButton: false,
			timer: 1500
		})
	}


	deleteItem(id) {

	}

	ngOnInit(): void {
		this.itemModel = new Note();
		this.itemModel.clear();
		this.initForm();

		this.getNotes('a30e0dbe-8214-4470-9779-4e907bc9507a', this.type)
	}

	/**
	 * Init form
	 */
	initForm() {
		this.editForm = this.fb.group({
			note: ['', Validators.required]
		});
	}

	prepareItem(): Note {
		const controls = this.editForm.controls;
		const _item = new Note();
		_item.clear();
		_item.note = controls['note'].value;
		_item.module_short_code = this.type;
		_item.reference_id = 'a30e0dbe-8214-4470-9779-4e907bc9507a';
		return _item;
	}



	/**
	 * On Destroy
	 */
	ngOnDestroy() {
		this.subscriptions.forEach(el => el.unsubscribe());
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

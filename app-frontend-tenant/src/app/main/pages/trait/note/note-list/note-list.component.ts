import { AfterViewInit, AfterViewChecked, NgZone } from '@angular/core';
// Angular
import { Component, OnInit, ElementRef, ViewChild, ChangeDetectionStrategy, OnDestroy, ChangeDetectorRef, Input } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { CoreConfigService } from '@core/services/config.service';
// RXJS
import { debounceTime, distinctUntilChanged, tap, skip, take, delay, mergeMap } from 'rxjs/operators';
import { fromEvent, merge, Observable, of, Subscription } from 'rxjs';
// LODASH
import { each, find } from 'lodash';

import Swal from 'sweetalert2/dist/sweetalert2.js';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { FormGroup, Validators, FormBuilder } from '@angular/forms';
import { DatePipe } from '@angular/common';


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
	commentList: Comment[];

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
		private _coreConfigService: CoreConfigService,) { }

	/**
	 * Redirect to edit page
	 *
	 * @param id: any
	 */
	editItem(id, name) {

	}

	addItem() {

	}


	deleteItem(id) {

	}

	ngOnInit(): void {

	}

	/**
	 * Init form
	 */
	createForm() {

	}


	/**
	 * On Destroy
	 */
	ngOnDestroy() {
		this.subscriptions.forEach(el => el.unsubscribe());
	}

}

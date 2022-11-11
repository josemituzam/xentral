import { AfterViewInit, AfterViewChecked, NgZone } from '@angular/core';
// Angular
import { Component, OnInit, ElementRef, ViewChild, ChangeDetectionStrategy, OnDestroy, ChangeDetectorRef, Input } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

// RXJS
import { debounceTime, distinctUntilChanged, tap, skip, take, delay, mergeMap } from 'rxjs/operators';
import { fromEvent, merge, Observable, of, Subscription } from 'rxjs';
// LODASH
import { each, find } from 'lodash';

// Services

// Models

// Services
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';

@Component({
	selector: 'app-document-list',
	templateUrl: './document-list.component.html',
	changeDetection: ChangeDetectionStrategy.OnPush
})
export class DocumentListComponent implements OnInit, OnDestroy {


	KTTableObj: any;

	//allRoles: Role[] = [];

	// Subscriptions
	private subscriptions: Subscription[] = [];


	@Input() referenceId: number;

	@Input() type: string;

	/**
	 *
	 * @param activatedRoute: ActivatedRoute
	 * @param store: Store<AppState>
	 * @param router: Router
	 * @param layoutUtilsService: LayoutUtilsService
	 * @param subheaderService: SubheaderService
	 */
	constructor(
		private activatedRoute: ActivatedRoute,
		//private store: Store<AppState>,
		private router: Router,
		private cdr: ChangeDetectorRef,
		private ngZone: NgZone,
		private modalService: NgbModal) { }

	/**
	 * Redirect to edit page
	 *
	 * @param id: any
	 */
	downloadItem(id, filename) {
		console.log("downloadItem: " + id);
		//this.router.navigate(['../companies/edit', id], { relativeTo: this.activatedRoute });

		//window.open(this.contentServices.getURLDownload(id));
		


	}

	/**
	 * Redirect to edit page
	 *
	 * @param id: any
	 */
	editItem(id, description) {
		
	}

	addItem() {
	
	}


	deleteItem(id, name) {
	


	}

	//ngAfterViewInit(): void {

	ngOnInit(): void {


	}


	/**
	 * On Destroy
	 */
	ngOnDestroy() {
		this.subscriptions.forEach(el => el.unsubscribe());
	}




}

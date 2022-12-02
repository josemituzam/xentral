import { AfterViewInit, AfterViewChecked, NgZone } from '@angular/core';
// Angular
import { Component, OnInit, ElementRef, ViewChild, ChangeDetectionStrategy, OnDestroy, ChangeDetectorRef, Input } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { FileUploader } from 'ng2-file-upload';
import { Subscription } from 'rxjs';

import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { DocumentEditComponent } from '../document-edit/document-edit.component';

const URL = 'https://your-url.com';

@Component({
	selector: 'app-document-list',
	templateUrl: './document-list.component.html',
	styleUrls: ['./document-list.component.scss'],
	changeDetection: ChangeDetectionStrategy.OnPush
})
export class DocumentListComponent implements OnInit, OnDestroy {


	public uploader: FileUploader = new FileUploader({
		url: URL,
		isHTML5: true
	});

	private subscriptions: Subscription[] = [];


	@Input() referenceId: number;

	@Input() type: string;
	public hasAnotherDropZoneOver: boolean = false;
	public hasBaseDropZoneOver: boolean = false;
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
	addItem() {

		const modalRef = this.modalService.open(DocumentEditComponent, {
			centered: true,
			backdrop: 'static',
			size: 'lg' // size: 'xs' | 'sm' | 'lg' | 'xl'
		});
		modalRef.result.then(() => {

		});

	}

	fileOverBase(e: any): void {
		this.hasBaseDropZoneOver = e;
	}

	fileOverAnother(e: any): void {
		this.hasAnotherDropZoneOver = e;
	}
	/**
	 * Redirect to edit page
	 *
	 * @param id: any
	 */
	editItem(id, description) {

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

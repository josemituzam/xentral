import { Component, OnInit, OnDestroy } from '@angular/core';

import { Subject } from 'rxjs';
import { takeUntil } from 'rxjs/operators';

@Component({
  selector: 'app-main-red',
  templateUrl: './main-red.component.html',
  styleUrls: ['./main-red.component.scss']
})
export class MainRedComponent implements OnInit, OnDestroy {
  // public
  public data: any;

  Monthly = false;

  // private
  private _unsubscribeAll: Subject<any>;

  /**
   * Constructor
   *
   * @param {PricingService} _pricingService
   */
  constructor() {
    this._unsubscribeAll = new Subject();
  }

  ngOnInit(): void {
    /*this._pricingService.onPricingChanged.pipe(takeUntil(this._unsubscribeAll)).subscribe(response => {
      this.data = response;
    });*/
  }

  /**
   * On destroy
   */
  ngOnDestroy(): void {
    // Unsubscribe from all subscriptions
    this._unsubscribeAll.next();
    this._unsubscribeAll.complete();
  }
}

import { Component, OnDestroy, OnInit, ViewEncapsulation } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { RequestDomain } from 'app/core/models/request-domain.model';
import { Service } from 'app/core/models/service.model';
import { RequestDomainService } from 'app/core/services';
import { Observable, of, Subscription, Subject } from 'rxjs';
import { catchError, switchMap, tap } from 'rxjs/operators';

@Component({
  selector: 'app-request-domain-view',
  templateUrl: './request-domain-view.component.html',
  styleUrls: ['./request-domain-view.component.scss'],
  encapsulation: ViewEncapsulation.None
})
export class RequestDomainViewComponent implements OnInit, OnDestroy {
  // public
  id: string;
  public url = this.router.url;
  itemModel: RequestDomain;
  public lastValue;
  public data;
  subscriptions: Subscription[] = [];
  serviceList: Service[];

  // private
  private _unsubscribeAll: Subject<any>;

  /**
   * Constructor
   *
   * @param {Router} router
   * @param {UserViewService} _userViewService
   */
  constructor(private router: Router,
    private route: ActivatedRoute,
    private _service: RequestDomainService) {
    this._unsubscribeAll = new Subject();
    this.lastValue = this.url.substr(this.url.lastIndexOf('/') + 1);
  }

  // Lifecycle Hooks
  // -----------------------------------------------------------------------------------------------------
  /**
   * On init
   */
  ngOnInit(): void {
    this.load();
  }

  load() {
    const sb = this.route.paramMap.pipe(
      switchMap(params => {
        console.log(params.get('id'))
        // get id from URL
        this.id = params.get('id');
        if (this.id) {
          return this._service.getRequestDomainById(this.id);
        }
        return of(null);
      }),
      catchError((errorMessage) => {
        // this.errorMessage = errorMessage;
        return of(undefined);
      }),
    ).subscribe((res: any) => {
      if (!res) {
        this.router.navigate(['/request-domain/list'], { relativeTo: this.route });
      }

      console.log(res);

      this.itemModel = res;

    });
    this.subscriptions.push(sb);
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

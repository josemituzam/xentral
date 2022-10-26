import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, Resolve, RouterStateSnapshot } from '@angular/router';
import { environment } from 'environments/environment';
import { BehaviorSubject, Observable, of, forkJoin, EMPTY } from 'rxjs';
import { HttpClient, HttpHeaders } from "@angular/common/http";


import { catchError, map, mergeMap, expand, switchMap, tap } from 'rxjs/operators';

@Injectable()
export class ResquestdomainListService {
  public rows: any;
  public recordListChange: BehaviorSubject<any>;
  API: string;
  API_REQUEST_DOMAIN_URL: string;
  /**
   *
   * @param {HttpClient} _http
   */

  protected readonly REST_API: string = environment.apiUrl;

  /**
   * Constructor
   *
   * @param {HttpClient} _httpClient
   */
  constructor(private _httpClient: HttpClient) {
    this.API_REQUEST_DOMAIN_URL = `${this.REST_API}/request-domain`;
    // Set the defaults
    this.recordListChange = new BehaviorSubject({});
  }

  /**
   * Resolver
   *
   * @param {ActivatedRouteSnapshot} route
   * @param {RouterStateSnapshot} state
   * @returns {Observable<any> | Promise<any> | any}
   */
   putActive(obj: any): Observable<any> {
    const httpHeaders = new HttpHeaders();
    httpHeaders.set('Content-Type', 'application/json');
    return this._httpClient.put(this.API_REQUEST_DOMAIN_URL + `/active/${obj.id}`, obj, { headers: httpHeaders });
  }

  putApproved(obj: any): Observable<any> {
    const httpHeaders = new HttpHeaders();
    httpHeaders.set('Content-Type', 'application/json');
    return this._httpClient.put(this.API_REQUEST_DOMAIN_URL + `/approved/${obj.id}`, obj, { headers: httpHeaders });
  }

  /**
   * Get rows
   */

  getDataTableRows(searchQuery: string, perPage: number, currentPage: number, sortBy: string, is_active: string, is_approved: string): Observable<any[]> {
    return this._httpClient.get<any>(this.API_REQUEST_DOMAIN_URL
      + `/index?q=${searchQuery}&perPage=${perPage}&page=${currentPage}&sortBy=${sortBy}&is_active=${is_active}&is_approved=${is_approved}`).pipe(
        mergeMap((res) => {
          return of(res);
        })
      );
  }
}

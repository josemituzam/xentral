import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, Resolve, RouterStateSnapshot } from '@angular/router';
import { environment } from 'environments/environment';
import { BehaviorSubject, Observable, of, forkJoin, EMPTY } from 'rxjs';
import { HttpClient, HttpHeaders } from "@angular/common/http";


import { catchError, map, mergeMap, expand, switchMap, tap } from 'rxjs/operators';

@Injectable()
export class TemplateContractListService {
  public rows: any;
  public recordListChange: BehaviorSubject<any>;
  API: string;
  API_SERVICE_URL: string;
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
    this.API_SERVICE_URL = `${this.REST_API}/template/contract`;
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
    return this._httpClient.put(this.API_SERVICE_URL + `/active/${obj.id}`, obj, { headers: httpHeaders });
  }
  /**
   * Get rows
   */

  getDataTableRows(searchQuery: string, perPage: number, currentPage: number, sortBy: string, is_active: string): Observable<any[]> {
    return this._httpClient.get<any>(this.API_SERVICE_URL
      + `/index?q=${searchQuery}&perPage=${perPage}&page=${currentPage}&sortBy=${sortBy}&is_active=${is_active}`).pipe(
        mergeMap((res) => {
          return of(res);
        })
      );
  }

  downloadPdf(name: any, id: any): Observable<any> {
    const httpHeaders = new HttpHeaders();
    httpHeaders.set('Accept', `application/octet-stream`);
    return this._httpClient.get(`${this.API_SERVICE_URL}/pdf/${id}`, { headers: httpHeaders, responseType: "blob" }).pipe(
      map((report: any) => {
        console.log("view download object: ", report);
        const a = document.createElement('a');
        document.body.appendChild(a);
        const blob: any = new Blob([report], { type: 'octet/stream' });
        const url = URL.createObjectURL(blob);
        console.log("url servi: ", url);
        a.href = url;
        a.download = `${name}.pdf`;
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
        return url;
      })
    );

    //return this._httpClient.get<any>(`${this.API_SERVICE_URL}/pdf/${id}`);

    /* return this._httpClient.get<any>(`${this.API_SERVICE_URL}/pdf/${id}`).pipe(
       mergeMap(res => {
         return of(res);
       })
     );*/
  }

  delete(id: string): Observable<any> {
    return this._httpClient.delete<any>(`${this.API_SERVICE_URL}/${id}`);
  }
}

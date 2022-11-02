import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { Observable, BehaviorSubject, of, Subscription } from 'rxjs';
import { environment } from 'environments/environment';
import { User } from 'app/auth/models';
import { RequestDomain } from '../models/request-domain.model';
import { map, mergeMap } from "rxjs/operators";

@Injectable({ providedIn: 'root' })
export class RequestDomainService {
  API: string;
  API_REQUEST_DOMAIN_URL: string;
  /**
   *
   * @param {HttpClient} _http
   */

  protected readonly REST_API: string = environment.apiUrl;

  constructor(private _http: HttpClient) {
    this.API_REQUEST_DOMAIN_URL = `${this.REST_API}/request-domain`;
  }

  /**
   * Get all users
   */
  create(data: RequestDomain): Observable<any> {
    const httpHeaders = new HttpHeaders();
    httpHeaders.set("Content-Type", "application/json");
    return this._http.post<any>(`${this.API_REQUEST_DOMAIN_URL}/store`, data, {
      headers: httpHeaders,
    });
  }

  update(data: RequestDomain): Observable<any> {
    const httpHeaders = new HttpHeaders();
    httpHeaders.set("Content-Type", "application/json");
    return this._http.put(
      `${this.API_REQUEST_DOMAIN_URL}/${data.id}/update`,
      data,
      { headers: httpHeaders }
    );
  }

  getDomainServices(id: any): Observable<any[]> {
    return this._http
      .get<any>(
        `${this.API_REQUEST_DOMAIN_URL}/service/${id}`,
      )
      .pipe(
        mergeMap((res) => {
          return of(res);
        })
      );
  }

  putDomainServices(data: any): Observable<any> {
    const httpHeaders = new HttpHeaders();
    httpHeaders.set("Content-Type", "application/json");
    return this._http.put(
      `${this.API_REQUEST_DOMAIN_URL}/service/${data.request_domain_id}/domain`,
      data,
      { headers: httpHeaders }
    );
  }


  delete(id: string): Observable<any> {
    return this._http.delete<any>(`${this.API_REQUEST_DOMAIN_URL}/${id}`);
  }

  getRequestDomainById(id: string): Observable<any> {
    return this._http.get<any>(`${this.API_REQUEST_DOMAIN_URL}/${id}/edit`);
  }
}

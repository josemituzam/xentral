import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { Observable, BehaviorSubject, of, Subscription } from 'rxjs';
import { environment } from 'environments/environment';
import { User } from 'app/auth/models';
import { RequestDomain } from '../models/request-domain.model';

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
   create(data: RequestDomain): Observable<RequestDomain> {
    const httpHeaders = new HttpHeaders();
    httpHeaders.set("Content-Type", "application/json");
    return this._http.post<any>(this.API_REQUEST_DOMAIN_URL + '/store', data,  {
      headers: httpHeaders,
    });
  }
  /*
  getById(id: number) {
    return this._http.get<User>(`${environment.apiUrl}/users/${id}`);
  }*/
}

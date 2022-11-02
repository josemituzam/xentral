import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { environment } from 'environments/environment';
import { Observable, of, forkJoin, EMPTY } from "rxjs";
import { map, mergeMap } from "rxjs/operators";
import { Service } from '../models/service.model';


@Injectable({ providedIn: 'root' })
export class ServiceService {
  API: string;
  API_SERVICE_URL: string;
  /**
   *
   * @param {HttpClient} _http
   */

  protected readonly REST_API: string = environment.apiUrl;

  constructor(private _http: HttpClient) {
    this.API_SERVICE_URL = `${this.REST_API}/service`;
  }

  getServices(): Observable<Service[]> {
    return this._http
      .get<any>(
        `${this.API_SERVICE_URL}/index?all`,
      )
      .pipe(
        mergeMap((res) => {
          return of(res.obj);
        })
      );
  }



  /**
   * Get all users
   */
  create(data: Service): Observable<any> {
    const httpHeaders = new HttpHeaders();
    httpHeaders.set("Content-Type", "application/json");
    return this._http.post<any>(`${this.API_SERVICE_URL}/store`, data, {
      headers: httpHeaders,
    });
  }

  update(data: Service): Observable<any> {
    const httpHeaders = new HttpHeaders();
    httpHeaders.set("Content-Type", "application/json");
    return this._http.put(
      `${this.API_SERVICE_URL}/${data.id}/update`,
      data,
      { headers: httpHeaders }
    );
  }

  delete(id: string): Observable<any> {
    return this._http.delete<any>(`${this.API_SERVICE_URL}/${id}`);
  }

}

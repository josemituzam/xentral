import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { environment } from 'environments/environment';
import { catchError, map, mergeMap, expand, switchMap, tap } from 'rxjs/operators';
import { concat, Observable, of, Subject, throwError } from 'rxjs';
import { IspCustomer } from 'core/models/isp/commercial/ispcustomer.model';



@Injectable({ providedIn: 'root' })
export class IspCustomerService {
    API: string;
    API_SERVICE_URL: string;
    /**
     *
     * @param {HttpClient} _http
     */

    protected readonly REST_API: string = environment.apiUrl;

    constructor(private _http: HttpClient) {
        this.API_SERVICE_URL = `${this.REST_API}/ispcustomer`;
    }

    /**
     * Get all users
     */
    create(data: IspCustomer): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set("Content-Type", "application/json");
        return this._http.post<any>(`${this.API_SERVICE_URL}/store`, data, {
            headers: httpHeaders,
        });
    }

    update(data: IspCustomer): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set("Content-Type", "application/json");
        return this._http.put(
            `${this.API_SERVICE_URL}/${data.id}/update`,
            data,
            { headers: httpHeaders }
        );
    }

    /**
    * Get all users
    */
    createContactCustomer(data: any): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set("Content-Type", "application/json");
        return this._http.post<any>(`${this.API_SERVICE_URL}/contact/store`, data, {
            headers: httpHeaders,
        });
    }

    getCustomerId(id: string): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/${id}/edit`);
    }
    getContactCustomer(id: string): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/contact/${id}/edit`);
    }
    getFiles(customerId: string): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/files/${customerId}`);
    }


    updateFiles(data: any): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set("Content-Type", "application/json");
        return this._http.post<any>(`${this.API_SERVICE_URL}/files/update`, data, {
            headers: httpHeaders,
        });
    }


    validateFile(customerId: string): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/files/${customerId}/validate`);
    }

    validateContact(customerId: string): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/contact/${customerId}/validate`);
    }

    validateCustomer(ide: string, type: string): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/customer/${ide}/${type}/validate`);
    }

    /*  validateCustomer(term: string = null, type: string): Observable<any> {
          return this._http
              .get<any>(`${this.API_SERVICE_URL}/customer/validate?q=` + term + '&type=' + type)
              .pipe(map(resp => {
                  if (resp.Error) {
                      throwError(resp.Error);
                  } else {
                      return resp;
                  }
              })
              );
      }*/
}

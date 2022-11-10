import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { environment } from 'environments/environment';
import { Observable } from "rxjs";
import { IspCustomer } from 'core/models/ispcustomer.model';



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

    /**
    * Get all users
    */
    createContactCustomer(data: any): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set("Content-Type", "application/json");
        return this._http.post<any>(`${this.API_SERVICE_URL}/contact`, data, {
            headers: httpHeaders,
        });
    }

}

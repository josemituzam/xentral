import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { environment } from 'environments/environment';
import { Observable } from "rxjs";
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

    uploadContent(data: any): Observable<any> {
        // Note: Add headers if needed (tokens/bearer)
        const httpHeaders = new HttpHeaders();
        httpHeaders.set('Content-Type', 'multipart/form-data');
        return this._http.post<any>(`${this.API_SERVICE_URL}/documents`, data, { headers: httpHeaders });
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

}

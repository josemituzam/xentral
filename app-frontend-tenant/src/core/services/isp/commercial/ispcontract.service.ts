import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { environment } from 'environments/environment';
import { catchError, map, mergeMap, expand, switchMap, tap } from 'rxjs/operators';
import { concat, Observable, of, Subject, throwError } from 'rxjs';
import { IspContract } from 'core/models/isp/commercial/ispcontract.model';


@Injectable({ providedIn: 'root' })
export class IspContractService {
    API: string;
    API_SERVICE_URL: string;
    /**
     *
     * @param {HttpClient} _http
     */

    protected readonly REST_API: string = environment.apiUrl;

    constructor(private _http: HttpClient) {
        this.API_SERVICE_URL = `${this.REST_API}/ispcontract`;
    }

    getContractId(id: string): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/${id}/edit`);
    }

    create(data: IspContract): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set("Content-Type", "application/json");
        return this._http.post<any>(`${this.API_SERVICE_URL}/store`, data, {
            headers: httpHeaders,
        });
    }

    update(data: IspContract): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set("Content-Type", "application/json");
        return this._http.put(
            `${this.API_SERVICE_URL}/${data.id}/update`,
            data,
            { headers: httpHeaders }
        );
    }

    getCustomers(term: string = null): Observable<any> {
        return this._http
            .get<any>(`${this.API_SERVICE_URL}/customer?q=` + term)
            .pipe(map(resp => {
                if (resp.Error) {
                    throwError(resp.Error);
                } else {
                    return resp;
                }
            })
            );
    }

    getPayments(): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/payment`).pipe(
            mergeMap(res => {
                return of(res.obj);
            })
        );
    }


    getPlans(last_mile_id: string): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/plan/${last_mile_id}`).pipe(
            mergeMap(res => {
                return of(res.obj);
            })
        );
    }

    getSectors(): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/sector`).pipe(
            mergeMap(res => {
                return of(res.obj);
            })
        );
    }

    getTemplateContracts(): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/templates/contract`).pipe(
            mergeMap(res => {
                return of(res.obj);
            })
        );
    }

    getAnotherProviders(): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/anotherprovider`).pipe(
            mergeMap(res => {
                return of(res.obj);
            })
        );
    }


}

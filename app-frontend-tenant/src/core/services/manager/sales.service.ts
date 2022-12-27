import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { environment } from 'environments/environment';
import { catchError, map, mergeMap, expand, switchMap, tap } from 'rxjs/operators';
import { Observable, of, forkJoin, EMPTY } from 'rxjs';
import { Sales } from 'core/models/manager/sales.model';

@Injectable({ providedIn: 'root' })
export class SalesService {
    API: string;
    API_SERVICE_URL: string;s
    /**
     *
     * @param {HttpClient} _http
     */

    protected readonly REST_API: string = environment.apiUrl;

    constructor(private _http: HttpClient) {
        this.API_SERVICE_URL = `${this.REST_API}/sales`;
    }

    create(data: Sales): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set("Content-Type", "application/json");
        return this._http.post<any>(`${this.API_SERVICE_URL}/store`, data, {
            headers: httpHeaders,
        });
    }

    update(data: Sales): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set("Content-Type", "application/json");
        return this._http.put(
            `${this.API_SERVICE_URL}/${data.id}/update`,
            data,
            { headers: httpHeaders }
        );
    }

    getSaleId(id: string): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/${id}/edit`).pipe(
            mergeMap(res => {
                return of(res.obj);
            })
        );
    }

    getBranch(): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/branch`).pipe(
            mergeMap(res => {
                return of(res.obj);
            })
        );
    }


}

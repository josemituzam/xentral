import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { environment } from 'environments/environment';
import { catchError, map, mergeMap, expand, switchMap, tap } from 'rxjs/operators';
import { Observable, of, forkJoin, EMPTY } from 'rxjs';
import { Company } from 'core/models/manager/company.model';



@Injectable({ providedIn: 'root' })
export class CompanyService {
    API: string;
    API_SERVICE_URL: string;
    /**
     *
     * @param {HttpClient} _http
     */

    protected readonly REST_API: string = environment.apiUrl;

    constructor(private _http: HttpClient) {
        this.API_SERVICE_URL = `${this.REST_API}/company`;
    }

    update(data: Company): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set("Content-Type", "application/json");
        return this._http.put(
            `${this.API_SERVICE_URL}/${data.id}/update`,
            data,
            { headers: httpHeaders }
        );
    }

    getCompany(): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/edit`).pipe(
            mergeMap(res => {
                return of(res.obj);
            })
        );
    }


}

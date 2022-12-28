import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { environment } from 'environments/environment';
import { catchError, map, mergeMap, expand, switchMap, tap } from 'rxjs/operators';
import { Observable, of, forkJoin, EMPTY } from 'rxjs';
import { UserDetail } from 'core/models/manager/user-detail.model';

@Injectable({ providedIn: 'root' })
export class UserDetailService {
    API: string;
    API_SERVICE_URL: string;
    /**
     *
     * @param {HttpClient} _http
     */

    protected readonly REST_API: string = environment.apiUrl;

    constructor(private _http: HttpClient) {
        this.API_SERVICE_URL = `${this.REST_API}/user-detail`;
    }

    create(data: UserDetail): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set("Content-Type", "application/json");
        return this._http.post<any>(`${this.API_SERVICE_URL}/store`, data, {
            headers: httpHeaders,
        });
    }

    update(data: UserDetail): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set("Content-Type", "application/json");
        return this._http.put(
            `${this.API_SERVICE_URL}/${data.id}/update`,
            data,
            { headers: httpHeaders }
        );
    }

    getUserId(id: string): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/${id}/edit`).pipe(
            mergeMap(res => {
                return of(res.obj);
            })
        );
    }

    getSales(): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/sales`).pipe(
            mergeMap(res => {
                return of(res.obj);
            })
        );
    }

    getUserSales(user_id: string): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/user/sales/${user_id}`).pipe(
            mergeMap(res => {
                return of(res.obj);
            })
        );
    }

    createUserSale(data: any): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set("Content-Type", "application/json");
        return this._http.post<any>(`${this.API_SERVICE_URL}/sale/store`, data, {
            headers: httpHeaders,
        });
    }

    getZoneSale(): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/zonesales`).pipe(
            mergeMap(res => {
                return of(res.obj);
            })
        );
    }

    deleteUserSale(id: string): Observable<any> {
        return this._http.delete<any>(`${this.API_SERVICE_URL}/user/sales/${id}/delete`);
    }

    userPermission(data: any): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set("Content-Type", "application/json");
        return this._http.post<any>(`${this.API_SERVICE_URL}/user/permission`, data, {
            headers: httpHeaders,
        });
    }

    getUserPermission(userId: string): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/user/permission/${userId}`).pipe(
            mergeMap(res => {
                return of(res.obj);
            })
        );
    }

}

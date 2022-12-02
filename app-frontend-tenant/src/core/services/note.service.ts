import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { environment } from 'environments/environment';
import { Note } from 'core/models/note.model';
import { catchError, map, mergeMap, expand, switchMap, tap } from 'rxjs/operators';
import { Observable, of, forkJoin, EMPTY } from 'rxjs';
@Injectable({ providedIn: 'root' })
export class NoteService {
    API: string;
    API_SERVICE_URL: string;
    /**
     *
     * @param {HttpClient} _http
     */

    protected readonly REST_API: string = environment.apiUrl;

    constructor(private _http: HttpClient) {
        this.API_SERVICE_URL = `${this.REST_API}/note`;
    }

    /**
     * Get all users
     */
    create(data: Note): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set("Content-Type", "application/json");
        return this._http.post<any>(`${this.API_SERVICE_URL}/store`, data, {
            headers: httpHeaders,
        });
    }


    update(data: Note): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set("Content-Type", "application/json");
        return this._http.put(
            `${this.API_SERVICE_URL}/${data.id}/update`,
            data,
            { headers: httpHeaders }
        );
    }


    getNotes(referenceId: string, type: string): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/index?moduleShortCode=${type}&referenceId=${referenceId}`).pipe(
            mergeMap(res => {
                return of(res.obj);
            })
        );

    }

}

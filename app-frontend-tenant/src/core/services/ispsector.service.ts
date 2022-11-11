import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { environment } from 'environments/environment';
import { Observable, of } from "rxjs";
import { IspSector } from 'core/models/ispsector.model';
import { map, mergeMap } from "rxjs/operators";
import { DescriptionSector } from 'core/models/ispcustomer.model';


@Injectable({ providedIn: 'root' })
export class IspSectorService {
    API: string;
    API_SERVICE_URL: string;
    /**
     *
     * @param {HttpClient} _http
     */

    protected readonly REST_API: string = environment.apiUrl;

    constructor(private _http: HttpClient) {
        this.API_SERVICE_URL = `${this.REST_API}/ispsector`;
    }


    /**
     * Get all sectors
     */

     getSectors(): Observable<IspSector[]> {
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
     * Create sector
     * 
    */
    create(data: IspSector): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set("Content-Type", "application/json");
        return this._http.post<any>(`${this.API_SERVICE_URL}/store`, data, {
            headers: httpHeaders,
        });
    }


    getDescriptions():Observable<DescriptionSector[]> {
      return this._http
          .get<any>(
            `${this.API_SERVICE_URL}/getDescriptions`,
          );
    }

    getSectorById(id:string):Observable<IspSector> {
      return this._http
          .get<any>(
            `${this.API_SERVICE_URL}/${id}/show`,
          );
          
    }

    putIspSector(data: any): Observable<any> {
      const httpHeaders = new HttpHeaders();
      httpHeaders.set("Content-Type", "application/json");
      return this._http.put(
        `${this.API_SERVICE_URL}/${data.id}/update`,
        data,
        { headers: httpHeaders }
      );
    }

}

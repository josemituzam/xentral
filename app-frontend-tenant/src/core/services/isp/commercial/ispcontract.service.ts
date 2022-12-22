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
    API_EXTERNAL_SERVICE_URL: string;
    /**
     *
     * @param {HttpClient} _http
     */

    protected readonly REST_API: string = environment.apiUrl;

    constructor(private _http: HttpClient) {
        this.API_SERVICE_URL = `${this.REST_API}/ispcontract`;
        this.API_EXTERNAL_SERVICE_URL = `${this.REST_API}/contract`;
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

    getBreakDay(): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/breakday`).pipe(
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

    getContractTemplateSignature(templateId: string): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/templates/signature/${templateId}`).pipe(
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


    getContactContract(customerId: string, contractId: string): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/contact/${customerId}/${contractId}/edit`);
    }

    createContactContract(data: any): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set("Content-Type", "application/json");
        return this._http.post<any>(`${this.API_SERVICE_URL}/contact/store`, data, {
            headers: httpHeaders,
        });
    }

    putSignatureActive(obj: any): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set('Content-Type', 'application/json');
        return this._http.put(this.API_SERVICE_URL + `/signature/active/${obj.id}`, obj, { headers: httpHeaders });
    }

    putSignatureRequired(obj: any): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set('Content-Type', 'application/json');
        return this._http.put(this.API_SERVICE_URL + `/signature/required/${obj.id}`, obj, { headers: httpHeaders });
    }

    generateContract(obj: any): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set('Content-Type', 'application/json');
        return this._http.put(this.API_SERVICE_URL + `/generate/contract/${obj.contract_template_id}`, obj, { headers: httpHeaders });
    }

    getLinkGenerated(contractId: any, contractTemplateId: any): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/generate/link/${contractId}/${contractTemplateId}`).pipe(
            mergeMap(res => {
                return of(res.obj);
            })
        );
    }

    getContractSignedCustomer(contractId: string, contractTemplateId: string, tokenId: string, expire: string, signature: string): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set('Content-Type', 'application/json');
        return this._http.post<any>(`${this.API_EXTERNAL_SERVICE_URL}/signed/${contractId}` + `/${contractTemplateId}` + `/${tokenId}` + `/?expires=${expire}&signature=${signature}`, { 'contractId': contractId, 'contractTemplateId': contractTemplateId, 'tokenId': tokenId, headers: httpHeaders });
    }

    downloadPdf(contractId: any, contractTemplateId: any): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set('Accept', `application/octet-stream`);
        return this._http.get(`${this.API_SERVICE_URL}/pdf/${contractTemplateId}`, { headers: httpHeaders, responseType: "blob" }).pipe(
            map((report: any) => {
                const a = document.createElement('a');
                document.body.appendChild(a);
                const blob: any = new Blob([report], { type: 'octet/stream' });
                const url = URL.createObjectURL(blob);
                a.href = url;
                a.download = `${contractId}.pdf`;
                a.click();
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
                return url;
            })
        );
    }

    saveSignature(data: any): Observable<any> {
        const httpHeaders = new HttpHeaders();
        return this._http.post<any>(`${this.API_EXTERNAL_SERVICE_URL}/signature/save`, data);
    }

    finishSignature(data: any): Observable<any> {
        const httpHeaders = new HttpHeaders();
        return this._http.post<any>(`${this.API_EXTERNAL_SERVICE_URL}/signature/finish`, data);
    }

    getContractSigned(id: string): Observable<any> {
        return this._http.get<any>(`${this.API_SERVICE_URL}/pdf/signed/${id}`);
    }

    uploadContract(data: any): Observable<any> {
        const httpHeaders = new HttpHeaders();
        httpHeaders.set("Content-Type", "application/json");
        return this._http.post<any>(`${this.API_SERVICE_URL}/updload/contract`, data, {
            headers: httpHeaders,
        });
    }

}

import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, BehaviorSubject, of, Subscription } from 'rxjs';
import { environment } from 'environments/environment';
import { User } from 'app/auth/models';

@Injectable({ providedIn: 'root' })
export class UserService {
  API: string;
  API_USERS_URL: string;
  /**
   *
   * @param {HttpClient} _http
   */

  protected readonly REST_API: string = environment.apiUrl;

  constructor(private _http: HttpClient) {
    this.API_USERS_URL = `${this.REST_API}/user/auth`;
  }

  /**
   * Get user by id
   */
  getAuthUser(userId: string): Observable<User> {
    return this._http.get<User>(this.API_USERS_URL + `/${userId}`);
  }
  /*
  getById(id: number) {
    return this._http.get<User>(`${environment.apiUrl}/users/${id}`);
  }*/
}

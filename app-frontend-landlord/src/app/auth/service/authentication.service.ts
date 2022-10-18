import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from "@angular/common/http";
import { BehaviorSubject, Observable } from 'rxjs';
import { map } from 'rxjs/operators';

import { environment } from 'environments/environment';
import { User, Role } from 'app/auth/models';
import { ToastrService } from 'ngx-toastr';

@Injectable({ providedIn: 'root' })
export class AuthenticationService {

  //Api String
  API_AUTH_URL: string;
  API_AUTH_LOGOUT_URL: string;

  //public
  public currentUser: Observable<User>;

  //private
  private currentUserSubject: BehaviorSubject<User>;

  protected readonly REST_API: string = environment.apiUrl;
  /**
   *
   * @param {HttpClient} _http
   * @param {ToastrService} _toastrService
   */
  constructor(private _http: HttpClient, private _toastrService: ToastrService) {

    this.API_AUTH_URL = `${this.REST_API}/auth/login`;
    this.API_AUTH_LOGOUT_URL = `${this.REST_API}/auth/logout`;

    this.currentUserSubject = new BehaviorSubject<User>(JSON.parse(localStorage.getItem('currentUser')));
    this.currentUser = this.currentUserSubject.asObservable();
  }

  // getter: currentUserValue
  public get currentUserValue(): User {
    return this.currentUserSubject.value;
  }

  /**
   *  Confirms if user is admin
   */
  /* get isAdmin() {
     return this.currentUser && this.currentUserSubject.value.role === Role.Admin;
   }*/

  /**
   *  Confirms if user is client
   */
  /*  get isClient() {
      return this.currentUser && this.currentUserSubject.value.role === Role.Client;
    } */

  /**
   * User login
   *
   * @param email
   * @param password
   * @returns user
   */
  login(email: string, password: string) {
    return this._http
      .post<any>(`${this.API_AUTH_URL}`, { email, password })
      .pipe(
        map(user => {
          // login successful if there's a jwt token in the response
          if (user && user.token) {
            // store user details and jwt token in local storage to keep user logged in between page refreshes
            localStorage.setItem('currentUser', JSON.stringify(user));

            // Display welcome toast!
            /*   setTimeout(() => {
                 this._toastrService.success(
                   'You have successfully logged in as an ' +
                   'Root' +
                   ' user to Vuexy. Now you can start to explore. Enjoy! 🎉',
                   '👋 Welcome, ' + user.email + '!',
                   { toastClass: 'toast ngx-toastr', closeButton: true }
                 );
               }, 1000); */
            // notify
            this.currentUserSubject.next(user);
          }
          return user;
        })
      );
  }

  /**
   * User logout
   *
   */
  logout() {
    // remove user from local storage to log user out
    const httpHeaders = new HttpHeaders();
    httpHeaders.set("Content-Type", "application/json");
    return this._http.post<any>(this.API_AUTH_LOGOUT_URL, {
      headers: httpHeaders,
    });
  }
}

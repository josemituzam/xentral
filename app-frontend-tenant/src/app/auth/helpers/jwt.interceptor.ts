import { Injectable } from '@angular/core';
import { HttpRequest, HttpHandler, HttpEvent, HttpInterceptor } from '@angular/common/http';
import { Observable } from 'rxjs';
import { tap } from 'rxjs/operators';
import { AuthenticationService } from 'app/auth/service';
import { Router } from '@angular/router';

@Injectable()
export class JwtInterceptor implements HttpInterceptor {
  /**
   *
   * @param {AuthenticationService} _authenticationService
   */
  constructor(private router: Router, private _authenticationService: AuthenticationService) { }

  /**
   * Add auth header with jwt if user is logged in and request is to api url
   * @param request
   * @param next
   */
  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    if (
      request.url.includes('/v1/client/contract/signed') == true 
      || request.url.includes('/v1/client/contract/signature/save') == true
      || request.url.includes('/v1/client/contract/signature/finish') == true
    ) {
      return next.handle(request);
    }

    if (
      request.url.indexOf('/v1/client/auth/login') < 0
    ) {
      const currentUser = this._authenticationService.currentUserValue;
      request = request.clone({
        setHeaders: {
          Authorization: `Bearer ${currentUser.token}`
        }
      });
    }
    return next.handle(request).pipe(
      tap(
        event => { },
        error => {
          if (error.status == 401) {
            console.error('Auto logout : 401 Unauthorized');
            localStorage.clear();
            this.router.navigate(['/auth/login']);
          } else {
            if (error.status == 403) {
              console.error('Auto logout : 403 Forbidden response returned from api');
              localStorage.clear();
              this.router.navigate(['/auth/login']);
              //  this.router.navigateByUrl('/auth/login');
            }
          }
          return next.handle(request);
        }
      )

    );

    /* if (isLoggedIn && isApiUrl) {
       request = request.clone({
         setHeaders: {
           Authorization: `Bearer ${currentUser.token}`
         }
       });
     }
 
     return next.handle(request);*/
  }
}

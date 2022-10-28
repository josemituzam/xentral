import { Injectable } from '@angular/core';
import { Router, CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot } from '@angular/router';
import { map, catchError } from 'rxjs/operators';
import { AuthenticationService, UserService } from 'app/auth/service';
import { Observable, of } from 'rxjs';
@Injectable({ providedIn: 'root' })
export class AuthGuard implements CanActivate {
  /**
   *
   * @param {Router} _router
   * @param {AuthenticationService} _authenticationService
   */
  constructor(private _router: Router, private _authenticationService: AuthenticationService, private _userService: UserService) { }

  // canActivate
  canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot) {
    //const currentUser = this._authenticationService.currentUserValue;
    // const userToken: any = localStorage.getItem("token");
    const userSignIn: any = JSON.parse(localStorage.getItem("currentUser"));
    if (!userSignIn) {
      this._router.navigate(['/auth/login'], { queryParams: { returnUrl: state.url } });
      return of(false);
    }
    return this._userService.getAuthUser(userSignIn.user?.id).pipe(
      map(() => {
        return true;
      }),
      catchError(err => {
        console.log(err);
        this._router.navigate(['/auth/login']);
        return of(false);
      })
    );
  }

}

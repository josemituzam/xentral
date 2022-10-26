import { Injectable } from '@angular/core';
import { Router, CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot } from '@angular/router';
import { map, catchError } from 'rxjs/operators';
import { AuthenticationService, UserService } from 'app/auth/service';
import { Observable, of } from 'rxjs';
@Injectable({ providedIn: 'root' })
export class LoginGuard implements CanActivate {
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
        if (userSignIn) {
            // check if route is restricted by role
            // role not authorised so redirect to not-authorized page
            this._router.navigate(['/dashboard/analytics']);
            return false;
        }
    }
}

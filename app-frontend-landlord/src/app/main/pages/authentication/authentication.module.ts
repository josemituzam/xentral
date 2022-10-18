import { CommonModule } from '@angular/common';
import { ModuleWithProviders, NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { RouterModule, Routes } from '@angular/router';

import { NgbModule } from '@ng-bootstrap/ng-bootstrap';

import { CoreCommonModule } from '@core/common.module';
import { HTTP_INTERCEPTORS } from '@angular/common/http';
import { AuthLoginV2Component } from 'app/main/pages/authentication/auth-login-v2/auth-login-v2.component';
import { AuthenticationService } from 'app/auth/service';
import { AuthGuard, JwtInterceptor } from 'app/auth/helpers';


// routing
const routes: Routes = [
  {
    path: 'login',
    component: AuthLoginV2Component,
    data: { animation: 'auth' }
  }
];

@NgModule({
  declarations: [AuthLoginV2Component],
  imports: [CommonModule, RouterModule.forChild(routes), NgbModule, FormsModule, ReactiveFormsModule, CoreCommonModule],
  exports: [AuthLoginV2Component],
  providers: [
		JwtInterceptor,
		{
			provide: HTTP_INTERCEPTORS,
			useClass: JwtInterceptor,
			multi: true
		},
	],
})



export class AuthenticationModule {
  static forRoot(): ModuleWithProviders<any> {
    return {
      ngModule: AuthenticationModule,
      providers: [
        AuthenticationService,
        AuthGuard
      ]
    };
  }
}

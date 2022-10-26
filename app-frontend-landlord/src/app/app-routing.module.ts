import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from './auth/helpers';
import { LoginGuard } from './auth/helpers/login.guards';
//import { AuthGuard } from './core/auth';

export const routes: Routes = [
  {
    path: '',
    redirectTo: '/auth/login',
    pathMatch: 'full'
  },
  {
    path: 'auth',
    canActivate: [LoginGuard],
    loadChildren: () =>
      import('./main/pages/authentication/authentication.module').then((m) => m.AuthenticationModule),
  },
  {
    path: 'misc',
    loadChildren: () => import('./main/pages/miscellaneous/miscellaneous.module').then(m => m.MiscellaneousModule)
  },
  /* {
     path: 'page',
     canActivate: [AuthGuard],
     loadChildren: () =>
       import('./main/sample/sample.module').then((m) => m.SampleModule),
   }, */
  {
    path: 'request-domain',
    canActivate: [AuthGuard],
    loadChildren: () =>
      import('./main/pages/requestdomain/requestdomain.module').then((m) => m.RequestDomainModule),
  },
  {
    path: 'service',
    canActivate: [AuthGuard],
    loadChildren: () =>
      import('./main/pages/service/service.module').then((m) => m.ServiceModule),
  },
  {
    path: '**',
    redirectTo: '/auth/login' //Error 404 - Page not found
  }
  /* {
     path: 'auth',
     loadChildren: () =>
       import('./modules/auth/auth.module').then((m) => m.AuthModule),
   },
   {
     path: 'error',
     loadChildren: () =>
       import('./modules/errors/errors.module').then((m) => m.ErrorsModule),
   },
   {
     path: '',
     canActivate: [AuthGuard],
     loadChildren: () =>
       import('./pages/layout.module').then((m) => m.LayoutModule),
   },
   { path: '**', redirectTo: 'error/404' },*/
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule { }

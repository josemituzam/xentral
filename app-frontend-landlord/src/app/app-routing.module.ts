import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from './auth/helpers';
import { LoginGuard } from './auth/helpers/login.guards';
//import { AuthGuard } from './core/auth';

export const routes: Routes = [
  {
    path: 'auth',
    canActivate: [LoginGuard],
    loadChildren: () =>
      import('./main/pages/authentication/authentication.module').then((m) => m.AuthenticationModule),
  },
  {
    path: 'misc',
    loadChildren: () => import('./main/pages/pages.module').then(m => m.PagesModule)
  },
  {
    path: '',
    redirectTo: '/auth/login',
    pathMatch: 'full'
  },
  {
    path: 'page',
    canActivate: [AuthGuard],
    loadChildren: () =>
      import('./main/sample/sample.module').then((m) => m.SampleModule),
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

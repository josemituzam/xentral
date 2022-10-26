import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from './auth/helpers';
import { LoginGuard } from './auth/helpers/login.guards';

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
  {
    path: 'dashboard',
    //canActivate: [AuthGuard],
    loadChildren: () => import('./main/dashboard/dashboard.module').then(m => m.DashboardModule)
  },
  {
    path: '**',
    redirectTo: '/auth/login' //Error 404 - Page not found
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule { }

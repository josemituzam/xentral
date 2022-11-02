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
    // canActivate: [LoginGuard],
    loadChildren: () =>
      import('./main/pages/authentication/authentication.module').then((m) => m.AuthenticationModule),
  },
  {
    path: 'manager',
    //  canActivate: [LoginGuard],
    loadChildren: () =>
      import('./main/pages/manager/manager.module').then((m) => m.ManagerModule),
  },
  {
    path: 'misc',
    loadChildren: () => import('./main/pages/miscellaneous/miscellaneous.module').then(m => m.MiscellaneousModule)
  },

  {
    path: 'isp',
    loadChildren: () => import('./main/pages/isp/isp.module').then(m => m.IspModule)
  },
  /* {
     path: 'service',
     // canActivate: [AuthGuard],
     loadChildren: () => import('./main/dashboard/dashboard.module').then(m => m.DashboardModule)
   }, */
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

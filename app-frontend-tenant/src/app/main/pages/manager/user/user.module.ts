import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { RouterModule, Routes } from '@angular/router';

import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { NgSelectModule } from '@ng-select/ng-select';
import { NgxDatatableModule } from '@swimlane/ngx-datatable';
import { Ng2FlatpickrModule } from 'ng2-flatpickr';

import { CoreCommonModule } from '@core/common.module';
import { CoreDirectivesModule } from '@core/directives/directives';
import { CorePipesModule } from '@core/pipes/pipes.module';
import { CoreSidebarModule } from '@core/components';

import { InvoiceModule } from 'app/main/apps/invoice/invoice.module';
import { UserListComponent } from './user-list/user-list.component';
import { ContentHeaderModule } from 'app/layout/components/content-header/content-header.module';
import { UserListService } from './user-list/user-list.service';
import { UserEditComponent } from './user-edit/user-edit.component';
import { UserSalesComponent } from './user-edit/user-sales/user-sales.component';
import { UserIspPermissionsComponent } from './user-edit/user-isp-permissions/user-isp-permissions';
import { NgxIntlTelInputModule } from 'ngx-intl-tel-input';

// routing
const routes: Routes = [
  {
    path: 'user/list',
    component: UserListComponent,
  },
  {
    path: 'user/add',
    component: UserEditComponent,
  },
  {
    path: 'user/edit/:id',
    component: UserEditComponent,
  }
];

@NgModule({
  declarations: [UserListComponent, UserEditComponent, UserSalesComponent, UserIspPermissionsComponent],
  imports: [
    NgxIntlTelInputModule,
    CommonModule,
    RouterModule.forChild(routes),
    CoreCommonModule,
    FormsModule,
    NgbModule,
    NgSelectModule,
    Ng2FlatpickrModule,
    NgxDatatableModule,
    CorePipesModule,
    CoreDirectivesModule,
    ContentHeaderModule,
    InvoiceModule,
    CoreSidebarModule
  ],
  providers: [UserListService]
})
export class UserModule { }

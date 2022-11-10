import { CommonModule, DatePipe } from '@angular/common';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { RouterModule, Routes } from '@angular/router';

import { NgbDropdownModule, NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { NgSelectModule } from '@ng-select/ng-select';
import { NgxDatatableModule } from '@swimlane/ngx-datatable';
import { Ng2FlatpickrModule } from 'ng2-flatpickr';

import { CoreCommonModule } from '@core/common.module';
import { CoreDirectivesModule } from '@core/directives/directives';
import { CorePipesModule } from '@core/pipes/pipes.module';
import { CoreSidebarModule } from '@core/components';

import { CustomerListService } from './customer-list/customer-list.service';
import { CustomerListComponent } from './customer-list/customer-list.component';
import { ContentHeaderModule } from 'app/layout/components/content-header/content-header.module';
import { CustomerEditComponent } from './customer-edit/customer-edit.component';
import { NoteListComponent } from '../../trait/note/note-list/note-list.component';

import { NgxMaskModule, IConfig } from 'ngx-mask'
import { NgxIntlTelInputModule } from 'ngx-intl-tel-input';
import { CustomerContactsComponent } from './customer-edit/customer-contact/customer-contact.component';
import { TypesUtilsService } from 'core/helpers/types-utils.service';

// routing
const routes: Routes = [
  {
    path: 'customer/list',
    component: CustomerListComponent,
  },
  {
    path: 'customer/add',
    component: CustomerEditComponent,
  },
  {
    path: 'user-view',
    redirectTo: '/apps/user/user-view/2' // Redirection
  },
  {
    path: 'user-edit',
    redirectTo: '/apps/user/user-edit/2' // Redirection
  }
];
export const options: Partial<null | IConfig> | (() => Partial<IConfig>) = null;
@NgModule({
  declarations: [CustomerListComponent, CustomerEditComponent, NoteListComponent, CustomerContactsComponent],
  imports: [
    NgxIntlTelInputModule,
    NgxMaskModule.forRoot(),
    CommonModule,
    RouterModule.forChild(routes),
    CoreCommonModule,
    ContentHeaderModule,
    FormsModule,
    NgbModule,
    NgSelectModule,
    Ng2FlatpickrModule,
    NgxDatatableModule,
    CorePipesModule,
    CoreDirectivesModule,
    CoreSidebarModule
  ],
  providers: [CustomerListService, DatePipe, TypesUtilsService]
})
export class CustomerModule { }

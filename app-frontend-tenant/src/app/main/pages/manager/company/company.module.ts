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
import { NgxIntlTelInputModule } from 'ngx-intl-tel-input';
import { InvoiceModule } from 'app/main/apps/invoice/invoice.module';
import { CompanyComponent } from './company/company.component';
import { BranchListComponent } from './branch/branch-list/branch-list.component';
import { BranchListService } from './branch/branch-list/branch-list.service';
import { ContentHeaderModule } from 'app/layout/components/content-header/content-header.module';
import { SalesListComponent } from './sales/sales-list/sales-list.component';
import { SalesListService } from './sales/sales-list/sales-list.service';
import { SalesEditComponent } from './sales/sales-edit/sales-edit.component';
import { BranchEditComponent } from './branch/branch-edit/branch-edit.component';
import { NgxMaskModule, IConfig } from 'ngx-mask'
// routing
const routes: Routes = [
  {
    path: 'company/index',
    component: CompanyComponent,
  },
  {
    path: 'branch/list',
    component: BranchListComponent,
  },

  {
    path: 'branch/add',
    component: BranchEditComponent,
  },

  {
    path: 'branch/edit/:id',
    component: BranchEditComponent,
  },

  {
    path: 'sales/list',
    component: SalesListComponent,
  },
  {
    path: 'sales/add',
    component: SalesEditComponent,
  },
  {
    path: 'sales/edit/:id',
    component: SalesEditComponent,
  },

];
export const options: Partial<null | IConfig> | (() => Partial<IConfig>) = null;
@NgModule({
  declarations: [CompanyComponent, BranchListComponent, SalesListComponent, SalesEditComponent, BranchEditComponent],
  imports: [
    NgxIntlTelInputModule,
    CommonModule,
    NgxMaskModule.forRoot(),
    RouterModule.forChild(routes),
    CoreCommonModule,
    FormsModule,
    NgbModule,
    NgSelectModule,
    Ng2FlatpickrModule,
    NgxDatatableModule,
    CorePipesModule,
    CoreDirectivesModule,
    InvoiceModule,
    CoreSidebarModule,
    ContentHeaderModule
  ],
  providers: [BranchListService, SalesListService]
})
export class CompanyModule { }

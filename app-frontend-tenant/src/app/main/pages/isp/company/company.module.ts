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
import { CompanyEditComponent } from './company/company-edit/company-edit.component';
import { CompanyEditService } from './company/company-edit/company-edit.service';
import { BranchListComponent } from './branch/branch-list/branch-list.component';
import { SaleListComponent } from './sales/sales-list/sales-list.component';

// routing
const routes: Routes = [
  {
    path: 'dashboard',
    component: CompanyEditComponent,
  },

  {
    path: 'branches/list',
    component: BranchListComponent,
  },

  {
    path: 'saless/list',
    component: SaleListComponent,
  },

];

@NgModule({
  declarations: [CompanyEditComponent, BranchListComponent, SaleListComponent],
  imports: [
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
    InvoiceModule,
    CoreSidebarModule
  ],
  providers: [CompanyEditService]
})
export class CompanyModule { }

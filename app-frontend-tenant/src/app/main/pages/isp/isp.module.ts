import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';

import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { NgSelectModule } from '@ng-select/ng-select';

import { CoreCommonModule } from '@core/common.module';
import { ContentHeaderModule } from 'app/layout/components/content-header/content-header.module';
import { NgxDatatableModule } from '@swimlane/ngx-datatable';
import { CompanyModule } from './company/company.module';
import { CustomerModule } from './customer/customer.module';
import { SectorModule } from './sector/sector.module';

//import { DashboardModule } from './dashboard/dashboard.module';


@NgModule({
  declarations: [],
  imports: [
    CommonModule,
    CoreCommonModule,
    ContentHeaderModule,
    NgbModule,
    NgSelectModule,
    FormsModule,
    NgxDatatableModule,
    CompanyModule,
    CustomerModule,
    SectorModule
    //DashboardModule
  ],

  providers: []
})
export class IspModule { }

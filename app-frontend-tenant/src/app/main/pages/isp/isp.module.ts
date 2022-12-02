import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';

import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { NgSelectModule } from '@ng-select/ng-select';

import { CoreCommonModule } from '@core/common.module';
import { ContentHeaderModule } from 'app/layout/components/content-header/content-header.module';
import { NgxDatatableModule } from '@swimlane/ngx-datatable';
import { CompanyModule } from './company/company.module';
import { CustomerModule } from './commercial/customer/customer.module';
import { PlanModule } from './commercial/plan/plan.module';
import { SectorModule } from './commercial/sector/sector.module';
import { ContractModule } from './commercial/contract/contract.module';

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
    PlanModule,
    SectorModule,
    ContractModule
    //DashboardModule
  ],

  providers: []
})
export class IspModule { }

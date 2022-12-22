import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';

import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { NgSelectModule } from '@ng-select/ng-select';

import { CoreCommonModule } from '@core/common.module';
import { ContentHeaderModule } from 'app/layout/components/content-header/content-header.module';
import { NgxDatatableModule } from '@swimlane/ngx-datatable';
import { CustomerModule } from './commercial/customer/customer.module';
import { PlanModule } from './commercial/plan/plan.module';
import { SectorModule } from './commercial/sector/sector.module';
import { ContractModule } from './commercial/contract/contract.module';
import { PanelModule } from './dashboard/panel.module';
import { HelpDeskModule } from './helpdesk/helpdesk.module';
import { TechnicalModule } from './technical/technical.module';
import { TemplateModule } from './setting/template/template.module';
import { TemplateContractModule } from './setting/template/contract-template/template-contract.module';

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
    CustomerModule,
    PlanModule,
    SectorModule,
    ContractModule,
    PanelModule,
    HelpDeskModule,
    TechnicalModule,
    TemplateModule,
    TemplateContractModule
    
  ],

  providers: []
})
export class IspModule { }

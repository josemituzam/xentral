import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';

import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { NgSelectModule } from '@ng-select/ng-select';

import { CoreCommonModule } from '@core/common.module';
import { ContentHeaderModule } from 'app/layout/components/content-header/content-header.module';
import { UserModule } from './user/user.module';
import { CompanyModule } from './company/company.module';
import { NgxDatatableModule } from '@swimlane/ngx-datatable';
import { ServiceModule } from './services/service.module';


@NgModule({
  declarations: [],
  imports: [
    ServiceModule,
    CommonModule,
    CoreCommonModule,
    ContentHeaderModule,
    NgbModule,
    NgSelectModule,
    FormsModule,
    UserModule,
    CompanyModule,
    NgxDatatableModule
  ],

  providers: []
})
export class ManagerModule { }

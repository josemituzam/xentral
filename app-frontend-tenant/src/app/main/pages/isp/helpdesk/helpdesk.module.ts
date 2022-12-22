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
import { OpenListComponent } from './open/open-list.component';
import { CloseListComponent } from './close/close-list.component';



// routing
const routes: Routes = [
  {
    path: 'helpdesk/open/list',
    component: OpenListComponent
  },

  {
    path: 'helpdesk/close/list',
    component: CloseListComponent,
  },

];

@NgModule({
  declarations: [OpenListComponent, CloseListComponent],
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
  providers: []
})
export class HelpDeskModule { }

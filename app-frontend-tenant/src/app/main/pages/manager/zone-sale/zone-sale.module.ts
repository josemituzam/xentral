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
import { ContentHeaderModule } from 'app/layout/components/content-header/content-header.module';
import { ZoneSaleListComponent } from './zone-sale-list/zone-sale-list.component';
import { ZoneSaleListService } from './zone-sale-list/zone-sale-list.service';
import { ZoneSaleEditComponent } from './zone-sale-edit/zone-sale-edit.component';

// routing
const routes: Routes = [
  {
    path: 'zone-sale/list',
    component: ZoneSaleListComponent,
  },
  {
    path: 'zone-sale/add',
    component: ZoneSaleEditComponent,
  },
  {
    path: 'zone-sale/edit/:id',
    component: ZoneSaleEditComponent
  },
];

@NgModule({
  declarations: [ZoneSaleListComponent, ZoneSaleEditComponent],
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
    ContentHeaderModule,
    InvoiceModule,
    CoreSidebarModule
  ],
  providers: [ZoneSaleListService]
})
export class ZoneSaleModule { }

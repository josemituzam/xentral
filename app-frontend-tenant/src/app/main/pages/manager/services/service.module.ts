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

import { InvoiceListService } from 'app/main/apps/invoice/invoice-list/invoice-list.service';
import { InvoiceModule } from 'app/main/apps/invoice/invoice.module';

import { UserEditService } from 'app/main/apps/user/user-edit/user-edit.service';

import { ServiceWishlistComponent } from './service-wishlist/service-wishlist.component';
import { ContentHeaderModule } from 'app/layout/components/content-header/content-header.module';
import { ServiceItemComponent } from './service-item/service-item.component';


// routing
const routes: Routes = [
  {
    path: 'service',
    component: ServiceWishlistComponent,
    /* resolve: {
       uls: UserListService
     }, */
    //  data: { animation: 'UserListComponent' }
  },

];

@NgModule({
  declarations: [ServiceWishlistComponent, ServiceItemComponent],
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
  providers: []
})
export class ServiceModule { }

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
import { ResquestdomainListService } from './requestdomain-list/requestdomain-list.service';
import { RequestDomainListComponent } from './requestdomain-list/requestdomain-list.component';
import { ContentHeaderModule } from 'app/layout/components/content-header/content-header.module';
import { SweetAlert2Module } from '@sweetalert2/ngx-sweetalert2';
import { RequestDomainEditModalComponent } from './request-domain-edit/request-domain-edit-modal.component';
import { CoreTouchspinModule } from '@core/components/core-touchspin/core-touchspin.module';
import { RequestDomainViewComponent } from './request-domain-view/request-domain-view.component';
import { ServiceEditModalComponent } from './request-domain-view/service-edit/service-edit-modal.component';


//import { PartialsModule } from 'app/main/sample/partials.module';


// routing
const routes: Routes = [
  {
    path: 'list',
    component: RequestDomainListComponent,
    /* resolve: {
       uls: ResquestdomainListService
     }, */
    data: { animation: 'RequestDomainListComponent' }
  },
  {
    path: 'detail-domain/:id',
    component: RequestDomainViewComponent,
    data: { path: 'view/:id', animation: 'RequestDomainViewComponent' }
  },

  /* {
    path: 'user-view/:id',
    component: UserViewComponent,
    resolve: {
      data: UserViewService,
      InvoiceListService
    },
    data: { path: 'view/:id', animation: 'UserViewComponent' }
  },
 
  {
    path: 'user-edit/:id',
    component: UserEditComponent,
    resolve: {
      ues: UserEditService
    },
    data: { animation: 'UserEditComponent' }
  },
  {
    path: 'user-view',
    redirectTo: '/apps/user/user-view/2' // Redirection
  },
  {
    path: 'user-edit',
    redirectTo: '/apps/user/user-edit/2' // Redirection
  }*/
];

@NgModule({
  declarations: [RequestDomainListComponent, RequestDomainEditModalComponent, RequestDomainViewComponent, ServiceEditModalComponent],
  imports: [
    CommonModule,
    RouterModule.forChild(routes),
    CoreCommonModule,
    FormsModule,
    NgbModule,
    NgSelectModule,
    Ng2FlatpickrModule,
    CoreTouchspinModule,

    NgxDatatableModule,
    CorePipesModule,
    CoreDirectivesModule,
    CoreSidebarModule,
    ContentHeaderModule,
    SweetAlert2Module.forRoot()
  ],
  entryComponents: [
    RequestDomainEditModalComponent,
    ServiceEditModalComponent
  ],
  providers: [ResquestdomainListService]
})
export class RequestDomainModule { }

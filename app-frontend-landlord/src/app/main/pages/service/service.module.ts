import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { RouterModule, Routes } from '@angular/router';

import { NgbActiveModal, NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { NgSelectModule } from '@ng-select/ng-select';
import { NgxDatatableModule } from '@swimlane/ngx-datatable';
import { Ng2FlatpickrModule } from 'ng2-flatpickr';

import { CoreCommonModule } from '@core/common.module';
import { CoreDirectivesModule } from '@core/directives/directives';
import { CorePipesModule } from '@core/pipes/pipes.module';
import { CoreSidebarModule } from '@core/components';
import { ContentHeaderModule } from 'app/layout/components/content-header/content-header.module';
import { SweetAlert2Module } from '@sweetalert2/ngx-sweetalert2';
import { ServiceListComponent } from './service-list/service-list.component';

import { ServiceListService } from './service-list/service-list.service';
import { NewServiceSidebarComponent } from './service-list/new-service-sidebar/new-service-sidebar.component';
import { ServiceEditModalComponent } from './service-edit/service-edit-modal.component';

// routing
const routes: Routes = [
  {
    path: 'list',
    component: ServiceListComponent,
    /* resolve: {
       uls: ResquestdomainListService
     }, */
    data: { animation: 'ServiceListComponent' }
  },
  /*{
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
  declarations: [ServiceListComponent, NewServiceSidebarComponent, ServiceEditModalComponent],
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
    CoreSidebarModule,
    ContentHeaderModule,
    SweetAlert2Module.forRoot()
  ],
  providers: [ServiceListService, NgbActiveModal],
  entryComponents: [
    ServiceEditModalComponent
  ],
})
export class ServiceModule { }

import { CommonModule, DatePipe } from '@angular/common';
import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { RouterModule, Routes } from '@angular/router';

import { NgbDropdownModule, NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { NgSelectModule } from '@ng-select/ng-select';
import { NgxDatatableModule } from '@swimlane/ngx-datatable';
import { Ng2FlatpickrModule } from 'ng2-flatpickr';

import { CoreCommonModule } from '@core/common.module';
import { CoreDirectivesModule } from '@core/directives/directives';
import { CorePipesModule } from '@core/pipes/pipes.module';
import { CoreSidebarModule } from '@core/components';

import { CustomerListService } from './customer-list/customer-list.service';
import { CustomerListComponent } from './customer-list/customer-list.component';
import { ContentHeaderModule } from 'app/layout/components/content-header/content-header.module';
import { CustomerEditComponent } from './customer-edit/customer-edit.component';


import { NgxMaskModule, IConfig } from 'ngx-mask'
import { NgxIntlTelInputModule } from 'ngx-intl-tel-input';
import { CustomerContactsComponent } from './customer-contact/customer-contact.component';
import { TypesUtilsService } from 'core/helpers/types-utils.service';

import { FileUploadModule } from 'ng2-file-upload';
import { CustomerCreateComponent } from './customer-create/customer-create.component';
import { WebcamModule } from 'ngx-webcam';
import { AngularCropperjsModule } from 'angular-cropperjs';
import { CustomerDocumentationComponent } from './customer-documentation/customer-documentation.component';
import { NoteListComponent } from 'app/main/pages/trait/note/note-list/note-list.component';
import { NoteEditComponent } from 'app/main/pages/trait/note/note-edit/note-edit-modal.component';
import { DocumentListComponent } from 'app/main/pages/trait/document/document-list/document-list.component';
import { DocumentEditComponent } from 'app/main/pages/trait/document/document-edit/document-edit.component';

// routing
const routes: Routes = [
  {
    path: 'customer/list',
    component: CustomerListComponent,
  },
  {
    path: 'customer/add',
    component: CustomerCreateComponent,
  },
  {
    path: 'customer/edit/:id',
    component: CustomerEditComponent,
  },
];
export const options: Partial<null | IConfig> | (() => Partial<IConfig>) = null;
@NgModule({
  declarations: [CustomerDocumentationComponent, CustomerListComponent, CustomerEditComponent, NoteListComponent, NoteEditComponent, DocumentListComponent, DocumentEditComponent, CustomerContactsComponent, CustomerCreateComponent],
  imports: [
    NgxIntlTelInputModule,
    NgxMaskModule.forRoot(),
    CommonModule,
    RouterModule.forChild(routes),
    CoreCommonModule,
    ContentHeaderModule,
    FormsModule,
    NgbModule,
    NgSelectModule,
    Ng2FlatpickrModule,
    NgxDatatableModule,
    CorePipesModule,
    CoreDirectivesModule,
    CoreSidebarModule,
    FileUploadModule,
    WebcamModule,
    AngularCropperjsModule
  ],
  providers: [CustomerListService, DatePipe, TypesUtilsService],
})
export class CustomerModule { }

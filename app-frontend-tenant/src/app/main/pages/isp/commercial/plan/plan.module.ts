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

import { ContentHeaderModule } from 'app/layout/components/content-header/content-header.module';


import { NgxMaskModule, IConfig } from 'ngx-mask'
import { NgxIntlTelInputModule } from 'ngx-intl-tel-input';

import { TypesUtilsService } from 'core/helpers/types-utils.service';
import { FileUploadModule } from 'ng2-file-upload';

import { WebcamModule } from 'ngx-webcam';
import { AngularCropperjsModule } from 'angular-cropperjs';
import { PlanListComponent } from './plan-list/plan-list.component';
import { PlanListService } from './plan-list/plan-list.service';
import { PlanEditComponent } from './plan-edit/plan-edit.component';


// routing
const routes: Routes = [
  {
    path: 'plan/list',
    component: PlanListComponent,
  },
  {
    path: 'plan/add',
    component: PlanEditComponent,
  },
  {
    path: 'plan/edit/:id',
    component: PlanEditComponent,
  },
];
export const options: Partial<null | IConfig> | (() => Partial<IConfig>) = null;
@NgModule({
  declarations: [PlanListComponent, PlanEditComponent],
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
  providers: [PlanListService, DatePipe, TypesUtilsService],
})
export class PlanModule { }

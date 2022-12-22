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
import { CKEditorModule } from 'ckeditor4-angular';

import { ContentHeaderModule } from 'app/layout/components/content-header/content-header.module';
import { TemplateContractListComponent } from './template-contract-list/template-contract-list.component';
import { TemplateContractListService } from './template-contract-list/template-contract-list.service';
import { TemplateContractEditComponent } from './template-contract-edit/template-contract-edit.component';
import { ContractModalComponent } from './contract-modal/contract-modal.component';
import { SafePipe } from '@core/pipes/safe.pipe';

// routing
const routes: Routes = [
  {
    path: 'template/contract/list',
    component: TemplateContractListComponent
  },
  {
    path: 'template/contract/add',
    component: TemplateContractEditComponent
  },
  {
    path: 'template/contract/edit/:id',
    component: TemplateContractEditComponent
  },

];

@NgModule({
  declarations: [ContractModalComponent, TemplateContractListComponent, TemplateContractEditComponent],
  imports: [
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
    CKEditorModule
  ],
  providers: [TemplateContractListService, SafePipe]
})
export class TemplateContractModule { }

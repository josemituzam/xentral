import { GoogleMapsModule } from '@angular/google-maps';
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

import { SectorListService } from './sector-list/sector-list.service';

import { NgxMaskModule, IConfig } from 'ngx-mask'
import { NgxIntlTelInputModule } from 'ngx-intl-tel-input';
import { SectorListComponent } from './sector-list/sector-list.component';
import { ContentHeaderModule } from 'app/layout/components/content-header/content-header.module';
import { SectorEditComponent } from './sector-edit/sector-edit.component';

// routing
const routes: Routes = [
    {
        path: 'sector/list',
        component: SectorListComponent,
    },
    {
        path: 'sector/add',
        component: SectorEditComponent,
    },
    {
        path: 'sector/edit/:id',
        component: SectorEditComponent,
    },
];
export const options: Partial<null | IConfig> | (() => Partial<IConfig>) = null;
@NgModule({
    declarations: [SectorListComponent, SectorEditComponent],
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
        GoogleMapsModule

    ],
    providers: [SectorListService, DatePipe]
})
export class SectorModule { }
import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { CoreCommonModule } from '@core/common.module';
import { ContractSignedComponent } from './contract-signed.component';
import { UrlSignedExpiredComponent } from './url-signed-expired/url-signed-expired.component';

// routing
const routes: Routes = [
    {
        path: 'contract/signed/:contractId/:contractTemplateId/:tokenId',
        component: ContractSignedComponent,
    },
    {
        path: 'contract/signed/expired',
        component: UrlSignedExpiredComponent,
    },
];

@NgModule({
    declarations: [ContractSignedComponent, UrlSignedExpiredComponent],
    imports: [CommonModule, RouterModule.forChild(routes), CoreCommonModule]
})
export class ContractSignedModule { }

<?php

declare(strict_types=1);

use App\Http\Controllers\Core\AuthController;
use App\Http\Controllers\Core\User\UserController;
use App\Http\Controllers\Tenant\File\FileController;
use App\Http\Controllers\Tenant\Isp\Commercial\Contract\IspContactContractController;
use App\Http\Controllers\Tenant\Isp\Commercial\Contract\IspContractController;
use App\Http\Controllers\Tenant\Isp\Commercial\Customer\IspContactCustomerController;
use App\Http\Controllers\Tenant\Isp\Commercial\Customer\IspCustomerController;
use App\Http\Controllers\Tenant\Isp\Commercial\Plan\IspLastMilesController;
use App\Http\Controllers\Tenant\Isp\Commercial\Plan\IspPlanController;
use App\Http\Controllers\Tenant\Isp\Commercial\Sector\IspSectorController;
use App\Http\Controllers\Tenant\Isp\Setting\Template\TemplateContract\TemplateContractController;
use App\Http\Controllers\Tenant\Note\NoteController;
use App\Http\Controllers\Tenant\Service\ServiceController;
use App\Http\Controllers\Tenant\Setting\Branch\BranchController;
use App\Http\Controllers\Tenant\Setting\Company\CompanyController;
use App\Http\Controllers\Tenant\Setting\Sale\SaleController;
use App\Http\Controllers\Tenant\Setting\UserDetail\UserDetailController;
use App\Http\Controllers\Tenant\Setting\ZoneSale\ZoneSaleController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/



Route::middleware([
    'apiTenant',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {



    Route::group([
        'prefix' => 'api/v1/client'
    ], function () {
        Route::post('auth/login', [AuthController::class, 'loginInTenant']);
        Route::post('contract/signed/{contract_id}/{contract_template_id}/{token_id}', [IspContractController::class, 'getCustomerContract'])->name('contractLink')->middleware('signed');
        Route::post('contract/signature/save', [IspContractController::class, 'saveSignature']);
        Route::post('contract/signature/finish', [IspContractController::class, 'finishSignature']);
        Route::group(['middleware' => ['jwt.verify']], function () {
            // Auth Routes
            Route::post('auth/logout',  [AuthController::class, 'logout']);
            // User Routes
            Route::get('user/auth/{id}', [UserController::class, 'show']);
            // Servicio
            Route::get('service/index', [ServiceController::class, 'index']);

            //Cliente
            Route::post('ispcustomer/store', [IspCustomerController::class, 'store']);
            Route::put('ispcustomer/{id}/update', [IspCustomerController::class, 'update']);
            Route::get('ispcustomer/index', [IspCustomerController::class, 'index']);
            Route::get('ispcustomer/{id}/edit', [IspCustomerController::class, 'edit']);
            Route::delete('ispcustomer/{id}', [IspCustomerController::class, 'destroy']);
            Route::put('ispcustomer/active/{id}', [IspCustomerController::class, 'activeRecord']);
            //Route::post('ispcustomer/documents', [IspCustomerController::class, 'storeDocument']);
            Route::post('ispcustomer/contact/store', [IspContactCustomerController::class, 'store']);
            Route::get('ispcustomer/contact/{customer_id}/edit', [IspContactCustomerController::class, 'edit']);
            Route::get('ispcustomer/files/{id}', [FileController::class, 'getFileCustomer']);

            Route::post('ispcustomer/files/update', [FileController::class, 'fileCustomer']);
            Route::get('ispcustomer/files/{customer_id}/validate', [FileController::class, 'validateFile']);
            Route::get('ispcustomer/contact/{customer_id}/validate', [IspContactCustomerController::class, 'validateContact']);
            Route::get('ispcustomer/customer/{ide}/{type}/validate', [IspCustomerController::class, 'validateCustomer']);

            //Planes
            Route::get('ispplan/index', [IspPlanController::class, 'index']);
            Route::get('ispplan/lastmiles/index', [IspLastMilesController::class, 'index']);
            Route::post('ispplan/store', [IspPlanController::class, 'store']);
            Route::get('ispplan/{id}/edit', [IspPlanController::class, 'edit']);
            Route::put('ispplan/{id}/update', [IspPlanController::class, 'update']);
            Route::delete('ispplan/{id}', [IspPlanController::class, 'destroy']);
            Route::put('ispplan/active/{id}', [IspPlanController::class, 'activeRecord']);
            Route::get('ispplan/minimunpermanences', [IspPlanController::class, 'getMinimunPermanences']);

            //Sectores
            Route::get('ispsector/index', [IspSectorController::class, 'index']);
            Route::post('ispsector/store', [IspSectorController::class, 'store']);
            Route::get('ispsector/{id}/edit', [IspSectorController::class, 'edit']);
            Route::put('ispsector/{id}/update', [IspSectorController::class, 'update']);
            Route::put('ispsector/active/{id}', [IspSectorController::class, 'activeRecord']);
            Route::get('ispsector/country', [IspSectorController::class, 'getCountry']);
            Route::get('ispsector/{city_id}/location', [IspSectorController::class, 'getLocation']);

            //Contratos
            Route::get('ispcontract/breakday', [IspContractController::class, 'getBreakDay']);
            Route::get('ispcontract/index', [IspContractController::class, 'index']);
            Route::post('ispcontract/store', [IspContractController::class, 'store']);
            Route::get('ispcontract/{id}/edit', [IspContractController::class, 'edit']);
            Route::put('ispcontract/{id}/update', [IspContractController::class, 'update']);
            Route::put('ispcontract/active/{id}', [IspContractController::class, 'activeRecord']);
            Route::get('ispcontract/customer', [IspContractController::class, 'getCustomer']);
            Route::get('ispcontract/payment', [IspContractController::class, 'getPayment']);
            Route::get('ispcontract/plan/{last_mile_id}', [IspContractController::class, 'getPlan']);
            Route::get('ispcontract/sector', [IspContractController::class, 'getSector']);
            Route::get('ispcontract/templates/contract', [IspContractController::class, 'getTemplateContract']);
            Route::get('ispcontract/anotherprovider', [IspContractController::class, 'getAnotherProvider']);
            Route::get('ispcontract/templates/signature/{contract_template_id}', [IspContractController::class, 'getContractTemplateSignature']);
            Route::get('ispcontract/contact/{customer_id}/{contract_id}/edit', [IspContactContractController::class, 'edit']);
            Route::post('ispcontract/contact/store', [IspContactContractController::class, 'store']);
            Route::put('ispcontract/signature/active/{id}', [IspContractController::class, 'signatureActiveRecord']);
            Route::put('ispcontract/signature/required/{id}', [IspContractController::class, 'signatureRequiredRecord']);

            Route::put('ispcontract/generate/contract/{contract_template_id}', [IspContractController::class, 'generateContract']);
            Route::get('ispcontract/pdf/{id}', [IspContractController::class, 'downloadPdf']);

            Route::get('ispcontract/pdf/signed/{contract_id}', [IspContractController::class, 'getContractSigned']);
            Route::post('ispcontract/updload/contract', [IspContractController::class, 'uploadContract']);


            //Notas
            Route::get('note/index', [NoteController::class, 'index']);
            Route::post('note/store', [NoteController::class, 'store']);
            Route::put('note/{id}/update', [NoteController::class, 'update']);

            //Templates
            Route::get('template/contract/index', [TemplateContractController::class, 'index']);
            Route::put('template/contract/active/{id}', [TemplateContractController::class, 'activeRecord']);
            Route::delete('template/contract/{id}', [TemplateContractController::class, 'destroy']);
            Route::get('template/contract/{id}/edit', [TemplateContractController::class, 'edit']);
            Route::post('template/contract/store', [TemplateContractController::class, 'store']);
            Route::put('template/contract/{id}/update', [TemplateContractController::class, 'update']);
            Route::get('template/contract/pdf/{id}', [TemplateContractController::class, 'downloadPdf']);

            //Rutas con tiempo
            Route::get('ispcontract/generate/link/{contract_id}/{contract_template_id}', [IspContractController::class, 'generateLink']);

            //Zonas Comerciales
            Route::get('zone-sale/index', [ZoneSaleController::class, 'index']);
            Route::post('zone-sale/store', [ZoneSaleController::class, 'store']);
            Route::get('zone-sale/{id}/edit', [ZoneSaleController::class, 'edit']);
            Route::put('zone-sale/{id}/update', [ZoneSaleController::class, 'update']);
            Route::delete('zone-sale/{id}', [ZoneSaleController::class, 'destroy']);
            Route::put('zone-sale/active/{id}', [ZoneSaleController::class, 'activeRecord']);
            //Sucursales
            Route::get('branch/index', [BranchController::class, 'index']);
            Route::post('branch/store', [BranchController::class, 'store']);
            Route::get('branch/{id}/edit', [BranchController::class, 'edit']);
            Route::put('branch/{id}/update', [BranchController::class, 'update']);
            Route::delete('branch/{id}', [BranchController::class, 'destroy']);
            Route::put('branch/active/{id}', [BranchController::class, 'activeRecord']);
            //Puntos de venta
            Route::get('sales/index', [SaleController::class, 'index']);
            Route::post('sales/store', [SaleController::class, 'store']);
            Route::get('sales/{id}/edit', [SaleController::class, 'edit']);
            Route::put('sales/{id}/update', [SaleController::class, 'update']);
            Route::delete('sales/{id}', [SaleController::class, 'destroy']);
            Route::put('sales/active/{id}', [SaleController::class, 'activeRecord']);
            Route::get('sales/branch', [SaleController::class, 'getBranch']);
            

            //Compañía
            Route::get('company/edit', [CompanyController::class, 'edit']);
            Route::put('company/{id}/update', [CompanyController::class, 'update']);

            //Usuarios
            Route::get('user-detail/index', [UserDetailController::class, 'index']);
            Route::post('user-detail/store', [UserDetailController::class, 'store']);
            Route::get('user-detail/{id}/edit', [UserDetailController::class, 'edit']);
            Route::put('user-detail/{id}/update', [UserDetailController::class, 'update']);
            Route::delete('user-detail/{id}', [UserDetailController::class, 'destroy']);
            Route::put('user-detail/active/{id}', [UserDetailController::class, 'activeRecord']);
            Route::get('user-detail/sales', [UserDetailController::class, 'getSales']);
            Route::get('user-detail/zonesales', [UserDetailController::class, 'getZoneSales']);
            Route::post('user-detail/sale/store', [UserDetailController::class, 'storeUserSale']);
            Route::get('user-detail/user/sales/{user_id}', [UserDetailController::class, 'getUserSales']);
            Route::delete('user-detail/user/sales/{id}/delete', [UserDetailController::class, 'destroyUserSales']);
        });
    });
});

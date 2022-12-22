<?php

namespace App\Http\Controllers\Tenant\Isp\Commercial\Contract;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Tenant\Api\ApiR2Controller;
use App\Models\Tenant\Isp\Commercial\Contract\IspContract;
use App\Http\Utils\Helpers;
use App\Models\Tenant\Isp\Commercial\Contract\IspAnotherProvider;
use App\Models\Tenant\Isp\Commercial\Contract\IspContactContract;
use App\Models\Tenant\Isp\Commercial\Contract\IspContractPlan;
use App\Models\Tenant\Isp\Commercial\Contract\IspCustomerContractTemplate;
use App\Models\Tenant\Isp\Commercial\Contract\IspTemplateContractSignature;
use App\Models\Tenant\Isp\Commercial\Customer\IspContactCustomer;
use App\Models\Tenant\Isp\Commercial\Customer\IspCustomer;

use App\Models\Tenant\Isp\Commercial\Plan\IspPlan;
use App\Models\Tenant\Isp\Commercial\Sector\IspSector;
use App\Models\Tenant\Setting\Company\Company;
use App\Models\Tenant\Traits\Payment\Payment;
use App\Models\Tenant\Traits\Template\TemplateContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Tenant\File\File as FileTenant;
use Illuminate\Support\Facades\File as FileStorage;
use App\Models\Tenant\Isp\Commercial\Contract\IspContractToken;
use App\Models\Tenant\Traits\Sequential\Sequential;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class IspContractController extends Controller
{
    public function uploadContract(Request $request)
    {
        $objTemplateContract = IspCustomerContractTemplate::where('contract_id', $request->id)->first();
        $objFileCount = FileTenant::where('contextable_id', $objTemplateContract->id)->count();
        $objFile = FileTenant::where('contextable_id', $objTemplateContract->id)->first();
        $folder = Controller::getFolder('contract', $request->id);
        $methods = new ApiR2Controller();
        $methods->setS3();
        IspCustomerContractTemplate::whereId($objTemplateContract->id)->update([
            'is_signed' => 1
        ]);

        FileTenant::where('contextable_id', $objTemplateContract->id)->update([
            'status_id' => Controller::getStatus('contract', 'isp', 'FDO'),
        ]);

        IspContract::where('id', $request->id)->update([
            'status_id' => Controller::getStatus('contract', 'isp', 'PTA'),
        ]);
        if ($objFileCount > 0) {
            IspTemplateContractSignature::where('customer_contract_template_id', $objTemplateContract->id)->update([
                'signature' => null,
            ]);

            if ($request->file('path')) {
                Storage::disk('s3')->delete($objFile->path);
                $file = $request->file('path');
                $path = str_replace(' ', '', $folder['folderFile'] . 'CONTRATO');
                Storage::disk('s3')->put($path,  FileStorage::get($file));
            }
        } else {
            if ($request->file('path')) {
                $file = $request->file('path');
                $path = str_replace(' ', '', $folder['folderFile'] . 'CONTRATO');
                Storage::disk('s3')->put($path,  FileStorage::get($file));
                FileTenant::create([
                    'name' => 'Contrato',
                    'contextable_id' => $objTemplateContract->id,
                    'filaname' => 'CONTRATO',
                    'path' =>   $path,
                    'type' => 'file',
                    'status_id' => Controller::getStatus('contract', 'isp', 'SFR'),
                    'long_code' => 'CONTRATO',
                    'short_code' => '1',
                ]);
            }
        }
        return response()->json(['success' => true]);
    }

    public function getContractSigned($contractId)
    {
        $obj = IspContract::find($contractId);
        $methods = new ApiR2Controller();
        $methods->setS3();
        $objFile = FileTenant::where('contextable_id', $obj->getCustomerContractTemplate->id)->first();
        if ($objFile->path) {
            $objFile['path'] = Storage::disk("s3")->temporaryUrl($objFile->path, now()->addMinutes(1440));
        }
        return response()->json([
            'obj'  => $objFile['path']
        ]);
    }

    public function finishSignature(Request $request)
    {
        $template = IspCustomerContractTemplate::find($request->contract_template_id);
        $html = $template->html;
        $objContract = IspContract::find($request->contract_id);
        $objSignature = IspTemplateContractSignature::where('customer_contract_template_id', $template->id)->whereNotNull('signature')->get();
        for ($i = 0; $i < $objSignature->count(); $i++) {
            if ($objSignature[$i]->long_code == '%firmaCliente1%' && $objSignature[$i]->is_active == 1) {
                $html = str_replace('%firmaCliente1%', '<img src="' . $objSignature[$i]->signature . '" alt="" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente2%' && $objSignature[$i]->is_active == 1) {
                $html = str_replace('%firmaCliente2%', '<img src="' . $objSignature[$i]->signature . '" alt="" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente3%' && $objSignature[$i]->is_active == 1) {

                $html = str_replace('%firmaCliente3%', '<img src="' . $objSignature[$i]->signature . '" alt="" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente4%' && $objSignature[$i]->is_active == 1) {
                $html = str_replace('%firmaCliente4%', '<img src="' . $objSignature[$i]->signature . '" alt="" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente5%' && $objSignature[$i]->is_active == 1) {

                $html = str_replace('%firmaCliente5%', '<img src="' . $objSignature[$i]->signature . '" alt="" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente6%' && $objSignature[$i]->is_active == 1) {
                $html = str_replace('%firmaCliente6%', '<img src="' . $objSignature[$i]->signature . '" alt="" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente7%' && $objSignature[$i]->is_active == 1) {
                $html = str_replace('%firmaCliente7%', '<img src="' . $objSignature[$i]->signature . '" alt="" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente8%' && $objSignature[$i]->is_active == 1) {
                $html = str_replace('%firmaCliente8%', '<img src="' . $objSignature[$i]->signature . '"  alt="" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente9%' && $objSignature[$i]->is_active == 1) {
                $html = str_replace('%firmaCliente9%', '<img src="' . $objSignature[$i]->signature . '"  alt="" width="100" />', $html);
            }
        }
        IspCustomerContractTemplate::whereId($request->contract_template_id)->update([
            'html' => $html,
            'is_signed' => 1
        ]);

        FileTenant::where('contextable_id', $request->contract_template_id)->update([
            'status_id' => Controller::getStatus('contract', 'isp', 'FDO'),
        ]);

        IspContract::where('id', $request->contract_id)->update([
            'status_id' => Controller::getStatus('contract', 'isp', 'PTA'),
        ]);

        IspTemplateContractSignature::where('customer_contract_template_id', $template->id)->update([
            'signature' => null,
        ]);

        $objFile = FileTenant::where('contextable_id', $request->contract_template_id)->first();

        $methods = new ApiR2Controller();
        $methods->setS3();
        Storage::disk('s3')->delete($objFile->path);
        $folder = Controller::getFolder('contract', $request->contract_id);
        $htmls = View::make('Contratos.print-pdf', ['html' => $html, 'plantilla' =>  $objContract->getTemplateContract])->render();
        $pdf =  Pdf::loadHTML($htmls)->setPaper($objContract->getTemplateContract->size,  $objContract->getTemplateContract->orientation)->setWarnings(false);
        $path = str_replace(' ', '', $folder['folderFile'] . 'CONTRATO');
        Storage::disk('s3')->put($path, $pdf->output());

        return response()->json([
            'objTemplateSignature' => 0,
            'isSigned' => 1,
        ]);
    }

    public function saveSignature(Request $request)
    {
        IspTemplateContractSignature::where('id', $request->signature_id)->update([
            'signature' => $request->signature,
        ]);
        $objTemplateSignature = IspTemplateContractSignature::where('customer_contract_template_id', $request->contract_template_id)
            ->where('is_active', 1)
            ->whereNull('signature')
            ->orderBy('orderBy', 'ASC')->first();

        $objTemplateSignatureCount = IspTemplateContractSignature::where('customer_contract_template_id', $request->contract_template_id)
            ->where('is_active', 1)
            ->whereNull('signature')->count();
        return response()->json([
            'objTemplateSignature' => $objTemplateSignature,
            'objCount' => $objTemplateSignatureCount > 0 ? 1 : 0,
        ]);
    }


    public function getCustomerContract($contractId, $contractTemplateId, $token)
    {
        $objContractTemplate = IspCustomerContractTemplate::find($contractTemplateId);
        $objContract = IspContract::where('id', $contractId)->first();
        $file = FileTenant::where('contextable_id', $contractTemplateId)->first();
        $objTemplateSignature = IspTemplateContractSignature::where('customer_contract_template_id', $contractTemplateId)
            ->where('is_active', 1)
            ->whereNull('signature')
            ->orderBy('orderBy', 'ASC')->first();
        $objTemplateSignatureCount = IspTemplateContractSignature::where('customer_contract_template_id', $contractTemplateId)
            ->where('is_active', 1)
            ->whereNull('signature')->count();
        $methods = new ApiR2Controller();
        $methods->setS3();
        if (isset($file->path)) {
            $path  = Storage::disk("s3")->temporaryUrl($file->path, now()->addMinutes(1440));
        }

        if ($objContractTemplate->is_signed == 0) {
            IspTemplateContractSignature::where('customer_contract_template_id', $contractTemplateId)->update([
                'signature' => null,
            ]);
        } else {
            return response()->json([
                'path' => $path,
                'isSigned' => 1,
            ]);
        }

        return response()->json([
            'path' => $path,
            'objCustomer'  => $objContract->getCustomer->fullname,
            'objContract'  => $objContract,
            'objTemplateSignature' => $objTemplateSignature,
            'objCount' => $objTemplateSignatureCount > 0 ? 1 : 0,
            'isSigned' => 0,
        ]);
    }

    public function generateLink(Request $request, $contractId, $contractTemplateId)
    {
        $objCount = IspContractToken::where('contract_id', $contractId)->count();
        if ($objCount > 0) {
            $getTokenTime = IspContractToken::where('contract_id', $contractId)->first();
            $dateNow = strtotime(date("Y-m-d H:i:s", time()));
            $dateToken = strtotime(base64_decode($getTokenTime->token_expired));
            if ($dateNow < $dateToken) {
                $startTime = Carbon::parse($dateNow);
                $finishTime = Carbon::parse($dateToken);
                return response()->json([
                    'msg' => 'Ya existe un enlace temporal generado.' . ' ' . '<br>' . ' ' . 'Tiempo para generar otro enlace: ' . '<strong>' . $finishTime->diff($startTime)->format('%H:%I:%S') . '</strong>',
                ], 429);
            }
        }
        // IspContractToken::where('contract_id', $contractId)->delete();
        do {
            //generate a random string using Laravel's str_random helper
            $token = Str::random(50);
        } //check if the token already exists and if it does, try again
        while (IspContractToken::where('token_id', $token)->first());

        $now = date('Y-m-d H:i:s');
        $addEndTimeToken = strtotime('+2 minute', strtotime($now));
        // $addEndTimeToken = strtotime('+2 minute', strtotime($now));
        $endNewTime = date('Y-m-d H:i:s', $addEndTimeToken);

        if ($objCount == 0) {
            $obj = IspContractToken::create([
                'contract_id' => $contractId,
                'token_id' =>  $token,
                'token_expired' => base64_encode($endNewTime),
            ]);
        } else {
            IspContractToken::where('contract_id', $contractId)->update([
                'token_id' =>  $token,
                'token_expired' => base64_encode($endNewTime),
            ]);
            $obj = IspContractToken::where('contract_id', $contractId)->first();
        }

        $subdomain = Arr::first(explode('.', $request->getHost()));
        $link = URL::temporarySignedRoute(
            'contractLink',
            now()->addMinutes(2),
            ['contract_id' => $obj->contract_id, 'contract_template_id' => $contractTemplateId,  'token_id' => $obj->token_id]
        );
        $linked = str_replace($subdomain  . config('app.url_back') . 'api/v1/client/contract/signed/', $subdomain . config('app.url_frontend_tenant') . 'ext/contract/signed/', $link);


        $objContractTemplateId = IspCustomerContractTemplate::find($contractTemplateId);
        $objContract = IspContract::find($contractId);
        $objSignature = IspTemplateContractSignature::where('customer_contract_template_id', $contractTemplateId)->get();
        $html = $objContractTemplateId->html;
        for ($i = 0; $i < $objSignature->count(); $i++) {
            if ($objSignature[$i]->long_code == '%firmaCliente1%' && $objSignature[$i]->is_active == 1) {
                $content = public_path('images/firma1.png');
                $imageData = base64_encode(file_get_contents($content));
                $src = 'data:' . mime_content_type($content) . ';base64,' . $imageData;
                $html = str_replace('%firmaCliente1%',  '<img alt="" src="' . $src . '" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente2%' && $objSignature[$i]->is_active == 1) {
                $content = public_path('images/firma2.png');
                $imageData = base64_encode(file_get_contents($content));
                $src = 'data:' . mime_content_type($content) . ';base64,' . $imageData;
                $html = str_replace('%firmaCliente2%',  '<img alt="" src="' . $src . '" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente3%' && $objSignature[$i]->is_active == 1) {
                $content = public_path('images/firma3.png');
                $imageData = base64_encode(file_get_contents($content));
                $src = 'data:' . mime_content_type($content) . ';base64,' . $imageData;
                $html = str_replace('%firmaCliente3%',  '<img alt="" src="' . $src . '" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente4%' && $objSignature[$i]->is_active == 1) {
                $content = public_path('images/firma4.png');
                $imageData = base64_encode(file_get_contents($content));
                $src = 'data:' . mime_content_type($content) . ';base64,' . $imageData;
                $html = str_replace('%firmaCliente4%',  '<img alt="" src="' . $src . '" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente5%' && $objSignature[$i]->is_active == 1) {
                $content = public_path('images/firma5.png');
                $imageData = base64_encode(file_get_contents($content));
                $src = 'data:' . mime_content_type($content) . ';base64,' . $imageData;
                $html = str_replace('%firmaCliente5%',  '<img alt="" src="' . $src . '" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente6%' && $objSignature[$i]->is_active == 1) {
                $content = public_path('images/firma6.png');
                $imageData = base64_encode(file_get_contents($content));
                $src = 'data:' . mime_content_type($content) . ';base64,' . $imageData;
                $html = str_replace('%firmaCliente6%', '<img alt="" src="' . $src . '" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente7%' && $objSignature[$i]->is_active == 1) {
                $content = public_path('images/firma7.png');
                $imageData = base64_encode(file_get_contents($content));
                $src = 'data:' . mime_content_type($content) . ';base64,' . $imageData;
                $html = str_replace('%firmaCliente7%', '<img alt="" src="' . $src . '" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente8%' && $objSignature[$i]->is_active == 1) {
                $content = public_path('images/firma8.png');
                $imageData = base64_encode(file_get_contents($content));
                $src = 'data:' . mime_content_type($content) . ';base64,' . $imageData;
                $html = str_replace('%firmaCliente8%', '<img alt="" src="' . $src . '" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente9%' && $objSignature[$i]->is_active == 1) {
                $content = public_path('images/firma9.png');
                $imageData = base64_encode(file_get_contents($content));
                $src = 'data:' . mime_content_type($content) . ';base64,' . $imageData;
                $html = str_replace('%firmaCliente9%',  '<img alt="" src="' . $src . '" width="100" />', $html);
            }
        }


        if ($objCount == 0) {
            $methods = new ApiR2Controller();
            $methods->setS3();
            $folder = Controller::getFolder('contract', $contractId);
            $html = View::make('Contratos.print-pdf', ['html' => $html, 'plantilla' =>  $objContract->getTemplateContract])->render();
            $pdf =  Pdf::loadHTML($html)->setPaper($objContract->getTemplateContract->size,  $objContract->getTemplateContract->orientation)->setWarnings(false);
            $path = str_replace(' ', '', $folder['folderFile'] . 'CONTRATO');
            Storage::disk('s3')->put($path, $pdf->output());
            FileTenant::create([
                'name' => 'Contrato',
                'contextable_id' => $contractTemplateId,
                'filaname' => 'CONTRATO',
                'path' =>   $path,
                'type' => 'file',
                'status_id' => Controller::getStatus('contract', 'isp', 'SFR'),
                'long_code' => 'CONTRATO',
                'short_code' => '1',
            ]);
        }



        return response()->json([
            'obj'  => $linked,
        ]);
    }

    public function downloadPdf($contract_template_id)
    {
        $obj = IspCustomerContractTemplate::find($contract_template_id);
        $objContract = IspContract::find($obj->contract_id);
        $objSignature = IspTemplateContractSignature::where('customer_contract_template_id', $obj->id)->get();
        $html = $obj->html;
        for ($i = 0; $i < $objSignature->count(); $i++) {
            if ($objSignature[$i]->long_code == '%firmaCliente1%' && $objSignature[$i]->is_active == 1) {
                $html = str_replace('%firmaCliente1%', '_______________________________', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente2%' && $objSignature[$i]->is_active == 1) {
                $html = str_replace('%firmaCliente2%', '_______________________________', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente3%' && $objSignature[$i]->is_active == 1) {
                $html = str_replace('%firmaCliente3%', '_______________________________', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente4%' && $objSignature[$i]->is_active == 1) {
                $html = str_replace('%firmaCliente4%', '_______________________________', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente5%' && $objSignature[$i]->is_active == 1) {
                $html = str_replace('%firmaCliente5%', '_______________________________', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente6%' && $objSignature[$i]->is_active == 1) {
                $html = str_replace('%firmaCliente6%', '_______________________________', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente7%' && $objSignature[$i]->is_active == 1) {
                $html = str_replace('%firmaCliente7%', '_______________________________', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente8%' && $objSignature[$i]->is_active == 1) {
                $html = str_replace('%firmaCliente8%', '_______________________________', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente9%' && $objSignature[$i]->is_active == 1) {
                $html = str_replace('%firmaCliente9%', '_______________________________', $html);
            }
        }

        $html = View::make('Contratos.print-pdf', ['html' => $html, 'plantilla' => $obj])->render();
        $pdf =  Pdf::loadHTML($html)->setPaper($objContract->getTemplateContract->size, $objContract->getTemplateContract->orientation)->setWarnings(false);
        return  $pdf->download($obj->name . '.pdf');
    }


    public function generateContract(Request $request, $contract_template_id)
    {
        $template = IspCustomerContractTemplate::find($contract_template_id);
        $objContract = IspContract::find($request->contract_id);
        $objContract->status_id = Controller::getStatus('contract', 'isp', 'SFR');
        $objContract->save();
        $html = $request->html;

        $objSignature = IspTemplateContractSignature::where('customer_contract_template_id', $template->id)->get();
        for ($i = 0; $i < $objSignature->count(); $i++) {
            if ($objSignature[$i]->long_code == '%firmaCliente1%' && $objSignature[$i]->is_active == 0) {
                $content = public_path('images/noFirma1.png');
                $imageData = base64_encode(file_get_contents($content));
                $src = 'data:' . mime_content_type($content) . ';base64,' . $imageData;
                $html = str_replace('%firmaCliente1%', '<img alt="" src="' . $src . '" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente2%' && $objSignature[$i]->is_active == 0) {
                $content = public_path('images/noFirma2.png');
                $imageData = base64_encode(file_get_contents($content));
                $src = 'data:' . mime_content_type($content) . ';base64,' . $imageData;
                $html = str_replace('%firmaCliente2%', '<img alt="" src="' . $src . '" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente3%' && $objSignature[$i]->is_active == 0) {
                $content = public_path('images/noFirma3.png');
                $imageData = base64_encode(file_get_contents($content));
                $src = 'data:' . mime_content_type($content) . ';base64,' . $imageData;
                $html = str_replace('%firmaCliente3%', '<img alt="" src="' . $src . '" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente4%' && $objSignature[$i]->is_active == 0) {
                $content = public_path('images/noFirma4.png');
                $imageData = base64_encode(file_get_contents($content));
                $src = 'data:' . mime_content_type($content) . ';base64,' . $imageData;
                $html = str_replace('%firmaCliente4%', '<img alt="" src="' . $src . '" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente5%' && $objSignature[$i]->is_active == 0) {
                $content = public_path('images/noFirma5.png');
                $imageData = base64_encode(file_get_contents($content));
                $src = 'data:' . mime_content_type($content) . ';base64,' . $imageData;
                $html = str_replace('%firmaCliente5%', '<img alt="" src="' . $src . '" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente6%' && $objSignature[$i]->is_active == 0) {
                $content = public_path('images/noFirma6.png');
                $imageData = base64_encode(file_get_contents($content));
                $src = 'data:' . mime_content_type($content) . ';base64,' . $imageData;
                $html = str_replace('%firmaCliente6%', '<img alt="" src="' . $src . '" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente7%' && $objSignature[$i]->is_active == 0) {
                $content = public_path('images/noFirma7.png');
                $imageData = base64_encode(file_get_contents($content));
                $src = 'data:' . mime_content_type($content) . ';base64,' . $imageData;
                $html = str_replace('%firmaCliente7%', '<img alt="" src="' . $src . '" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente8%' && $objSignature[$i]->is_active == 0) {
                $content = public_path('images/noFirma8.png');
                $imageData = base64_encode(file_get_contents($content));
                $src = 'data:' . mime_content_type($content) . ';base64,' . $imageData;
                $html = str_replace('%firmaCliente8%', '<img alt="" src="' . $src . '" width="100" />', $html);
            }
            if ($objSignature[$i]->long_code == '%firmaCliente9%' && $objSignature[$i]->is_active == 0) {
                $content = public_path('images/noFirma9.png');
                $imageData = base64_encode(file_get_contents($content));
                $src = 'data:' . mime_content_type($content) . ';base64,' . $imageData;
                $html = str_replace('%firmaCliente9%', '<img alt="" src="' . $src . '" width="100" />', $html);
            }
        }
        IspCustomerContractTemplate::whereId($contract_template_id)->update([
            'is_generated' => true,
            'html' => $html,
        ]);
        return response()->json(['success' => true]);
    }


    public function getContractTemplateSignature($contractTemplateId)
    {
        $obj = IspTemplateContractSignature::where('customer_contract_template_id', $contractTemplateId)->orderBy('orderBy', 'ASC')->get();
        return response()->json([
            'obj'  => $obj,
        ]);
    }

    public function signatureActiveRecord(Request $request, $id)
    {
        $obj = IspTemplateContractSignature::find($id);
        if ($request->is_active == 0) {
            $obj->is_required = 0;
        } else {
            $obj->is_required = 1;
        }
        $obj->is_active  = $request->is_active;
        $obj->save();
        return response()->json(['success' => true]);
    }

    public function signatureRequiredRecord(Request $request, $id)
    {
        $obj = IspTemplateContractSignature::find($id);
        $obj->is_required  = $request->is_required;
        $obj->save();
        return response()->json(['success' => true]);
    }

    public function getTemplateContract()
    {
        $obj = TemplateContract::where('is_active', 1)->get();
        return response()->json([
            'obj'  => $obj,
        ]);
    }

    public function getSector()
    {
        $obj = IspSector::join('isp_locations', 'isp_locations.id', '=', 'isp_sectors.location_id')
            ->select(
                DB::raw('CONCAT(isp_sectors.sector," | ",isp_locations.location,", ", isp_locations.city  ,", ", isp_locations.state) as sector_name'),
                'isp_sectors.id as sector_uuid',
                'isp_sectors.latitude as latitude',
                'isp_sectors.longitude as longitude'
            )->get();
        return response()->json([
            'obj'  => $obj,
        ]);
    }


    public function getAnotherProvider()
    {
        $obj = IspAnotherProvider::get();

        return response()->json([
            'obj'  => $obj,
        ]);
    }


    public function getPayment()
    {
        $obj = Payment::get();

        return response()->json([
            'obj'  => $obj,
        ]);
    }

    public function getPlan($last_mile_id)
    {
        $obj = IspPlan::with('getPlanDetail', 'getPlanDetail.getMinimunPermanence')->where('last_mile_id', $last_mile_id)->get();

        return response()->json([
            'obj'  => $obj,
        ]);
    }

    public function getCustomer(Request $request)
    {
        //return "holaaaa";
        $helpers = new Helpers();
        $columns = array();
        $param = array();
        $type = null;

        $searchValues = preg_split('/\s+/', $request->q, -1, PREG_SPLIT_NO_EMPTY);

        $service = IspCustomer::where('deleted_at', '=', null);
        //  str_replace(' ', '', $request->q);
        $Filtred = $helpers->filter($service, $columns, $param, $request, $type)
            ->where(function ($query) use ($request, $searchValues) {
                return $query->when($request->filled('q'), function ($query) use ($request, $searchValues) {
                    foreach ($searchValues as $value) {
                        return $query->Where('fullname', 'LIKE', "%{$value}%")
                            ->orWhere('identification', 'LIKE', "%{$value}%");
                    }
                });
            })->get();

        return $Filtred;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth('apiTenant')->user()->hasrole('Root')) {
            if (\Request::exists('all')) {
            }
            $helpers = new Helpers();
            $columns = array();
            $param = array();
            $type = null;

            if (!empty(\Request::exists('created_at'))) {
                //Filtros para campos de auditoría con tipo de dato timestap;
                $columns = array(0 => 'created_at');
                $param = array(0 => '=');
                $type = 1;
            } else {
                //Filtros normales
                $columns = array(0 => 'is_active', 1 => 'type_people');
                $param = array(0 => '=', 1 => '=');
                $type = 0;
            }
            $service = IspContract::with('getContactContract', 'getCustomerContractTemplate', 'getContractPlan', 'getStatus', 'getContractPlan.getPlan.getLastMile', 'getSector', 'getCustomer')->where('deleted_at', '=', null);

            $Filtred = $helpers->filter($service, $columns, $param, $request, $type)
                ->where(function ($query) use ($request) {
                    return $query->when($request->filled('q'), function ($query) use ($request) {
                        return $query->where('name_company', 'LIKE', "%{$request->q}%")
                            ->orWhere('fullname', 'LIKE', "%{$request->q}%")
                            ->orWhere('identification', 'LIKE', "%{$request->q}%")
                            ->orWhere('address', 'LIKE', "%{$request->q}%");
                    });
                })->orderBy('created_at', 'DESC')->paginate(
                    request(
                        'perPage',
                        \Request::get('perPage') ?? 1
                    )
                );

            $sortedResult = $Filtred->getCollection()->sortByDesc(request(
                'sortBy',
                \Request::get('sortBy') ?? 'created_at'
            ))->values();

            $Filtred->setCollection($sortedResult);
            return $Filtred;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = IspContract::createdRules($request->all());
        if ($validator->fails()) {
            return response()->json(['isvalid' => false, 'errors' => $validator->messages()], 422);
        }
        $objCp = [
            'plan_id' => $request->plan_id,
            'installation_cost' => $request->installation_cost,
            'month_cost' => $request->month_cost,
            'minimun_permanence_id'  => $request->minimun_permanence_id,
            'permanence_cost' => $request->permanence_cost,
            'is_permanence_cost' => $request->is_permanence_cost,
            'compartition' => $request->compartition,
        ];
        $dataCp = IspContractPlan::create($objCp);

        $input['emission_at'] = $request->emission_at;
        $input['contract_plan_id'] =  $dataCp->id;
        $input['break_day'] = json_encode($request->break_day);
        $input['customer_id'] = $request->customer_id;
        $input['username'] = $request->username;
        $input['sector_id'] = $request->sector_id;
        $sequential = Sequential::first();
        $input['sequential'] = str_pad(($sequential->contracts + 1), 9, "0", STR_PAD_LEFT);
        $sequential->contracts = $input['sequential'] + 1;
        $sequential->save();
        $input['sequential'] = str_pad(($sequential->cuentas_cobrar + 1), 9, "0", STR_PAD_LEFT);
        $input['address_contract'] = $request->address_contract;
        $input['contract_version_id'] = $request->contract_version_id;
        $input['address_contract'] = $request->address_contract;
        $input['another_provider_id'] = $request->another_provider_id;
        $input['payment_id'] = $request->payment_id;
        $input['adviser_id'] = $request->adviser_id;
        $input['status_id'] = Controller::getStatus('contract', 'isp', 'EPO');
        $input['is_reconnection_cost'] = $request->is_reconnection_cost;
        $input['reconnection_cost'] = $request->reconnection_cost;
        $input['is_from_another_provider'] = $request->is_from_another_provider;
        $input['is_pay_to_invoice'] = $request->is_pay_to_invoice;
        $input['is_apply_arcotel'] = $request->is_apply_arcotel;
        $input['is_not_cut_for_debt'] = $request->is_not_cut_for_debt;
        $input['is_not_generate_invoice_service'] = $request->is_not_generate_invoice_service;

        $obj = IspContract::create($input);
        Controller::createFolder('contract', $obj->id);

        $template = TemplateContract::find($obj->contract_version_id);
        $html = $template->html;
        $html = str_replace('%noContrato%', $obj->sequential, $html);
        $html = str_replace('%nCiudad%', $obj->getSector->getLocation->city, $html);
        $html = str_replace('%nDia%', Carbon::parse($obj->emission_at)->format('d'), $html);
        $html = str_replace('%nMes%', Carbon::parse($obj->emission_at)->format('M'), $html);
        $html = str_replace('%nAno%', Carbon::parse($obj->emission_at)->format('Y'), $html);
        //Datos Prestador
        $empresa = Company::first();
        $html = str_replace('%nNombreE%', $empresa->name, $html);
        //  $html = str_replace('%nDireccionE%', $empresa->direccion, $html);
        $html = str_replace('%nProvinciaE%', $obj->getSector->getLocation->state, $html);
        //  $html = str_replace('%nTelefonoE%', $empresa->telefono_1 . ($empresa->telefono_2 ? ' - ' . $empresa->telefono_2 : ''), $html);
        //  $html = str_replace('%nIdE%', $empresa->identificador, $html);
        //  $html = str_replace('%nEmailE%', $empresa->email_1 . ($empresa->email_2 ? ' - ' . $empresa->email_2 : ''), $html);
        // Datos Abonado o Suscriptor
        $cliente = $obj->getCustomer;
        $html = str_replace('%nNombreC%', $cliente->fullname, $html);
        $html = str_replace('%nIdC%', $cliente->identification, $html);
        $html = str_replace('%nDireccionC%', $cliente->address, $html);
        $html = str_replace('%nProvinciaC%', $obj->getSector->getLocation->state, $html);
        $html = str_replace('%nCiudadC%', $obj->getSector->getLocation->city, $html);
        $html = str_replace('%nCantonC%', $obj->getSector->getLocation->city, $html);
        $html = str_replace('%nParroquiaC%', $obj->getSector->getLocation->location, $html);
        $contactosContratos = $obj->getContactContract;
        $listaContactos = 'S/N';
        if ($contactosContratos) {
            $listaContactos = '';
            $i = 1;
            foreach ($contactosContratos as $contacto) {
                if ($i < count($contactosContratos)) {
                    $listaContactos = $listaContactos . $contacto->phone . ' | ';
                } else {
                    $listaContactos = $listaContactos . $contacto->phone;
                }
                $i++;
            }
        }
        $html = str_replace('%nTelefonoC%', $listaContactos, $html);
        $html = str_replace('%nDireccionInstalacionC%', $obj->direccion, $html);
        $html = str_replace('%nEmailC%', $cliente->email, $html);
        $html = str_replace('%eDiscapacitadoC%', ($cliente->is_disability ? 'SI' : 'NO'), $html);
        $edadCliente = Carbon::parse($cliente->started_at)->age;
        $html = str_replace('%eTarifareferencialC%', ($edadCliente >= 65 ? 'SI' : 'NO'), $html);
        //datos tecnicos y otros
        $html = str_replace('%tContratoC%', $obj->getContractPlan->getMinimunPermanence->name, $html);
        $html = str_replace('%nCanton%',  $obj->getSector->getLocation->city, $html);
        $html = str_replace('%fContrato%', $obj->emisioemission_atn, $html);
        $html = str_replace('%nPlan%', $obj->getContractPlan->getPlan->name, $html);
        $html = str_replace('%fPagos%', $obj->break_day, $html);
        $html = str_replace('%rAcceso%', $obj->getContractPlan->getPlan->getLastMile->name, $html);

        $html = str_replace('%nComparticion%', $obj->getContractPlan->compartition, $html);

        if ($obj->getContractPlan->getPlan->type_increase == 'K') {
            $html = str_replace('%cSubida%', ($obj->getContractPlan->getPlan->increase  / 1024), $html);
            $html = str_replace('%mSubida%', ((intval($obj->getContractPlan->getPlan->increase)  / substr($obj->getContractPlan->compartition, -1)) / 1024), $html);
        } else {
            $html = str_replace('%cSubida%', ($obj->getContractPlan->getPlan->increase), $html);
            $html = str_replace('%mSubida%', ((intval($obj->getContractPlan->getPlan->increase) / substr($obj->getContractPlan->compartition, -1))), $html);
        }

        if ($obj->getContractPlan->getPlan->type_increase == 'K') {
            $html = str_replace('%cBajada%', ($obj->getContractPlan->getPlan->downfall / 1024), $html);
            $html = str_replace('%mBajada%', ((intval($obj->getContractPlan->getPlan->downfall) / substr($obj->getContractPlan->compartition, -1)) / 1024), $html);
        } else {
            $html = str_replace('%cBajada%', ($obj->getContractPlan->getPlan->downfall), $html);
            $html = str_replace('%mBajada%', ((intval($obj->getContractPlan->getPlan->downfall) / substr($obj->getContractPlan->compartition, -1))), $html);
        }
        $html = str_replace('%vInstalacion%', $obj->getContractPlan->installation_cost, $html);
        $html = str_replace('%pMinima%', $obj->getContractPlan->getMinimunPermanence->name, $html);
        $html = str_replace('%vMensual%', $obj->getContractPlan->month_cost, $html);
        $html = str_replace('%pReconexion%', number_format(($obj->reconnection_cost ? $obj->reconnection_cost : 0), 2), $html);
        $html = str_replace('%uMilla%', $obj->getContractPlan->getPlan->getLastMile->name, $html);
        $html = str_replace('%sector%',  $obj->getSector->name, $html);
        // $html = str_replace('%vPromoInstalacion%', $obj->promo_instalacion ? number_format($contrato->promo_instalacion, 2) : number_format(0, 2), $html);
        /*  
        $html = str_replace('%tCuenta%', $contrato->getTipoServicio->nomre, $html);

      
   
    
*/
        // $obj['html'] = $html;
        $objContract['contract_id'] =  $obj->id;
        $objContract['html'] =  $html;
        $objTemplate = IspCustomerContractTemplate::create($objContract);
        $this->createSignatures($objTemplate->id);
        $objContactCustomer = IspContactCustomer::where('customer_id', $obj->customer_id)->get();

        if (isset($objContactCustomer)) {
            for ($i = 0; $i < count($objContactCustomer); $i++) {
                $objData = [
                    'contract_id'  =>  $obj->id,
                    'name'  => $objContactCustomer[$i]->name,
                    'name_parent'  => $objContactCustomer[$i]->name_parent,
                    'email'  => $objContactCustomer[$i]->email,
                    'type_number'  => $objContactCustomer[$i]->type_number,
                    'phone'  =>   $objContactCustomer[$i]->phone,
                ];
                IspContactContract::create($objData);
            }
        }

        return response()->json([
            'obj'  => $obj
        ]);
    }


    public function createSignatures($contract_customer_template_id)
    {
        $obj = [
            [
                'name' => '%firmaCliente1%',
                'description' => 'Firma 1',
                'long_code' => '%firmaCliente1%',
                'orderby' => '1'
            ],
            [
                'name' => '%firmaCliente2%',
                'description' => 'Firma 2',
                'long_code' => '%firmaCliente2%',
                'orderby' => '2'
            ],
            [
                'name' => '%firmaCliente3%',
                'description' => 'Firma 3',
                'long_code' => '%firmaCliente3%',
                'orderby' => '3'
            ],
            [
                'name' => '%firmaCliente4%',
                'description' => 'Firma 4',
                'long_code' => '%firmaCliente4%',
                'orderby' => '4'
            ],
            [
                'name' => '%firmaCliente5%',
                'description' => 'Firma 5',
                'long_code' => '%firmaCliente5%',
                'orderby' => '5'
            ],
            [
                'name' => '%firmaCliente6%',
                'description' => 'Firma 6',
                'long_code' => '%firmaCliente6%',
                'orderby' => '6'
            ],
            [
                'name' => '%firmaCliente7%',
                'description' => 'Firma 7',
                'long_code' => '%firmaCliente7%',
                'orderby' => '7'
            ],
            [
                'name' => '%firmaCliente8%',
                'description' => 'Firma 8',
                'long_code' => '%firmaCliente8%',
                'orderby' => '8'
            ],
            [
                'name' => '%firmaCliente9%',
                'description' => 'Firma 9',
                'long_code' => '%firmaCliente9%',
                'orderby' => '9'
            ],
        ];


        foreach ($obj as $value) {
            IspTemplateContractSignature::create([
                'customer_contract_template_id' => $contract_customer_template_id,
                'name' => $value["name"],
                'description' => $value["description"],
                'long_code' => $value["long_code"],
                'orderby' => $value["orderby"],
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IspContract  $ispContract
     * @return \Illuminate\Http\Response
     */
    public function show(IspContract $ispContract)
    {
        //
    }

    public function getBreakDay()
    {
        return response()->json([
            'obj'  => json_decode((Company::first())->break_day)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IspContract  $ispContract
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $obj = IspContract::with('getContactContract', 'getCustomerContractTemplate', 'getStatus', 'getContractPlan.getPlan.getLastMile', 'getSector', 'getCustomer')->find($id);
        $obj["break_day"] = json_decode($obj["break_day"]);
        return response()->json([
            'obj'  => $obj,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IspContract  $ispContract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IspContract $ispContract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IspContract  $ispContract
     * @return \Illuminate\Http\Response
     */
    public function destroy(IspContract $ispContract)
    {
        //
    }
}

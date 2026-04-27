<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PayuService;

class PayuController extends Controller
{
    protected $payuService;

    public function __construct(PayuService $payuService)
    {
        $this->payuService = $payuService;
    }

    public function index(Request $request)
    {
        $data = $this->payuService->getPaymentData($request);
        return view('payu.payment_form', compact('data'));
    }

    public function success(Request $request)
    {
        $isValid = $this->payuService->verifyHash($request->all());

        if (!$isValid) {
            return response("Hash Mismatch - Possible Tampering", 400);
        }

        if ($request->status === 'success') {
            // ✅ Update DB: mark payment success
            return "Payment Success & Verified";
        }

        return "Payment Failed";
    }

    public function failure(Request $request)
    {
        $isValid = $this->payuService->verifyHash($request->all());

        if (!$isValid) {
            return response("Hash Mismatch", 400);
        }

        return "Payment Failed & Verified";
    }
}

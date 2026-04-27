<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PaymentService;

class PaymentController extends Controller
{
    public function index(PaymentService $paymentService)
    {
        $order = $paymentService->createOrder(500); // ₹500

        return view('payment', [
            'order' => $order,
            'key' => config('services.razorpay.key')
        ]);
    }

    public function verify(Request $request, PaymentService $paymentService)
    {
        $isValid = $paymentService->verifyPayment([
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature,
        ]);

        if ($isValid) {
            return "Payment Successful";
        } else {
            return "Payment Failed";
        }
    }
}

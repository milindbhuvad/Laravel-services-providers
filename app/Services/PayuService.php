<?php

namespace App\Services;

class PayuService
{
    protected $key;
    protected $salt;

    public function __construct()
    {
        $this->key = config('services.payu.key');
        $this->salt = config('services.payu.salt');
    }

    public function generateHash($data)
    {
        $hashString = $this->key . "|" .
            $data['txnid'] . "|" .
            $data['amount'] . "|" .
            $data['productinfo'] . "|" .
            $data['firstname'] . "|" .
            $data['email'] . "|||||||||||" .
            $this->salt;

        return strtolower(hash('sha512', $hashString));
    }

    public function getPaymentData($request)
    {
        $data = [
            'key' => $this->key,
            'txnid' => uniqid(), // always unique
            'amount' => 100,
            'productinfo' => 'Iphone15',
            'firstname' => 'Milind',
            'email' => 'milindbhuvad1988@gmail.com',
            'phone' => '9876543210',
            'surl' => route('payu.success'),
            'furl' => route('payu.failure'),
        ];

        $data['hash'] = $this->generateHash($data);

        return $data;
    }

    public function verifyHash($response)
    {
        $salt = $this->salt;

        $status = $response['status'];
        $txnid = $response['txnid'];
        $amount = $response['amount'];
        $productinfo = $response['productinfo'];
        $firstname = $response['firstname'];
        $email = $response['email'];
        $key = $this->key;

        $reverseHashString = $salt . "|" . $status . "|||||||||||" .
            $email . "|" . $firstname . "|" . $productinfo . "|" .
            $amount . "|" . $txnid . "|" . $key;

        $calculatedHash = strtolower(hash("sha512", $reverseHashString));

        return $calculatedHash === $response['hash'];
    }
}
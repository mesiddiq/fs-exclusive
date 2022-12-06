<?php

namespace App\Libraries;

require_once dirname(dirname(dirname(__FILE__))). '/vendor/autoload.php';

class Toyyib {
    
    public function __construct()
    {
        // $razorpay_keys = get_settings('razorpay_keys');
        // $razorpay = json_decode($razorpay_keys);
        // $this->keyId = $razorpay[0]->testmode == "on" ? $razorpay[0]->public_key : $razorpay[0]->public_live_key;
        // $this->keySecret = $razorpay[0]->testmode == "on" ? $razorpay[0]->secret_key : $razorpay[0]->secret_live_key;
        // $this->api = new Api($this->keyId, $this->keySecret);
    }

    public function createBill($data = array(), $userData = array(), $orderID = "")
    {
        $createBill = array(
            "userSecretKey" => "bev66sny-a4bk-rl5a-80nz-9geo591vy21z",
            "categoryCode" => "zeeznkr3",
            "billName" => "FS Exclusive - " . $orderID,
            "billDescription" => "FS Exclusive website payment for ID " . $orderID,
            "billPriceSetting" => 1,
            "billPayorInfo" => 1,
            "billAmount" => (int) $data["total"] * 100,
            "billReturnUrl" => site_url() . "paymentStatus",
            "billCallbackUrl" => site_url() ."paymentCallback",
            "billExternalReferenceNo" => "FS" . $orderID . "_" . substr(md5(time()), 0, 15),
            "billTo" => $userData["name"],
            "billEmail" => $userData["email"],
            "billPhone" => $userData["contact"] != NULL ? $userData["contact"] : "0123456789",
            "billSplitPayment" => 0,
            "billSplitPaymentArgs" => "",
            "billPaymentChannel" => "0",
            "billContentEmail" => "Thank you for purchasing our product!",
            "billChargeToCustomer" => 1,
            // "billExpiryDate" => "17-12-2022 17:00:00",
            // "billExpiryDays" => 3
        );  

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, "https://dev.toyyibpay.com/index.php/api/createBill");  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $createBill);

        $result = curl_exec($curl);
        $info = curl_getinfo($curl);  
        curl_close($curl);
        $response = json_decode($result);

        return $response;
    }
    
}
<?php

namespace App\Libraries;

require_once APPPATH. '/vendor/autoload.php';

class Toyyib {

    public function createBill($data = array(), $userData = array(), $addressData = array(), $orderID = "")
    {
        $createBill = array(
            "userSecretKey" => "jkjfluz0-cny7-bnya-pnw6-af4rwas91z6k",
            "categoryCode" => "es4o616f",
            "billName" => "FS Exclusive - " . $orderID,
            "billDescription" => "FS Exclusive website payment for ID " . $orderID,
            "billPriceSetting" => 1,
            "billPayorInfo" => 1,
            "billAmount" => floatval($data["total"]) * 100,
            "billReturnUrl" => site_url() . "paymentStatus?payment=toyyib",
            "billCallbackUrl" => site_url() ."checkout",
            "billExternalReferenceNo" => "FS" . $orderID . mt_rand(10000000, 99999999),
            "billTo" => $addressData["name"],
            "billEmail" => $addressData["email"],
            "billPhone" => $addressData["contact"] != NULL ? $addressData["contact"] : "0123456789",
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
        curl_setopt($curl, CURLOPT_URL, "https://toyyibpay.com/index.php/api/createBill");  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $createBill);

        $result = curl_exec($curl);
        $info = curl_getinfo($curl);  
        curl_close($curl);

        $response = json_decode($result);

        return $response;
    }

    public function verifyBill($billcode, $status_id)
    {
        $verifyBill = array(
            "billCode" => $billcode,
            "billpaymentStatus" => $status_id,
        );  

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_URL, 'https://toyyibpay.com/index.php/api/getBillTransactions');  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $verifyBill);

        $result = curl_exec($curl);
        $info = curl_getinfo($curl);  
        curl_close($curl);

        $response = json_decode($result);

        return $response;
    }
    
}
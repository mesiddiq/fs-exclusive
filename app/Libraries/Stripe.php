<?php

namespace App\Libraries;

require_once APPPATH. '/vendor/autoload.php';

class Stripe {

    public function createPayment($amount, $email)
    {
        $stripe = new \Stripe\StripeClient(
            'sk_test_51MErykA6QzLKCQBYOw1expTp7OaLDmvooaibiEqeNCRGLr335i3WYs7xvcgwLbLnk8ZobgHdwYyPTJnZcf7FkgD200MElqZMKs'
        );
        
        $ch = $stripe->prices->create([
            'unit_amount' => (int) $amount * 100,
            'currency' => 'gbp',
            "product_data" => [
                "name" => "Pay for FS Exclusive",
            ],
        ]);

        // This is your test secret API key.
        \Stripe\Stripe::setApiKey('sk_test_51MErykA6QzLKCQBYOw1expTp7OaLDmvooaibiEqeNCRGLr335i3WYs7xvcgwLbLnk8ZobgHdwYyPTJnZcf7FkgD200MElqZMKs');

        header('Content-Type: application/json');

        $YOUR_DOMAIN = site_url();

        $response = \Stripe\Checkout\Session::create([
            'customer_email' => $email,
            'line_items' => [[
                # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
                'price' => $ch->id,
                'quantity' => 1,
            ]],
            'phone_number_collection' => [
                'enabled' => true,
            ],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . 'paymentStatus?payment=stripe&session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => $YOUR_DOMAIN . 'checkout',
        ]);

        return $response;
    }

    public function verifyPayment($session_id = "")
    {
        $stripe = new \Stripe\StripeClient('sk_test_51MErykA6QzLKCQBYOw1expTp7OaLDmvooaibiEqeNCRGLr335i3WYs7xvcgwLbLnk8ZobgHdwYyPTJnZcf7FkgD200MElqZMKs');

        try {
          $session = $stripe->checkout->sessions->retrieve($session_id);
          return $session;
          http_response_code(200);
        } catch (Error $e) {
          http_response_code(500);
          echo json_encode(['error' => $e->getMessage()]);
        }
    }
    
}
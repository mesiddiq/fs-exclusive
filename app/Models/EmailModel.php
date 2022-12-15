<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailModel extends Model
{

    public function sendRegisterMail($name, $to, $from=NULL)
    {
        // Load email library
        $email = \Config\Services::email();

        if($from == NULL)
            $from = "noreply@sparkztechin.com";

        // Mail configuration
        $config = array(
            "protocol" => "sendmail",
            "mailPath" => "/usr/sbin/sendmail",
            "mailType" => "html",
            "charset"  => "utf-8",
            "wordWrap" => true,
        );

        $email->initialize($config);

        $message = "Hi " . $name . ",<br>";
        $message .= "Your account has been created successfully";

        $email->setTo($to);
        $email->setFrom($from, "Sparkz Techin");
        $email->setSubject("Registration");

        // if ($attachment != NULL) {
        //     $email->attach(site_url('uploads/certificates/'.$attachment));
        // }

        $email->setMessage($message);
        
        // Send email
        $resp = $email->send();
        return $resp;
    }

    public function sendForgotMail($name, $to, $verificationCode, $from=NULL)
    {
        // Load email library
        $email = \Config\Services::email();

        if($from == NULL)
            $from = "noreply@sparkztechin.com";

        // Mail configuration
        $config = array(
            "protocol" => "sendmail",
            "mailPath" => "/usr/sbin/sendmail",
            "mailType" => "html",
            "charset"  => "utf-8",
            "wordWrap" => true,
        );

        $email->initialize($config);

        $message = "Hi " . $name . ",<br>";
        $message .= "<a href='" . site_url('reset?email=' . $to . "&&code=" . $verificationCode) . "'>Click here</a>";

        $email->setTo($to);
        $email->setFrom($from, "Sparkz Techin");
        $email->setSubject("Reset Password");

        // if ($attachment != NULL) {
        //     $email->attach(site_url('uploads/certificates/'.$attachment));
        // }

        $email->setMessage($message);
        
        // Send email
        $resp = $email->send();
        return $resp;
    }

    public function sendCustomProductUserMail($name, $to, $from=NULL)
    {
        // Load email library
        $email = \Config\Services::email();

        if($from == NULL)
            $from = "noreply@sparkztechin.com";

        // Mail configuration
        $config = array(
            "protocol" => "sendmail",
            "mailPath" => "/usr/sbin/sendmail",
            "mailType" => "html",
            "charset"  => "utf-8",
            "wordWrap" => true,
        );

        $email->initialize($config);

        $message = "Hi " . $name . ",<br>";
        $message .= "Thank you for submitting. Our team will contact you soon.";

        $email->setTo($to);
        $email->setFrom($from, "Sparkz Techin");
        $email->setSubject("Product Request");

        // if ($attachment != NULL) {
        //     $email->attach(site_url('uploads/certificates/'.$attachment));
        // }

        $email->setMessage($message);
        
        // Send email
        $resp = $email->send();
        return $resp;
    }

    public function sendCustomProductAdminMail($data, $from=NULL)
    {
        // Load email library
        $email = \Config\Services::email();

        if($from == NULL)
            $from = "noreply@sparkztechin.com";

        // Mail configuration
        $config = array(
            "protocol" => "sendmail",
            "mailPath" => "/usr/sbin/sendmail",
            "mailType" => "html",
            "charset"  => "utf-8",
            "wordWrap" => true,
        );

        $email->initialize($config);

        $message = "Hi, <br>";
        $message .= "New request has been submitted by " . $data["name"];
        $message .= "<table style='width: 100%;'>";
        $message .= "<tr>";
        $message .= "<td>Name</td><td>" . $data["name"] . "</td>";
        $message .= "</tr>";
        $message .= "<tr>";
        $message .= "<td>Email</td><td>" . $data["email"] . "</td>";
        $message .= "</tr>";
        $message .= "<tr>";
        $message .= "<td>Mobile</td><td>" . $data["contact"] . "</td>";
        $message .= "</tr>";
        $message .= "<tr>";
        $message .= "<td>Mobile (Alt)</td><td>" . $data["contact2"] . "</td>";
        $message .= "</tr>";
        $message .= "<tr>";
        $message .= "<td>Address</td><td>" . $data["address"] . ", " . $data["address2"] . "</td>";
        $message .= "</tr>";
        $message .= "<tr>";
        $message .= "<td>City</td><td>" . $data["city"] . "</td>";
        $message .= "</tr>";
        $message .= "<tr>";
        $message .= "<td>State</td><td>" . $data["state"] . "</td>";
        $message .= "</tr>";
        $message .= "<tr>";
        $message .= "<td>Country</td><td>" . $data["country"] . "</td>";
        $message .= "</tr>";
        $message .= "<tr>";
        $message .= "<td>Zipcode</td><td>" . $data["zipcode"] . "</td>";
        $message .= "</tr>";
        $message .= "</table>";

        $email->setTo("admin@sparkztechin.com");
        $email->setFrom($from, "Sparkz Techin");
        $email->setSubject("Product Request");

        if ($data["images"] != NULL) {
            foreach (json_decode($data["images"]) as $key => $image) {
                $email->attach(site_url("uploads/custom/" . $image));
            }
        }

        $email->setMessage($message);
        
        // Send email
        $resp = $email->send();
        return $resp;
    }
    
    public function sendOrderConfirmationUserMail($orderID) {
        $orderInfo = $this->db->table("orders")->where("id", $orderID)->get()->getRowArray();
        $addressInfo = $this->db->table("address")->where("id", $orderInfo["addressId"])->get()->getRowArray();
        $countryInfo = $this->db->table("country")->where("id", $orderInfo["country"])->get()->getRowArray();
        
        // Load email library
        $email = \Config\Services::email();

        if($from == NULL)
            $from = "noreply@sparkztechin.com";

        // Mail configuration
        $config['protocol'] = 'sendmail';
        $config['mailPath'] = '/usr/sbin/sendmail';
        $config['mailType'] = 'html';
        $config['charset']  = 'utf-8';
        $config['wordWrap'] = true;

        $email->initialize($config);

        $message = '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Email Template</title>
        
            <link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">
        </head>
        <body>
            <div style="width: 300px; margin: 0px auto; background-color: #d2b482; padding: 25px;">
                <div style="text-align: center;"><img src="'.site_url().'uploads/logo.png" width="120px"></div>
                <h2 style="padding-top: 25px; font-family: \'Secular One\', sans-serif; color: #000000;"><strong>Hello, '.$addressInfo["name"].'..!</strong></h2>
                <h3 style="font-family: \'Secular One\', sans-serif; color: #000000;"><strong>Thank you for your order!</strong></h3>
                <p style="font-family: \'Secular One\', sans-serif; color: #000000;">Now you can sit and relax. We\'re working on getting your order to you ASAP!</p>
                <div style="padding-bottom: 15px;"><a href="'.site_url().'orders" target="_blank" style="text-decoration: none; font-family: \'Secular One\', sans-serif; cursor: pointer; text-align: center; padding: 0.375rem 0.75rem; font-size: 1rem; color: #ffffff; background-color: #000000; border-color: #000000;">Track Your Order</a></div>
            </div>
            <div style="width: 300px; margin: 0px auto; padding: 25px;">
                <h3 style="padding-bottom: 10px; font-family: \'Secular One\', sans-serif; border-bottom: 2px solid #cecece;">Order Summary</h3>
                <p style="font-size: 14px; font-family: \'Secular One\', sans-serif; color: #000000;">Order ID: FS21_15bf31688d59c2e</p>
                <p style="font-size: 14px; font-family: \'Secular One\', sans-serif; color: #000000;">Date: July 26, 2019 9:34 PM</p>
                <p style="font-size: 14px; font-family: \'Secular One\', sans-serif; color: #000000;">To: July 26, 2019 9:34 PM</p>';
            foreach(json_decode($orderInfo["products"]) as $product) {
                $productInfo = $this->db->table("products")->where("id", $product->productId)->get()->getRowArray();
                $productImage = $this->db->table("productimages")->orderBy("featured DESC")->limit(1)->where("productId", $product->productId)->get()->getRowArray();
                if ($productInfo["isDiscount"] == 1) {
                    $price = $productInfo["discountedPrice"] * $product->productQty;
                } else {
                    $price = $productInfo["price"] * $product->productQty;
                }
                $message .= '<table>
                    <tr>
                        <td><img src="'.site_url().'uploads/products/'.$productImage["name"].'" width="50px"></td>
                        <td style="padding-left: 10px; font-size: 14px; font-family: \'Secular One\', sans-serif; color: #000000;">'.$productInfo["name"].'<br><br>'.$countryInfo["currency"].$price.'</td>
                    </tr>
                </table>';
            }
            $message .= '<p style="padding-top: 10px; margin-bottom: 0px; font-size: 14px; font-family: \'Secular One\', sans-serif; border-top: 2px solid #cecece;">Grand Total</p>
                <h2 style="margin-top: 5px; font-family: \'Secular One\', sans-serif; color: #d2b482;">'.$countryInfo["currency"].$orderInfo["total"].'</h2>
            </div>
        </body>
        </html>';

        $email->setTo($to);
        $email->setFrom($from, "Sparkz Techin");
        $email->setSubject($sub);

        // if ($attachment != NULL) {
        //     $email->attach(site_url('uploads/certificates/'.$attachment));
        // }

        $email->setMessage($message);
        
        // Send email
        $resp = $email->send();
        return $resp;
    }
    
    public function sendMail($msg=NULL, $sub=NULL, $to=NULL, $from=NULL, $attachment=NULL) {
        // Load email library
        $email = \Config\Services::email();

        if($from == NULL)
            $from = "noreply@sparkztechin.com";

        // Mail configuration
        $config['protocol'] = 'sendmail';
        $config['mailPath'] = '/usr/sbin/sendmail';
        $config['mailType'] = 'html';
        $config['charset']  = 'utf-8';
        $config['wordWrap'] = true;

        $email->initialize($config);

        $htmlContent = $msg;

        $email->setTo($to);
        $email->setFrom($from, "Sparkz Techin");
        $email->setSubject($sub);

        // if ($attachment != NULL) {
        //     $email->attach(site_url('uploads/certificates/'.$attachment));
        // }

        $email->setMessage($htmlContent);
        
        // Send email
        $resp = $email->send();
        return $resp;
    }

}
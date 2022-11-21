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
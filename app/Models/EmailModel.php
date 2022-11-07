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
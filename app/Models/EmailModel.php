<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailModel extends Model
{

    public function sendRegisterMail($name, $to, $from=NULL)
    {
        // Load email library
        $email = \Config\Services::email();

        if ($from == NULL)
            $from = "noreply@fsexclusive.com";

        // Mail configuration
        $config = array(
            // "protocol" => "sendmail",
            // "mailPath" => "/usr/sbin/sendmail",
            "protocol" => "smtp",
            "SMTPHost" => "smtp.dreamhost.com",
            "SMTPUser" => "noreply@fsexclusive.com",
            "SMTPPass" => "L6h9bTq8",
            "SMTPPort" => 587,
            "mailType" => "html",
            "charset"  => "utf-8",
            "wordWrap" => true,
        );

        $email->initialize($config);

        $message = '<div style="width: 350px; margin: 0px auto; background: #d2b482; padding: 25px;">
                <div style="text-align: center;"><img src="'.site_url().'uploads/logo.png" width="120px"></div>
            </div>
            <div style="width: 350px; margin: 0px auto; padding: 25px; background-color: #fff2ef;">
                <p style="color: #000000; font-family: \'Open Sans\', sans-serif; padding-bottom: 10px;">Assalamu’Alaikum '.$name.'..!</p>
                <p style="text-align: justify; color: #000000; padding-bottom: 10px;">Welcome to FS Exclusive, the ultimate fashion destination for the discerning shopper! We are thrilled to have you on board as our latest member, and we look forward to providing you with an exceptional shopping experience that you\'ll cherish.</p>
                <p style="text-align: justify; color: #000000; padding-bottom: 10px;">As a member of FS Exclusive, you\'ll enjoy exclusive access to a wide range of premium fashion products from Dubai to your door steps. Whether you\'re looking for the latest trends, or something that is timeless and elegant, our collection has something for everyone. From modest wear to contemporary styles, we cater to all your fashion needs.</p>
                <p style="text-align: justify; color: #000000; padding-bottom: 10px;">To get started, simply log in to your account and browse through our collection of products. Our products are carefully curated to ensure that they meet the highest quality standards, and we\'re sure you\'ll love what you see.</p>
                <p style="text-align: justify; color: #000000; padding-bottom: 10px;">If you have any questions, or need assistance with anything, please do not hesitate to contact our friendly customer support team on <a href="mailto:info@fsexclusive.com">info@fsexclusive.com</a>. We\'re here to help you in any way we can.</p>
                <p style="text-align: justify; color: #000000;">Thank you for choosing FS Exclusive as your fashion destination. We look forward to serving you and exceeding your expectations!</p>
                <p style="color: #000000; margin-top: 25px;">Best regards,</p>
                <p style="color: #000000;">FS Exclusive Team</p>
            </div>
            <div style="width: 350px; margin: 0px auto; background: #d2b482; padding: 25px; text-align: center;">
                <table width="100%">
                    <tr>
                        <td style="width: 53%">
                            <ul style="padding-left: 0px; margin-bottom: 0px;">
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; padding-left: 0px; margin-left: 0px;"><a href="' . site_url("about") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">About</a></li>
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; margin-left: 0px;"><a href="' . site_url("products") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">Shop</a></li>
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; margin-left: 0px;"><a href="' . site_url("contact") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">Contact</a></li>
                            </ul>
                        </td>
                        <td style="border-left: 1px solid #000000;">
                            <ul style="padding-left: 0px; margin-bottom: 0px; text-align: center">';
                                if (getSettings("facebookLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-left: 7px; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("facebookLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/facebook_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("twitterLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("twitterLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/twitter_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("instagramLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("instagramLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/instagram_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("linkedinLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("linkedinLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/linkedin_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("youtubeLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("youtubeLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/youtube_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("tiktokLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("tiktokLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/tiktok_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                            '</ul>
                        </td>
                    </tr>
                </table>
            </div>';

        $email->setTo($to);
        $email->setFrom($from, "FS Exclusive");
        $email->setSubject("Welcome to FS Exclusive - Your Fashion Destination!");

        $email->setMessage($message);
        
        // Send email
        $resp = $email->send();
        return $resp;
    }

    public function sendForgotMail($name, $to, $verificationCode, $from=NULL)
    {
        // Load email library
        $email = \Config\Services::email();

        if ($from == NULL)
            $from = "noreply@fsexclusive.com";

        // Mail configuration
        $config = array(
            // "protocol" => "sendmail",
            // "mailPath" => "/usr/sbin/sendmail",
            "protocol" => "smtp",
            "SMTPHost" => "smtp.dreamhost.com",
            "SMTPUser" => "noreply@fsexclusive.com",
            "SMTPPass" => "L6h9bTq8",
            "SMTPPort" => 587,
            "mailType" => "html",
            "charset"  => "utf-8",
            "wordWrap" => true,
        );

        $email->initialize($config);

        // $message = "Assalamu’Alaikum " . $name . ",<br>";
        // $message .= "<a href='" . site_url('reset?email=' . $to . "&&code=" . $verificationCode) . "'>Click here</a>";
        $message = '<div style="width: 350px; margin: 0px auto; background: #d2b482; padding: 25px;">
                <div style="text-align: center;"><img src="'.site_url().'uploads/logo.png" width="120px"></div>
            </div>
            <div style="width: 350px; margin: 0px auto; padding: 25px; background-color: #fff2ef;">
                <p style="color: #000000; font-family: \'Open Sans\', sans-serif; padding-bottom: 10px;">Assalamu’Alaikum '.$name.'..!</p>
                <p style="text-align: justify; color: #000000;">We received a request to reset your password for your FS Exclusive account. Please use the following link to reset your password:</p>
                <p style="padding: 20px 0;"><a href="'.site_url("reset?email=" . $to . "&&code=" . $verificationCode).'" style="background: #000000;color: #fff;padding: 10px;text-decoration: none;">Click here</a></p>
                <p style="text-align: justify; color: #000000; padding-bottom: 10px;">If you did not request a password reset, please ignore this email. Your account is still secure and you do not need to take any further action.</p>
                <p style="text-align: justify; color: #000000; padding-bottom: 10px;">Please note that the password reset link will only be valid for 24 hours. If you have any trouble accessing your account or need any assistance, please do not hesitate to contact our customer support team on <a href="mailto:info@fsexclusive.com">info@fsexclusive.com</a>.</p>
                <p style="text-align: justify; color: #000000;">Thank you for shopping with FS Exclusive. We\'re committed to providing you with the best shopping experience and ensuring that your account is secure.</p>
                <p style="color: #000000; margin-top: 25px;">Best regards,</p>
                <p style="color: #000000;">FS Exclusive Team</p>
            </div>
            <div style="width: 350px; margin: 0px auto; background: #d2b482; padding: 25px; text-align: center;">
                <table width="100%">
                    <tr>
                        <td style="width: 53%">
                            <ul style="padding-left: 0px; margin-bottom: 0px;">
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; padding-left: 0px; margin-left: 0px;"><a href="' . site_url("about") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">About</a></li>
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; margin-left: 0px;"><a href="' . site_url("products") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">Shop</a></li>
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; margin-left: 0px;"><a href="' . site_url("contact") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">Contact</a></li>
                            </ul>
                        </td>
                        <td style="border-left: 1px solid #000000;">
                            <ul style="padding-left: 0px; margin-bottom: 0px; text-align: center">';
                                if (getSettings("facebookLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-left: 7px; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("facebookLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/facebook_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("twitterLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("twitterLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/twitter_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("instagramLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("instagramLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/instagram_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("linkedinLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("linkedinLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/linkedin_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("youtubeLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("youtubeLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/youtube_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("tiktokLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("tiktokLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/tiktok_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                            '</ul>
                        </td>
                    </tr>
                </table>
            </div>';

        $email->setTo($to);
        $email->setFrom($from, "FS Exclusive");
        $email->setSubject("FS Exclusive Password Reset");

        $email->setMessage($message);
        
        // Send email
        $resp = $email->send();
        return $resp;
    }

    public function sendCustomProductUserMail($name, $to, $from=NULL)
    {
        // Load email library
        $email = \Config\Services::email();

        if ($from == NULL)
            $from = "noreply@fsexclusive.com";

        // Mail configuration
        $config = array(
            // "protocol" => "sendmail",
            // "mailPath" => "/usr/sbin/sendmail",
            "protocol" => "smtp",
            "SMTPHost" => "smtp.dreamhost.com",
            "SMTPUser" => "noreply@fsexclusive.com",
            "SMTPPass" => "L6h9bTq8",
            "SMTPPort" => 587,
            "mailType" => "html",
            "charset"  => "utf-8",
            "wordWrap" => true,
        );

        $email->initialize($config);

        $message = '<div style="width: 350px; margin: 0px auto; background: #d2b482; padding: 25px;">
                <div style="text-align: center;"><img src="'.site_url().'uploads/logo.png" width="120px"></div>
            </div>
            <div style="width: 350px; margin: 0px auto; padding: 25px; background-color: #fff2ef;">
                <p style="color: #000000; font-family: \'Open Sans\', sans-serif; padding-bottom: 10px;">Assalamu’Alaikum '.$name.'..!</p>
                <p style="text-align: justify; color: #000000; padding-bottom: 10px;">Thank you for submitting a pre-order request form on FS Exclusive. We\'re excited to offer you the opportunity to get your hands on this exclusive product.</p>
                <p style="text-align: justify; color: #000000; padding-bottom: 10px;">Please note that your pre-order submission is subject to availability and our team will be in touch with you shortly to confirm the availability and estimated delivery time of the product. Once the product becomes available, we will notify you via email with further instructions on how to complete your purchase.</p>
                <p style="text-align: justify; color: #000000; padding-bottom: 10px;">If you have any questions or concerns regarding your pre-order submission, please feel free to contact our customer support team on <a href="mailto:info@fsexclusive.com">info@fsexclusive.com</a>. We\'re here to help you in any way we can.</p>
                <p style="text-align: justify; color: #000000;">Thank you for your interest in FS Exclusive. We appreciate your business and look forward to serving you.</p>
                <p style="color: #000000; margin-top: 25px;">Best regards,</p>
                <p style="color: #000000;">FS Exclusive Team</p>
            </div>
            <div style="width: 350px; margin: 0px auto; background: #d2b482; padding: 25px; text-align: center;">
                <table width="100%">
                    <tr>
                        <td style="width: 53%">
                            <ul style="padding-left: 0px; margin-bottom: 0px;">
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; padding-left: 0px; margin-left: 0px;"><a href="' . site_url("about") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">About</a></li>
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; margin-left: 0px;"><a href="' . site_url("products") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">Shop</a></li>
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; margin-left: 0px;"><a href="' . site_url("contact") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">Contact</a></li>
                            </ul>
                        </td>
                        <td style="border-left: 1px solid #000000;">
                            <ul style="padding-left: 0px; margin-bottom: 0px; text-align: center">';
                                if (getSettings("facebookLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-left: 7px; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("facebookLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/facebook_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("twitterLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("twitterLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/twitter_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("instagramLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("instagramLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/instagram_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("linkedinLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("linkedinLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/linkedin_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("youtubeLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("youtubeLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/youtube_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("tiktokLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("tiktokLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/tiktok_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                            '</ul>
                        </td>
                    </tr>
                </table>
            </div>';

        $email->setTo($to);
        $email->setFrom($from, "FS Exclusive");
        $email->setSubject("FS Exclusive Pre-Order Confirmation");

        $email->setMessage($message);
        
        // Send email
        $resp = $email->send();
        return $resp;
    }

    public function sendCustomProductAdminMail($data, $from=NULL)
    {
        // Load email library
        $email = \Config\Services::email();

        if ($from == NULL)
            $from = "noreply@fsexclusive.com";

        // Mail configuration
        $config = array(
            // "protocol" => "sendmail",
            // "mailPath" => "/usr/sbin/sendmail",
            "protocol" => "smtp",
            "SMTPHost" => "smtp.dreamhost.com",
            "SMTPUser" => "noreply@fsexclusive.com",
            "SMTPPass" => "L6h9bTq8",
            "SMTPPort" => 587,
            "mailType" => "html",
            "charset"  => "utf-8",
            "wordWrap" => true,
        );

        $email->initialize($config);

        $message = '<div style="width: 350px; margin: 0px auto; background: #d2b482; padding: 25px;">
                <div style="text-align: center;"><img src="'.site_url().'uploads/logo.png" width="120px"></div>
            </div>
            <div style="width: 350px; margin: 0px auto; padding: 25px; background-color: #fff2ef;">
                <p style="color: #000000; font-family: \'Open Sans\', sans-serif; padding-bottom: 10px;">Hi..!</p>';
        $message .= "<p style='color: #000000; font-family: \"Open Sans\", sans-serif; padding-bottom: 10px;'>New Pre-Order request has been submitted by " . $data["name"] . "</p>";
        $message .= "<table style='width: 100%;'>";
        $message .= "<tr>";
        $message .= "<td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>Name</td><td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>" . $data["name"] . "</td>";
        $message .= "</tr>";
        $message .= "<tr>";
        $message .= "<td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>Email</td><td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>" . $data["email"] . "</td>";
        $message .= "</tr>";
        $message .= "<tr>";
        $message .= "<td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>Mobile</td><td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>" . $data["contact"] . "</td>";
        $message .= "</tr>";
        if ($data["contact2"] != "") {
            $message .= "<tr>";
            $message .= "<td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>Mobile (Alt)</td><td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>" . $data["contact2"] . "</td>";
            $message .= "</tr>";
        }
        $message .= "<tr>";
        $message .= "<td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>Address</td><td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>" . $data["address"] . ", " . $data["address2"] . "</td>";
        $message .= "</tr>";
        $message .= "<tr>";
        $message .= "<td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>City</td><td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>" . $data["city"] . "</td>";
        $message .= "</tr>";
        $message .= "<tr>";
        $message .= "<td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>State</td><td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>" . $data["state"] . "</td>";
        $message .= "</tr>";
        $message .= "<tr>";
        $message .= "<td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>Country</td><td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>" . $data["country"] . "</td>";
        $message .= "</tr>";
        $message .= "<tr>";
        $message .= "<td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>Zipcode</td><td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>" . $data["zipcode"] . "</td>";
        $message .= "</tr>";
        if ($data["url"] != "") {
            $message .= "<tr>";
            $message .= "<td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>URL</td><td style='color: #000000; font-family: \"Open Sans\", sans-serif;'><a href='" . $data["url"] . "' target='_blank'>Link</a></td>";
            $message .= "</tr>";
        }
        $message .= "</table>";
        $message .= '</div>
            <div style="width: 350px; margin: 0px auto; background: #d2b482; padding: 25px; text-align: center;">
                <table width="100%">
                    <tr>
                        <td style="width: 53%">
                            <ul style="padding-left: 0px; margin-bottom: 0px;">
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; padding-left: 0px; margin-left: 0px;"><a href="' . site_url("about") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">About</a></li>
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; margin-left: 0px;"><a href="' . site_url("products") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">Shop</a></li>
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; margin-left: 0px;"><a href="' . site_url("contact") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">Contact</a></li>
                            </ul>
                        </td>
                        <td style="border-left: 1px solid #000000;">
                            <ul style="padding-left: 0px; margin-bottom: 0px; text-align: center">';
                                if (getSettings("facebookLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-left: 7px; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("facebookLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/facebook_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("twitterLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("twitterLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/twitter_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("instagramLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("instagramLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/instagram_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("linkedinLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("linkedinLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/linkedin_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("youtubeLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("youtubeLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/youtube_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("tiktokLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("tiktokLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/tiktok_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                            '</ul>
                        </td>
                    </tr>
                </table>
            </div>';

        // $message = "Hi, <br>";
        // $message .= "New request has been submitted by " . $data["name"];
        // $message .= "<table style='width: 100%;'>";
        // $message .= "<tr>";
        // $message .= "<td>Name</td><td>" . $data["name"] . "</td>";
        // $message .= "</tr>";
        // $message .= "<tr>";
        // $message .= "<td>Email</td><td>" . $data["email"] . "</td>";
        // $message .= "</tr>";
        // $message .= "<tr>";
        // $message .= "<td>Mobile</td><td>" . $data["contact"] . "</td>";
        // $message .= "</tr>";
        // if ($data["contact2"] != "") {
        //     $message .= "<tr>";
        //     $message .= "<td>Mobile (Alt)</td><td>" . $data["contact2"] . "</td>";
        //     $message .= "</tr>";
        // }
        // $message .= "<tr>";
        // $message .= "<td>Address</td><td>" . $data["address"] . ", " . $data["address2"] . "</td>";
        // $message .= "</tr>";
        // $message .= "<tr>";
        // $message .= "<td>City</td><td>" . $data["city"] . "</td>";
        // $message .= "</tr>";
        // $message .= "<tr>";
        // $message .= "<td>State</td><td>" . $data["state"] . "</td>";
        // $message .= "</tr>";
        // $message .= "<tr>";
        // $message .= "<td>Country</td><td>" . $data["country"] . "</td>";
        // $message .= "</tr>";
        // $message .= "<tr>";
        // $message .= "<td>Zipcode</td><td>" . $data["zipcode"] . "</td>";
        // $message .= "</tr>";
        // if ($data["url"] != "") {
        //     $message .= "<tr>";
        //     $message .= "<td>URL</td><td>" . $data["url"] . "</td>";
        //     $message .= "</tr>";
        // }
        // $message .= "</table>";

        $email->setTo("admin@fsexclusive.com");
        $email->setFrom($from, "FS Exclusive");
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

    public function sendContactUserMail($data = array(), $from=NULL)
    {
        // Load email library
        $email = \Config\Services::email();

        if ($from == NULL)
            $from = "noreply@fsexclusive.com";

        // Mail configuration
        $config = array(
            // "protocol" => "sendmail",
            // "mailPath" => "/usr/sbin/sendmail",
            "protocol" => "smtp",
            "SMTPHost" => "smtp.dreamhost.com",
            "SMTPUser" => "noreply@fsexclusive.com",
            "SMTPPass" => "L6h9bTq8",
            "SMTPPort" => 587,
            "mailType" => "html",
            "charset"  => "utf-8",
            "wordWrap" => true,
        );

        $email->initialize($config);

        $message = '<div style="width: 350px; margin: 0px auto; background: #d2b482; padding: 25px;">
                <div style="text-align: center;"><img src="'.site_url().'uploads/logo.png" width="120px"></div>
            </div>
            <div style="width: 350px; margin: 0px auto; padding: 25px; background-color: #fff2ef;">
                <p style="color: #000000; font-family: \'Open Sans\', sans-serif; padding-bottom: 10px;">Assalamu’Alaikum '.$data["name"].'..!</p>
                <p style="text-align: justify; color: #000000; padding-bottom: 10px;">Thank you for contacting FS Exclusive. We have received your message and a member of our customer support team will be in touch with you shortly. We\'re committed to providing you with the best shopping experience and ensuring that your queries and concerns are addressed promptly.</p>
                <p style="text-align: justify; color: #000000; padding-bottom: 10px;">For your reference, here are the details of your message:</p>
                <p style="text-align: justify; color: #000000; padding-bottom: 10px;">
                    Name: '.$data["name"].'<br>
                    Email: '.$data["email"].'<br>
                    Phone: '.$data["phone"].'<br>
                    Subject: '.$data["subject"].'<br>
                    Message: '.$data["message"].'<br>
                </p>
                <p style="text-align: justify; color: #000000; padding-bottom: 10px;">If you have any further questions or concerns, please feel free to contact us on <a href="mailto:info@fsexclusive.com">info@fsexclusive.com</a>. Our customer support team is available to assist you during business hours and will respond to your queries as quickly as possible.</p>
                <p style="text-align: justify; color: #000000;">Thank you for choosing FS Exclusive. We appreciate your business and look forward to serving you in the future.</p>
                <p style="color: #000000; margin-top: 25px;">Best regards,</p>
                <p style="color: #000000;">FS Exclusive Team</p>
            </div>
            <div style="width: 350px; margin: 0px auto; background: #d2b482; padding: 25px; text-align: center;">
                <table width="100%">
                    <tr>
                        <td style="width: 53%">
                            <ul style="padding-left: 0px; margin-bottom: 0px;">
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; padding-left: 0px; margin-left: 0px;"><a href="' . site_url("about") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">About</a></li>
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; margin-left: 0px;"><a href="' . site_url("products") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">Shop</a></li>
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; margin-left: 0px;"><a href="' . site_url("contact") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">Contact</a></li>
                            </ul>
                        </td>
                        <td style="border-left: 1px solid #000000;">
                            <ul style="padding-left: 0px; margin-bottom: 0px; text-align: center">';
                                if (getSettings("facebookLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-left: 7px; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("facebookLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/facebook_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("twitterLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("twitterLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/twitter_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("instagramLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("instagramLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/instagram_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("linkedinLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("linkedinLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/linkedin_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("youtubeLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("youtubeLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/youtube_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("tiktokLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("tiktokLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/tiktok_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                            '</ul>
                        </td>
                    </tr>
                </table>
            </div>';

        $email->setTo($data["email"]);
        $email->setFrom($from, "FS Exclusive");
        $email->setSubject("FS Exclusive Contact Form Submission");

        $email->setMessage($message);
        
        // Send email
        $resp = $email->send();
        return $resp;
    }

    public function sendContactAdminMail($data = array(), $from=NULL) {

        // Load email library
        $email = \Config\Services::email();

        if ($from == NULL)
            $from = "noreply@fsexclusive.com";

        // Mail configuration
        $config = array(
            // "protocol" => "sendmail",
            // "mailPath" => "/usr/sbin/sendmail",
            "protocol" => "smtp",
            "SMTPHost" => "smtp.dreamhost.com",
            "SMTPUser" => "noreply@fsexclusive.com",
            "SMTPPass" => "L6h9bTq8",
            "SMTPPort" => 587,
            "mailType" => "html",
            "charset"  => "utf-8",
            "wordWrap" => true,
        );

        $email->initialize($config);

        $message = '<div style="width: 350px; margin: 0px auto; background: #d2b482; padding: 25px;">
                <div style="text-align: center;"><img src="'.site_url().'uploads/logo.png" width="120px"></div>
            </div>
            <div style="width: 350px; margin: 0px auto; padding: 25px; background-color: #fff2ef;">
                <p style="color: #000000; font-family: \'Open Sans\', sans-serif; padding-bottom: 10px;">Hi..!</p>';
        $message .= "<p style='color: #000000; font-family: \"Open Sans\", sans-serif; padding-bottom: 10px;'>New contact form request has been submitted by " . $data["name"] . "</p>";
        $message .= "<table style='width: 100%;'>";
        $message .= "<tr>";
        $message .= "<td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>Name</td><td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>" . $data["name"] . "</td>";
        $message .= "</tr>";
        $message .= "<tr>";
        $message .= "<td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>Email</td><td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>" . $data["email"] . "</td>";
        $message .= "</tr>";
        $message .= "<tr>";
        $message .= "<td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>Mobile</td><td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>" . $data["phone"] . "</td>";
        $message .= "</tr>";
        $message .= "<tr>";
        $message .= "<td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>Message</td><td style='color: #000000; font-family: \"Open Sans\", sans-serif;'>" . $data["message"] . "</td>";
        $message .= "</tr>";
        $message .= "</table>";
        $message .= '</div>
            <div style="width: 350px; margin: 0px auto; background: #d2b482; padding: 25px; text-align: center;">
                <table width="100%">
                    <tr>
                        <td style="width: 53%">
                            <ul style="padding-left: 0px; margin-bottom: 0px;">
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; padding-left: 0px; margin-left: 0px;"><a href="' . site_url("about") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">About</a></li>
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; margin-left: 0px;"><a href="' . site_url("products") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">Shop</a></li>
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; margin-left: 0px;"><a href="' . site_url("contact") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">Contact</a></li>
                            </ul>
                        </td>
                        <td style="border-left: 1px solid #000000;">
                            <ul style="padding-left: 0px; margin-bottom: 0px; text-align: center">';
                                if (getSettings("facebookLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-left: 7px; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("facebookLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/facebook_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("twitterLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("twitterLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/twitter_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("instagramLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("instagramLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/instagram_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("linkedinLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("linkedinLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/linkedin_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("youtubeLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("youtubeLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/youtube_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("tiktokLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("tiktokLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/tiktok_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                            '</ul>
                        </td>
                    </tr>
                </table>
            </div>';

        // $message = '<!DOCTYPE html>
        // <html>
        // <head>
        //     <meta charset="utf-8">
        //     <meta name="viewport" content="width=device-width, initial-scale=1">
        //     <title>Email Template</title>
        
        //     <link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">
        // </head>
        // <body>
        //     <div style="width: 300px; margin: 0px auto; background-color: #d2b482; padding: 25px;">
        //         <div style="text-align: center;"><img src="'.site_url().'uploads/logo.png" width="120px"></div>
        //         <h2 style="padding-top: 25px; font-family: \'Secular One\', sans-serif; color: #000000;"><strong>Hello, Admin..!</strong></h2>
        //         <h3 style="font-family: \'Secular One\', sans-serif; color: #000000;"><strong>Received request from contact form!</strong></h3>
        //     </div>
        //     <div style="width: 300px; margin: 0px auto; padding: 25px;">
        //         <table width="100%" style="border: 1px solid #ccc; border-collapse: collapse;">
        //             <tr>
        //                 <td style="border: 1px solid #ccc; border-collapse: collapse; padding: 5px; font-family: \'Secular One\', sans-serif; color: #000000;"><strong>Name</strong></td>
        //                 <td style="border: 1px solid #ccc; border-collapse: collapse; padding: 5px; font-family: \'Secular One\', sans-serif; color: #000000;">'.$data["name"].'</td>
        //             </tr>
        //             <tr>
        //                 <td style="border: 1px solid #ccc; border-collapse: collapse; padding: 5px; font-family: \'Secular One\', sans-serif; color: #000000;"><strong>Email</strong></td>
        //                 <td style="border: 1px solid #ccc; border-collapse: collapse; padding: 5px; font-family: \'Secular One\', sans-serif; color: #000000;">'.$data["email"].'</td>
        //             </tr>
        //             <tr>
        //                 <td style="border: 1px solid #ccc; border-collapse: collapse; padding: 5px; font-family: \'Secular One\', sans-serif; color: #000000;"><strong>Phone</strong></td>
        //                 <td style="border: 1px solid #ccc; border-collapse: collapse; padding: 5px; font-family: \'Secular One\', sans-serif; color: #000000;">'.$data["phone"].'</td>
        //             </tr>
        //             <tr>
        //                 <td style="border: 1px solid #ccc; border-collapse: collapse; padding: 5px; font-family: \'Secular One\', sans-serif; color: #000000;"><strong>Message</strong></td>
        //                 <td style="border: 1px solid #ccc; border-collapse: collapse; padding: 5px; font-family: \'Secular One\', sans-serif; color: #000000;">'.$data["message"].'</td>
        //             </tr>
        //         </table>
        //     </div>
        // </body>
        // </html>';

        $email->setTo("info@fsexclusive.com");
        $email->setFrom($from, "FS Exclusive");
        $email->setSubject("Contact Form Submission - " . $data["subject"]);

        $email->setMessage($message);
        
        // Send email
        $resp = $email->send();
        return $resp;
    }
    
    public function sendOrderConfirmationUserMail($orderID, $from=NULL) {
        $orderInfo = $this->db->table("orders")->where("id", $orderID)->get()->getRowArray();
        $addressInfo = $this->db->table("address")->where("id", $orderInfo["addressId"])->get()->getRowArray();
        $countryInfo = $this->db->table("country")->where("id", $orderInfo["country"])->get()->getRowArray();
        $shippingCountry = $this->db->table("shippingcountry")->where("id", $addressInfo["country"])->get()->getRowArray();
        
        // Load email library
        $email = \Config\Services::email();

        if ($from == NULL)
            $from = "noreply@fsexclusive.com";

        // Mail configuration
        $config = array(
            // "protocol" => "sendmail",
            // "mailPath" => "/usr/sbin/sendmail",
            "protocol" => "smtp",
            "SMTPHost" => "smtp.dreamhost.com",
            "SMTPUser" => "noreply@fsexclusive.com",
            "SMTPPass" => "L6h9bTq8",
            "SMTPPort" => 587,
            "mailType" => "html",
            "charset"  => "utf-8",
            "wordWrap" => true,
        );

        $email->initialize($config);

        $message = '<div style="width: 350px; margin: 0px auto; background: #d2b482; padding: 25px;">
                <div style="text-align: center;"><img src="'.site_url().'uploads/logo.png" width="120px"></div>
            </div>
            <div style="width: 350px; margin: 0px auto; padding: 25px; background-color: #fff2ef;">
                <p style="color: #000000; font-family: \'Open Sans\', sans-serif; padding-bottom: 10px;">Assalamu’Alaikum '.$addressInfo["name"].'..!</p>
                <p style="text-align: justify; color: #000000; padding-bottom: 25px;">Thank you for shopping with FS Exclusive. We are delighted to confirm that we have received your order for the following items:</p>
                <p style="font-size: 24px; border-bottom: 2px solid #cecece; color: #000000;">Order Summary</h3>
                <p style="font-size: 14px; color: #000000; padding-top: 10px;">Order ID: '.$orderInfo["paymentOrderId"].'</p>
                <p style="font-size: 14px; color: #000000;">Date: '.date("M d, Y h:i A", $orderInfo["createdAt"]).'</p>
                <p style="font-size: 14px; color: #000000; padding-bottom: 10px;">To: '.$addressInfo["name"].',<br>'.$addressInfo["address"].',<br>'.$addressInfo["address2"].',<br>'.$addressInfo["city"].','.$addressInfo["state"].',<br>'.$shippingCountry["country"].' - '.$addressInfo["zipcode"].'</p>
                <p style="padding-bottom: 10px; margin-top: 10px; margin-bottom: 15px;"><a href="'.site_url("orders").'" style="background: #000000; color: #fff; padding: 10px; text-decoration: none;">Order History</a></p>
                <table style="width: 100%;">';
                foreach(json_decode($orderInfo["products"]) as $product) {
                    $productInfo = $this->db->table("products")->where("id", $product->productId)->get()->getRowArray();
                    $productImage = $this->db->table("productimages")->orderBy("featured DESC")->limit(1)->where("productId", $product->productId)->get()->getRowArray();
                    $variants = "";
                    
                    if ($productInfo["isDiscount"] == 1) {
                        $price = $productInfo["discountedPrice"] * $product->productQty;
                    } else {
                        $price = $productInfo["price"] * $product->productQty;
                    }

                    if ($product->productType == 2) {
                        $size = $this->db->table("productattributesvariants")->where("id", $product->productSize)->get()->getRow()->name;
                        $color = $this->db->table("productattributesvariants")->where("id", $product->productColor)->get()->getRow()->name;
                        $variants = "<small><em>Size: " . $size . " Color: " . $color . "</em></small>";
                    }
                    $message .= '<tr>
                            <td style="width: 50px;">
                                <img src="'.site_url().'uploads/products/'.$productImage["name"].'" width="50px" height="50px">
                            </td>
                            <td style="padding-left: 10px; font-size: 14px; color: #000000;">
                                ' . $productInfo["name"] .'
                                <br>
                                ' . $variants . '
                            </td>
                            <td style="padding-left: 10px; font-size: 14px; color: #000000; text-align: right;">
                                ' . $countryInfo["currency"] . $price . '
                            </td>
                        </tr>';
                }
                $message .= '<tr style="padding-top: 10px; margin-bottom: 0px; font-size: 14px; border-top: 2px solid #cecece;">
                        <td colspan="2" style="text-align: right; font-size: 14px;  color: #000000"">Subtotal</td>
                        <td style="text-align: right; color: #000000">'.$countryInfo["currency"].$orderInfo["subtotal"].'</td>
                    </tr>';
                $message .= '<tr style="padding-top: 10px; margin-bottom: 0px; font-size: 14px;">
                        <td colspan="2" style="text-align: right; font-size: 14px;  color: #000000"">Shipping</td>
                        <td style="text-align: right; color: #000000">'.$countryInfo["currency"].$orderInfo["shipping"].'</td>
                    </tr>';
                $message .= '<tr style="padding-top: 10px; margin-bottom: 0px; font-size: 14px;">
                        <td colspan="2" style="text-align: right; font-size: 14px;  color: #000000"">Discount</td>
                        <td style="text-align: right; color: #000000">'.$countryInfo["currency"].$orderInfo["discount"].'</td>
                    </tr>';
                $message .= '<tr style="padding-top: 10px; margin-bottom: 0px; font-size: 14px;">
                        <td colspan="2" style="text-align: right; font-size: 14px; font-weight: bold; color: #000000;">Grand Total</td>
                        <td style="text-align: right; font-weight: bold; color: #000000;">'.$countryInfo["currency"].$orderInfo["total"].'</td>
                    </tr>
                </table>
                <p style="text-align: justify; color: #000000; padding-top: 25px; padding-bottom: 10px;">We will process your order as quickly as possible and will notify you via email once your order has been shipped.</p>
                <p style="text-align: justify; color: #000000; padding-bottom: 10px;">If you have any questions or concerns about your order, please feel free to contact our customer support team on <a href="mailto:info@fsexclusive.com">info@fsexclusive.com</a>. We are always available to help you with any queries you may have.</p>
                <p style="text-align: justify; color: #000000;">Thank you for choosing FS Exclusive. We appreciate your business and look forward to serving you in the future.</p>
                <p style="color: #000000; margin-top: 25px;">Best regards,</p>
                <p style="color: #000000;">FS Exclusive Team</p>
            </div>
            <div style="width: 350px; margin: 0px auto; background: #d2b482; padding: 25px; text-align: center;">
                <table width="100%">
                    <tr>
                        <td style="width: 53%">
                            <ul style="padding-left: 0px; margin-bottom: 0px;">
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; padding-left: 0px; margin-left: 0px;"><a href="' . site_url("about") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">About</a></li>
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; margin-left: 0px;"><a href="' . site_url("products") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">Shop</a></li>
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; margin-left: 0px;"><a href="' . site_url("contact") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">Contact</a></li>
                            </ul>
                        </td>
                        <td style="border-left: 1px solid #000000;">
                            <ul style="padding-left: 0px; margin-bottom: 0px; text-align: center">';
                                if (getSettings("facebookLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-left: 7px; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("facebookLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/facebook_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("twitterLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("twitterLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/twitter_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("instagramLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("instagramLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/instagram_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("linkedinLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("linkedinLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/linkedin_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("youtubeLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("youtubeLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/youtube_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("tiktokLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("tiktokLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/tiktok_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                            '</ul>
                        </td>
                    </tr>
                </table>
            </div>
        </body>
        </html>';

        // $message = '<!DOCTYPE html>
        // <html>
        // <head>
        //     <meta charset="utf-8">
        //     <meta name="viewport" content="width=device-width, initial-scale=1">
        //     <title>Email Template</title>
        
        //     <link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">
        // </head>
        // <body>
        //     <div style="width: 300px; margin: 0px auto; background-color: #d2b482; padding: 25px;">
        //         <div style="text-align: center;"><img src="'.site_url().'uploads/logo.png" width="120px"></div>
        //         <h2 style="padding-top: 25px; font-family: \'Secular One\', sans-serif; color: #000000;"><strong>Hello, '.$addressInfo["name"].'..!</strong></h2>
        //         <h3 style="font-family: \'Secular One\', sans-serif; color: #000000;"><strong>Thank you for your order!</strong></h3>
        //         <p style="font-family: \'Secular One\', sans-serif; color: #000000;">Now you can sit and relax. We\'re working on getting your order to you ASAP!</p>
        //         <div style="padding-bottom: 15px;"><a href="'.site_url().'orders" target="_blank" style="text-decoration: none; font-family: \'Secular One\', sans-serif; cursor: pointer; text-align: center; padding: 0.375rem 0.75rem; font-size: 1rem; color: #ffffff; background-color: #000000; border-color: #000000;">Track Your Order</a></div>
        //     </div>
        //     <div style="width: 300px; margin: 0px auto; padding: 25px;">
        //         <h3 style="padding-bottom: 10px; font-family: \'Secular One\', sans-serif; border-bottom: 2px solid #cecece;">Order Summary</h3>
        //         <p style="font-size: 14px; font-family: \'Secular One\', sans-serif; color: #000000;">Order ID: '.$orderInfo["paymentOrderId"].'</p>
        //         <p style="font-size: 14px; font-family: \'Secular One\', sans-serif; color: #000000;">Date: '.date("M d, Y h:i A", $orderInfo["createdAt"]).'</p>
        //         <p style="font-size: 14px; font-family: \'Secular One\', sans-serif; color: #000000;">To: '.$addressInfo["address"].',<br>'.$addressInfo["address2"].',<br>'.$addressInfo["city"].','.$addressInfo["state"].',<br>'.$addressInfo["country"].' - '.$addressInfo["zipcode"].'</p>';
        //         foreach(json_decode($orderInfo["products"]) as $product) {
        //             $productInfo = $this->db->table("products")->where("id", $product->productId)->get()->getRowArray();
        //             $productImage = $this->db->table("productimages")->orderBy("featured DESC")->limit(1)->where("productId", $product->productId)->get()->getRowArray();
        //             if ($productInfo["isDiscount"] == 1) {
        //                 $price = $productInfo["discountedPrice"] * $product->productQty;
        //             } else {
        //                 $price = $productInfo["price"] * $product->productQty;
        //             }
        //             $message .= '<table>
        //                 <tr>
        //                     <td><img src="'.site_url().'uploads/products/'.$productImage["name"].'" width="50px"></td>
        //                     <td style="padding-left: 10px; font-size: 14px; font-family: \'Secular One\', sans-serif; color: #000000;">'.$productInfo["name"].'<br><br>'.$countryInfo["currency"].$price.'</td>
        //                 </tr>
        //             </table>';
        //         }
        //         $message .= '<p style="padding-top: 10px; margin-bottom: 0px; font-size: 14px; font-family: \'Secular One\', sans-serif; border-top: 2px solid #cecece;">Grand Total</p>
        //             <h2 style="margin-top: 5px; font-family: \'Secular One\', sans-serif; color: #d2b482;">'.$countryInfo["currency"].$orderInfo["total"].'</h2>
        //     </div>
        // </body>
        // </html>';

        $email->setTo($addressInfo["email"]);
        $email->setFrom($from, "FS Exclusive");
        $email->setSubject("FS Exclusive Order Confirmation");

        $email->setMessage($message);
        
        // Send email
        $resp = $email->send();
        return $resp;
    }

    public function sendOrderConfirmationAdminMail($orderID, $from=NULL) {
        $orderInfo = $this->db->table("orders")->where("id", $orderID)->get()->getRowArray();
        $addressInfo = $this->db->table("address")->where("id", $orderInfo["addressId"])->get()->getRowArray();
        $countryInfo = $this->db->table("country")->where("id", $orderInfo["country"])->get()->getRowArray();
        $shippingCountry = $this->db->table("shippingcountry")->where("id", $addressInfo["country"])->get()->getRowArray();
        
        // Load email library
        $email = \Config\Services::email();

        if ($from == NULL)
            $from = "noreply@fsexclusive.com";

        // Mail configuration
        $config = array(
            // "protocol" => "sendmail",
            // "mailPath" => "/usr/sbin/sendmail",
            "protocol" => "smtp",
            "SMTPHost" => "smtp.dreamhost.com",
            "SMTPUser" => "noreply@fsexclusive.com",
            "SMTPPass" => "L6h9bTq8",
            "SMTPPort" => 587,
            "mailType" => "html",
            "charset"  => "utf-8",
            "wordWrap" => true,
        );

        $email->initialize($config);

        $message = '<div style="width: 350px; margin: 0px auto; background: #d2b482; padding: 25px;">
                <div style="text-align: center;"><img src="'.site_url().'uploads/logo.png" width="120px"></div>
            </div>
            <div style="width: 350px; margin: 0px auto; padding: 25px; background-color: #fff2ef;">
                <p style="font-size: 24px; border-bottom: 2px solid #cecece; color: #000000;">Order Summary</h3>
                <p style="font-size: 14px; color: #000000; padding-top: 10px;">Order ID: '.$orderInfo["paymentOrderId"].'</p>
                <p style="font-size: 14px; color: #000000;">Date: '.date("M d, Y h:i A", $orderInfo["createdAt"]).'</p>
                <p style="font-size: 14px; color: #000000; padding-bottom: 15px;">To: '.$addressInfo["name"].',<br>'.$addressInfo["address"].',<br>'.$addressInfo["address2"].',<br>'.$addressInfo["city"].','.$addressInfo["state"].',<br>'.$shippingCountry["country"].' - '.$addressInfo["zipcode"].'</p>
                <p style="font-size: 14px; color: #000000; padding-bottom: 15px;">Email: '.$addressInfo["email"].'<br>Phone: '.$addressInfo["contact"].'</p>
                <table style="width: 100%;">';
                foreach(json_decode($orderInfo["products"]) as $product) {
                    $productInfo = $this->db->table("products")->where("id", $product->productId)->get()->getRowArray();
                    $productImage = $this->db->table("productimages")->orderBy("featured DESC")->limit(1)->where("productId", $product->productId)->get()->getRowArray();
                    $variants = "";
                    
                    if ($productInfo["isDiscount"] == 1) {
                        $price = $productInfo["discountedPrice"] * $product->productQty;
                    } else {
                        $price = $productInfo["price"] * $product->productQty;
                    }

                    if ($product->productType == 2) {
                        $size = $this->db->table("productattributesvariants")->where("id", $product->productSize)->get()->getRow()->name;
                        $color = $this->db->table("productattributesvariants")->where("id", $product->productColor)->get()->getRow()->name;
                        $variants = "<small><em>Size: " . $size . " Color: " . $color . "</em></small>";
                    }
                    $message .= '<tr>
                            <td style="width: 50px;">
                                <img src="'.site_url().'uploads/products/'.$productImage["name"].'" width="50px" height="50px">
                            </td>
                            <td style="padding-left: 10px; font-size: 14px; color: #000000;">
                                ' . $productInfo["name"] .'
                                <br>
                                ' . $variants . '
                            </td>
                            <td style="padding-left: 10px; font-size: 14px; color: #000000; text-align: right;">
                                ' . $countryInfo["currency"] . $price . '
                            </td>
                        </tr>';
                }
                $message .= '<tr style="padding-top: 10px; margin-bottom: 0px; font-size: 14px; border-top: 2px solid #cecece;">
                        <td colspan="2" style="text-align: right; font-size: 14px; color: #000000;">Subtotal</td>
                        <td style="text-align: right; color: #000000">'.$countryInfo["currency"].$orderInfo["subtotal"].'</td>
                    </tr>';
                $message .= '<tr style="padding-top: 10px; margin-bottom: 0px; font-size: 14px;">
                        <td colspan="2" style="text-align: right; font-size: 14px; color: #000000;">Shipping</td>
                        <td style="text-align: right; color: #000000">'.$countryInfo["currency"].$orderInfo["shipping"].'</td>
                    </tr>';
                $message .= '<tr style="padding-top: 10px; margin-bottom: 0px; font-size: 14px;">
                        <td colspan="2" style="text-align: right; font-size: 14px; color: #000000;">Discount</td>
                        <td style="text-align: right; color: #000000">'.$countryInfo["currency"].$orderInfo["discount"].'</td>
                    </tr>';
                $message .= '<tr style="padding-top: 10px; margin-bottom: 0px; font-size: 14px;">
                        <td colspan="2" style="text-align: right; font-size: 14px; font-weight: bold; color: #000000;">Grand Total</td>
                        <td style="text-align: right; font-weight: bold; color: #000000;">'.$countryInfo["currency"].$orderInfo["total"].'</td>
                    </tr>
                </table>
            </div>
            <div style="width: 350px; margin: 0px auto; background: #d2b482; padding: 25px; text-align: center;">
                <table width="100%">
                    <tr>
                        <td style="width: 53%">
                            <ul style="padding-left: 0px; margin-bottom: 0px;">
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; padding-left: 0px; margin-left: 0px;"><a href="' . site_url("about") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">About</a></li>
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; margin-left: 0px;"><a href="' . site_url("products") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">Shop</a></li>
                                <li style="list-style-type: none; display: inline-block; padding: 0px 4px; margin-left: 0px;"><a href="' . site_url("contact") . '" target="_blank" style="color: #000000; text-decoration: none; font-family: \'Open Sans\', sans-serif; font-weight: 500;">Contact</a></li>
                            </ul>
                        </td>
                        <td style="border-left: 1px solid #000000;">
                            <ul style="padding-left: 0px; margin-bottom: 0px; text-align: center">';
                                if (getSettings("facebookLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-left: 7px; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("facebookLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/facebook_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("twitterLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("twitterLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/twitter_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("instagramLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("instagramLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/instagram_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("linkedinLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("linkedinLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/linkedin_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("youtubeLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("youtubeLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/youtube_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                                if (getSettings("tiktokLink") != "") {
                                    $message .= '<li style="list-style-type: none; display: inline-block; padding-right: 7px; margin-left: 0px;"><a href="' . getSettings("tiktokLink") . '" target="_blank" style="color: #000000; text-decoration: none;"><img src="' . site_url("assets/img/tiktok_email.png") . '" width="15px" /></a></li>';
                                    
                                }
                            '</ul>
                        </td>
                    </tr>
                </table>
            </div>
        </body>
        </html>';

        $email->setTo("admin@fsexclusive.com");
        $email->setFrom($from, "FS Exclusive");
        $email->setSubject("Order Confirmation");

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

        if ($from == NULL)
            $from = "noreply@fsexclusive.com";

        // Mail configuration
        $config = array(
            // "protocol" => "sendmail",
            // "mailPath" => "/usr/sbin/sendmail",
            "protocol" => "smtp",
            "SMTPHost" => "smtp.dreamhost.com",
            "SMTPUser" => "noreply@fsexclusive.com",
            "SMTPPass" => "L6h9bTq8",
            "SMTPPort" => 587,
            "mailType" => "html",
            "charset"  => "utf-8",
            "wordWrap" => true,
        );

        $email->initialize($config);

        $htmlContent = $msg;

        $email->setTo($to);
        $email->setFrom($from, "FS Exclusive");
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
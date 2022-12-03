<?php

namespace App\Controllers;

use Codeigniter\Controller;
use App\Models\UserModel;
use App\Models\EmailModel;

class Login extends BaseController
{
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->EmailModel = new EmailModel();
    }

    public function index()
    {
        $data['email'] = $this->request->getPost("email");
        $data['password'] = sha1($this->request->getPost("password"));

        $user = $this->UserModel->where($data)->first();

        if ($user == NULL) {
            echo false;
        } else {
            $this->session->set("logged_in", true);
            $this->session->set("userId", $user["id"]);
            $this->session->set("userName", $user["name"]);
            $this->session->set("userEmail", $user["email"]);
            $this->session->set("userImage", $user["image"]);
            $this->session->set("userRole", $user["role"]);
            echo true;
        }
        
    }

    public function register()
    {
        $data['name'] = $this->request->getPost("name");
        $data['email'] = $this->request->getPost("email");
        $data['contact'] = "";
        $data['password'] = sha1($this->request->getPost("password"));
        $data['role'] = 3;
        $data['status'] = 0;
        $data['verificationCode'] = substr(md5(time()), 0, 15);
        $data['createdAt'] = strtotime(date('d-M-Y H:i:s'));

        $checkEmail = $this->UserModel->where('email', $data['email'])->first();

        if ($checkEmail == NULL) {
            $register = $this->UserModel->insert($data);
            if ($register) {
                $sendRegisterMail = $this->EmailModel->sendRegisterMail($data['name'], $data['email']);
                $user = $this->UserModel->where('email', $data['email'])->first();
                $this->session->set("logged_in", true);
                $this->session->set("userId", $user["id"]);
                $this->session->set("userName", $user["name"]);
                $this->session->set("userEmail", $user["email"]);
                $this->session->set("userRole", $user["role"]);
                echo true;
            } else {
                echo "Wrong";
            }
        } else {
            echo "Exists";
        }

    }

    public function forgot()
    {
        $email = $this->request->getPost("email");
        $user = $this->UserModel->where("email", $email)->get()->getResultArray();

        if (count($user) > 0) {
            $verificationCode = substr(md5(time()), 0, 15);
            $updateCode = $this->db->table("users")->where("id", $user[0]["id"])->update(array("verificationCode" => $verificationCode));
            if ($updateCode) {
                $sendRegisterMail = $this->EmailModel->sendForgotMail($user[0]["name"], $email, $verificationCode);
                if ($sendRegisterMail) {
                    echo true;
                } else {
                    echo "Something went wrong. Please try again";
                }
            }
        } else {
            echo "Email doesn't exists";
        }
    }
    
    public function reset()
    {
        $email = $_GET["email"];
        $code = $_GET["code"];
        
        $check = $this->UserModel->where(array("email" => $email, "verificationCode" => $code))->get()->getResultArray();
        
        if (count($check) > 0) {
            $this->session->set("resetUserID", $check[0]["id"]);
            $view = "users";
            $page_data['page_name'] = "reset";
            
            return view($view . "/index", $page_data);
        } else {
            return redirect()->to(site_url());
        }
    }

    public function change()
    {
        $id = $this->session->get("resetUserID");
        $password = sha1($this->request->getPost("password"));

        $update = $this->db->table("users")->where("id", $id)->update(array("password" => $password));
        unset($_SESSION["resetUserID"]);
        echo $update;
    }

    public function google()
    {
        require_once dirname(dirname(__dir__)).'/vendor/autoload.php';

        //Make object of Google API Client for call Google API
        $googleClient = new Google_Client();

        //Set the OAuth 2.0 Client ID
        $googleClient->setClientId("561934716888-tm501ggj1m5alcf5o25nbmnb7qo1s1it.apps.googleusercontent.com");

        //Set the OAuth 2.0 Client Secret key
        $googleClient->setClientSecret("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");

        //Set the OAuth 2.0 Redirect URI
        $googleClient->setRedirectUri(site_url("login/google"));

        $googleClient->addScope('email');
        $googleClient->addScope('profile');
        $googleClient->addScope('openid');
        
        //This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
        if(isset($_GET["code"]))
        {
            unset($_SESSION['access_token']);
            $token = $googleClient->fetchAccessTokenWithAuthCode($_GET["code"]);

            //It will Attempt to exchange a code for an valid authentication token.

            //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
            if(!isset($token['error']))
            {   
                //Set the access token used for requests
                $googleClient->setAccessToken($token['access_token']);

                //Store "access_token" value in $_SESSION variable for future use.
                $_SESSION['access_token'] = $token['access_token'];

                //Create Object of Google Service OAuth 2 class
                $google_service = new Google_Service_Oauth2($googleClient);

                //Get user profile data from google
                $google_data = $google_service->userinfo->get();

                // $user_id = $this->user_model->register_google_user($google_data['email'], $google_data['given_name'] . ' ' . $google_data['family_name']);
                $_SESSION['email'] = $google_data['email'];
                $_SESSION['name'] = $google_data['given_name'] . ' ' . $google_data['family_name'];
                $_SESSION['user_image'] = $google_data['picture'];
                $_SESSION['user_id'] = $user_id;
                // $_SESSION['logged_in'] = true;
                // $_SESSION['role_id'] = 3;
                // $_SESSION['student_login'] = '1';

                // Login Points
                // $points = $this->login_points($user_id);
                // if ($points > 0) {
                //     $this->session->set_flashdata('flash_message', get_phrase('you_have_earned_5_points'));
                // }

                return redirect()->to(site_url());
            }
        }
    }

    public function logout()
    {
        // $this->session->destroy();
        unset($_SESSION["logged_in"]);
        unset($_SESSION["userId"]);
        unset($_SESSION["userName"]);
        unset($_SESSION["userEmail"]);
        unset($_SESSION["userRole"]);
        unset($_SESSION["userImage"]);
        unset($_SESSION["productId"]);
        return redirect()->to(site_url());
    }

}

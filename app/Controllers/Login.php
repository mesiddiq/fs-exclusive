<?php

namespace App\Controllers;

use Codeigniter\Controller;
use App\Models\UserModel;
use App\Models\EmailModel;
use App\Models\CartModel;

class Login extends BaseController
{
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->EmailModel = new EmailModel();
        $this->CartModel = new CartModel();
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
            
            $sessCartItems = $this->session->get("cartItems");
            
            if ($sessCartItems != NULL) {
                foreach ($sessCartItems as $key => $value) {
                    $this->db->table("cart")->where("tempId", $value["tempId"])->update(array("userId" => $this->session->get("userId")));
                    // $this->CartModel->insert(array(
                    //     "userId" => $this->session->get("userId"),
                    //     "productId" => $value["productId"],
                    //     "productType" => $value["productType"],
                    //     "productSize" => $value["productSize"],
                    //     "productColor" => $value["productColor"],
                    //     "productQty" => $value["productQty"],
                    //     "productPrice" => $value["productPrice"],
                    //     "country" => $value["country"],
                    //     "createdAt" => $value["createdAt"],
                    // ));
                }
            }
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

                $sessCartItems = $this->session->get("cartItems");
            
                if ($sessCartItems != NULL) {
                    foreach ($sessCartItems as $key => $value) {
                        // $this->CartModel->insert(array(
                        //     "userId" => $this->session->get("userId"),
                        //     "productId" => $value["productId"],
                        //     "productQty" => $value["productQty"],
                        //     "productPrice" => $value["productPrice"],
                        //     "country" => $value["country"],
                        //     "createdAt" => $value["createdAt"],
                        // ));
                        $this->db->table("cart")->where("tempId", $value["tempId"])->update(array("userId" => $this->session->get("userId")));
                    }
                }
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
        require_once APPPATH.'/vendor/autoload.php';

        // Make object of Google API Client for call Google API
        $googleClient = new \Google_Client();

        // Set the OAuth 2.0 Client ID
        $googleClient->setClientId("561934716888-tm501ggj1m5alcf5o25nbmnb7qo1s1it.apps.googleusercontent.com");

        // Set the OAuth 2.0 Client Secret key
        $googleClient->setClientSecret("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");

        // Set the OAuth 2.0 Redirect URI
        $googleClient->setRedirectUri(site_url("login/google"));

        $googleClient->addScope('email');
        $googleClient->addScope('profile');
        $googleClient->addScope('openid');
        
        // This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
        if(isset($_GET["code"]))
        {
            unset($_SESSION['access_token']);
            $token = $googleClient->fetchAccessTokenWithAuthCode($_GET["code"]);

            // It will Attempt to exchange a code for an valid authentication token.

            // This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
            if(!isset($token['error']))
            {   
                // Set the access token used for requests
                $googleClient->setAccessToken($token['access_token']);

                // Store "access_token" value in $_SESSION variable for future use.
                $_SESSION['access_token'] = $token['access_token'];

                // Create Object of Google Service OAuth 2 class
                $googleService = new \Google_Service_Oauth2($googleClient);

                // Get user profile data from google
                $googleData = $googleService->userinfo->get();
                
                $checkEmail = $this->UserModel->where('email', $googleData['email'])->first();

                if ($checkEmail == NULL) {
                    $data['name'] = ucfirst($googleData['given_name']) . ' ' . ucfirst($googleData['family_name']);
                    $data['email'] = $googleData['email'];
                    $data['contact'] = "";
                    $data['password'] = "";
                    $data['role'] = 3;
                    $data['status'] = 1;
                    $data['verificationCode'] = "";
                    $data['createdAt'] = strtotime(date('d-M-Y H:i:s'));
                    
                    $register = $this->UserModel->insert($data);
                    $sendRegisterMail = $this->EmailModel->sendRegisterMail($data['name'], $data['email']);
                    
                    $user = $this->UserModel->where('email', $data['email'])->first();
                    
                    $this->session->set("logged_in", true);
                    $this->session->set("userId", $user["id"]);
                    $this->session->set("userName", $user["name"]);
                    $this->session->set("userEmail", $user["email"]);
                    $this->session->set("userImage", $googleData["picture"]);
                    $this->session->set("userRole", $user["role"]);
                } else {
                    $this->session->set("logged_in", true);
                    $this->session->set("userId", $checkEmail["id"]);
                    $this->session->set("userName", $checkEmail["name"]);
                    $this->session->set("userEmail", $checkEmail["email"]);
                    $this->session->set("userImage", $googleData["picture"]);
                    $this->session->set("userRole", $checkEmail["role"]);
                }

                $sessCartItems = $this->session->get("cartItems");
            
                if ($sessCartItems != NULL) {
                    foreach ($sessCartItems as $key => $value) {
                        $this->CartModel->insert(array(
                            "userId" => $this->session->get("userId"),
                            "productId" => $value["productId"],
                            "productQty" => $value["productQty"],
                            "productPrice" => $value["productPrice"],
                            "country" => $value["country"],
                            "createdAt" => $value["createdAt"],
                        ));
                    }
                }

                return redirect()->to(site_url());
            }
        }
    }

    public function facebook()
    {
        require_once APPPATH."/vendor/autoload.php";

        $facebook = new \Facebook\Facebook([
          "app_id"      => "2956734491288416",
          "app_secret"     => "c1116599cd7ea1551cd9ea9d2e641940",
          "default_graph_version"  => "v2.10"
        ]);

        $facebookOutput = "";

        $facebookHelper = $facebook->getRedirectLoginHelper();

        if (isset($_GET["code"])) {

            if (isset($_SESSION["access_token"])) {
                $accessToken = $_SESSION["access_token"];
            } else {
                $accessToken = $facebookHelper->getAccessToken();
                $_SESSION["access_token"] = $accessToken;
                $facebook->setDefaultAccessToken($_SESSION["access_token"]);
            }

            $graphResponse = $facebook->get("/me?fields=name,email", $accessToken);
            $facebookData = $graphResponse->getGraphUser();

            $checkEmail = $this->UserModel->where("email", $facebookData["email"])->first();

            if ($checkEmail == NULL) {
                $data["name"] = ucfirst($facebookData["name"]);
                $data["email"] = $facebookData["email"];
                $data["contact"] = "";
                $data["password"] = "";
                $data["role"] = 3;
                $data["status"] = 1;
                $data["verificationCode"] = "";
                $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));
                
                $register = $this->UserModel->insert($data);
                $sendRegisterMail = $this->EmailModel->sendRegisterMail($data["name"], $data["email"]);
                
                $user = $this->UserModel->where("email", $data["email"])->first();
                
                $this->session->set("logged_in", true);
                $this->session->set("userId", $user["id"]);
                $this->session->set("userName", $user["name"]);
                $this->session->set("userEmail", $user["email"]);
                $this->session->set("userImage", "http://graph.facebook.com/".$facebookData["id"]."/picture");
                $this->session->set("userRole", $user["role"]);
            } else {
                $this->session->set("logged_in", true);
                $this->session->set("userId", $checkEmail["id"]);
                $this->session->set("userName", $checkEmail["name"]);
                $this->session->set("userEmail", $checkEmail["email"]);
                $this->session->set("userImage", "http://graph.facebook.com/".$facebookData["id"]."/picture");
                $this->session->set("userRole", $checkEmail["role"]);
            }

            $sessCartItems = $this->session->get("cartItems");
        
            if ($sessCartItems != NULL) {
                foreach ($sessCartItems as $key => $value) {
                    $this->CartModel->insert(array(
                        "userId" => $this->session->get("userId"),
                        "productId" => $value["productId"],
                        "productQty" => $value["productQty"],
                        "productPrice" => $value["productPrice"],
                        "country" => $value["country"],
                        "createdAt" => $value["createdAt"],
                    ));
                }
            }

            return redirect()->to(site_url());
         
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
        if (isset($_SESSION["access_token"])) {
            unset($_SESSION["access_token"]);
        }
        if (isset($_SESSION["FBRLH_state"])) {
            unset($_SESSION["FBRLH_state"]);
        }
        return redirect()->to(site_url());
    }

}

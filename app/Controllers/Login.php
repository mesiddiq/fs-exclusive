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

    public function logout()
    {
        $this->session->destroy();
        unset($_SESSION["logged_in"]);
        unset($_SESSION["userId"]);
        unset($_SESSION["userName"]);
        unset($_SESSION["userEmail"]);
        unset($_SESSION["userRole"]);
        return redirect()->to(site_url());
    }

}

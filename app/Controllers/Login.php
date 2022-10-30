<?php

namespace App\Controllers;

use Codeigniter\Controller;
use App\Models\UserModel;

class Login extends BaseController
{

    public function index()
    {
        $UserModel = new UserModel();
        $agent = $this->request->getUserAgent();

        $data['email'] = $this->request->getPost("email");
        $data['password'] = sha1($this->request->getPost("password"));

        $user = $UserModel->where($data)->first();

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
        $UserModel = new UserModel();

        $data['name'] = $this->request->getPost("name");
        $data['email'] = $this->request->getPost("email");
        $data['contact'] = "";
        $data['password'] = sha1($this->request->getPost("password"));
        $data['role'] = 1;
        $data['createdAt'] = strtotime(date('d-M-Y H:i:s'));

        $checkEmail = $UserModel->where('email', $data['email'])->first();

        if ($checkEmail == NULL) {
            $register = $UserModel->insert($data);

            if ($register) {
                $user = $UserModel->where('email', $data['email'])->first();
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

    public function logout()
    {
        $this->session->destroy();
        unset($_SESSION["logged_in"]);
        unset($_SESSION["userId"]);
        unset($_SESSION["userName"]);
        unset($_SESSION["userEmail"]);
        unset($_SESSION["userRole"]);
        return redirect()->to('/');
    }

}

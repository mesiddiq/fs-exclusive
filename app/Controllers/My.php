<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ProductImageModel;

class My extends BaseController
{

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->CategoryModel = new CategoryModel();
        $this->ProductModel = new ProductModel();
        $this->ProductImageModel = new ProductImageModel();
    }

    public function index()
    {
        if ($this->session->get("country") == NULL) {
            return redirect()->to(site_url());
        } else if ($this->session->get("country") == 1) {
            return redirect()->to(site_url("uk"));
        }

        $view = "users";
        $page_data['page_name'] = "home";

        return view($view . "/index", $page_data);
    }

    public function country()
    {
        if ($this->session->get("country") == NULL) {
            return redirect()->to(site_url());
        } else if ($this->session->get("country") == 1) {
            return redirect()->to(site_url("uk"));
        }

        $country = (int) $this->request->getPost("country");
        $this->session->set("country", $country);
        echo $this->session->get("country");
    }

    public function shop()
    {
        if ($this->session->get("country") == NULL) {
            return redirect()->to(site_url());
        } else if ($this->session->get("country") == 1) {
            return redirect()->to(site_url("uk"));
        }

        $view = "users";
        $page_data['page_name'] = "shop";
        
        return view($view . "/index", $page_data);
    }

    public function category($param1='', $param2='')
    {
        if ($this->session->get("country") == NULL) {
            return redirect()->to(site_url());
        } else if ($this->session->get("country") == 1) {
            return redirect()->to(site_url("uk"));
        }

        $view = "users";
        $page_data['page_name'] = "products";
        $page_data['products'] = $this->ProductModel->where(array("category" => $param2, "country" => $this->session->get("country")))->get()->getResultArray();
        
        return view($view . "/index", $page_data);
    }

    public function product($param1='', $param2='')
    {
        if ($this->session->get("country") == NULL) {
            return redirect()->to(site_url());
        } else if ($this->session->get("country") == 1) {
            return redirect()->to(site_url("uk"));
        }

        $view = "users";
        $page_data['page_name'] = "product";
        $page_data['product'] = $this->ProductModel->where(array("slug" => $param1, "id" => $param2, "country" => $this->session->get("country")))->get()->getRowArray();
        
        return view($view . "/index", $page_data);
    }

    public function cart()
    {
        if ($this->session->get("country") == NULL) {
            return redirect()->to(site_url());
        } else if ($this->session->get("country") == 1) {
            return redirect()->to(site_url("uk"));
        }

        $view = "users";
        $page_data['page_name'] = "cart";
        
        return view($view . "/index", $page_data);
    }

    public function checkout()
    {
        if ($this->session->get("country") == NULL) {
            return redirect()->to(site_url());
        } else if ($this->session->get("country") == 1) {
            return redirect()->to(site_url("uk"));
        }

        $view = "users";
        $page_data['page_name'] = "checkout";
        
        return view($view . "/index", $page_data);
    }

    public function contact()
    {
        if ($this->session->get("country") == NULL) {
            return redirect()->to(site_url());
        } else if ($this->session->get("country") == 1) {
            return redirect()->to(site_url("uk"));
        }

        $view = "users";
        $page_data['page_name'] = "contact";
        
        return view($view . "/index", $page_data);
    }
}

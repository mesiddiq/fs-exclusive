<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ProductImageModel;

class Home extends BaseController
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
        $view = "users";
        $page_data['page_name'] = "home";

        return view($view . "/index", $page_data);
    }

    public function shop()
    {
        $view = "users";
        $page_data['page_name'] = "shop";
        
        return view($view . "/index", $page_data);
    }

    public function category($param1='', $param2='')
    {
        $view = "users";
        $page_data['page_name'] = "products";
        $page_data['products'] = $this->ProductModel->where(array("category" => $param2))->get()->getResultArray();
        
        return view($view . "/index", $page_data);
    }

    public function product($param1='', $param2='')
    {
        $view = "users";
        $page_data['page_name'] = "product";
        $page_data['product'] = $this->ProductModel->where(array("slug" => $param1, "id" => $param2))->get()->getRowArray();
        
        return view($view . "/index", $page_data);
    }

    public function cart()
    {
        $view = "users";
        $page_data['page_name'] = "cart";
        
        return view($view . "/index", $page_data);
    }

    public function checkout()
    {
        $view = "users";
        $page_data['page_name'] = "checkout";
        
        return view($view . "/index", $page_data);
    }

    public function contact()
    {
        $view = "users";
        $page_data['page_name'] = "contact";
        
        return view($view . "/index", $page_data);
    }
}

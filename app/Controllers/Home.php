<?php

namespace App\Controllers;

class Home extends BaseController
{
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

    public function detail()
    {
        $view = "users";
        $page_data['page_name'] = "detail";
        
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

<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $page_data['page_name'] = "home";

        return view("index", $page_data);
    }

    public function shop()
    {
        $page_data['page_name'] = "shop";
        
        return view("index", $page_data);
    }

    public function detail()
    {
        $page_data['page_name'] = "detail";
        
        return view("index", $page_data);
    }

    public function cart()
    {
        $page_data['page_name'] = "cart";
        
        return view("index", $page_data);
    }

    public function checkout()
    {
        $page_data['page_name'] = "checkout";
        
        return view("index", $page_data);
    }

    public function contact()
    {
        $page_data['page_name'] = "contact";
        
        return view("index", $page_data);
    }
}

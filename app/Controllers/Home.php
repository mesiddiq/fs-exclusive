<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $page_data['page_name'] = "home";
        
        return view("index", $page_data);
    }
}

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

    public function search()
    {
        if ($this->session->get("country") == NULL) {
            return redirect()->to(site_url());
        } else if ($this->session->get("country") == 2) {
            return redirect()->to(site_url("my"));
        }

        $view = "users";
        $page_data['page_name'] = "shop";
        $page_data['products'] = $this->ProductModel->like("name", $_GET["keyword"])->get()->getResultArray();
        $page_data['categories'] = $this->CategoryModel->where("country", $this->session->get("country"))->get()->getResultArray();
        
        return view($view . "/index", $page_data);
    }

    public function shop()
    {
        if ($this->session->get("country") == NULL) {
            return redirect()->to(site_url());
        } else if ($this->session->get("country") == 2) {
            return redirect()->to(site_url("my"));
        }

        $selectedCategoryID = "all";

        // Get the category ids
        if (isset($_GET['category']) && !empty($_GET['category'] && $_GET['category'] != "all")) {
            $selectedCategoryID = $this->CategoryModel->getCategoryIDs($_GET['category']);
            // $page_data['products'] = $this->ProductModel->where(array("country" => $this->session->get("country"), "category" => $selectedCategoryID[0]["id"]))->get()->getResultArray();
            $selectedCategoryProducts = array();
            foreach ($selectedCategoryID as $key => $selectedCategory) {
                $selectedCategoryProduct = $this->ProductModel->where(array("country" => $this->session->get("country"), "category" => $selectedCategory["id"]))->get()->getRowArray();
                array_push($selectedCategoryProducts, $selectedCategoryProduct);
            }
            $page_data['products'] = $selectedCategoryProducts;
        }

        if ($selectedCategoryID == "all") {
            $page_data['products'] = $this->ProductModel->where("country", $this->session->get("country"))->get()->getResultArray();
        }

        $view = "users";
        $page_data['page_name'] = "shop";
        $page_data['selected_category_id'] = $selectedCategoryID;
        $page_data['categories'] = $this->CategoryModel->where("country", $this->session->get("country"))->get()->getResultArray();
        
        return view($view . "/index", $page_data);
    }

    public function category($param1='', $param2='')
    {
        if ($this->session->get("country") == NULL) {
            return redirect()->to(site_url());
        } else if ($this->session->get("country") == 2) {
            return redirect()->to(site_url("my"));
        }

        $view = "users";
        $page_data['page_name'] = "products";
        $page_data['categoryID'] = $param2;
        $page_data['products'] = $this->ProductModel->where(array("category" => $param2, "country" => $this->session->get("country")))->get()->getResultArray();
        
        return view($view . "/index", $page_data);
    }

    public function product($param1='', $param2='')
    {
        if ($this->session->get("country") == NULL) {
            return redirect()->to(site_url());
        } else if ($this->session->get("country") == 2) {
            return redirect()->to(site_url("my"));
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
        } else if ($this->session->get("country") == 2) {
            return redirect()->to(site_url("my"));
        }

        $view = "users";
        $page_data['page_name'] = "cart";
        
        return view($view . "/index", $page_data);
    }

    public function checkout()
    {
        if ($this->session->get("country") == NULL) {
            return redirect()->to(site_url());
        } else if ($this->session->get("country") == 2) {
            return redirect()->to(site_url("my"));
        }

        $view = "users";
        $page_data['page_name'] = "checkout";
        
        return view($view . "/index", $page_data);
    }

    public function wishlist()
    {
        if ($this->session->get("country") == NULL) {
            return redirect()->to(site_url());
        } else if ($this->session->get("country") == 2) {
            return redirect()->to(site_url("my"));
        }

        $view = "users";
        $page_data['wishlists'] = $this->WishlistModel->where(array("userId" => $this->session->get("userId"), "country" => $this->session->get("country")))->get()->getResultArray();
        $page_data['page_name'] = "wishlist";
        
        return view($view . "/index", $page_data);
    }

    public function orders()
    {
        if ($this->session->get("country") == NULL) {
            return redirect()->to(site_url());
        } else if ($this->session->get("country") == 2) {
            return redirect()->to(site_url("my"));
        }

        $view = "users";
        $page_data['orders'] = $this->OrdersModel->where(array("userId" => $this->session->get("userId"), "country" => $this->session->get("country")))->get()->getResultArray();
        $page_data['page_name'] = "orders";
        
        return view($view . "/index", $page_data);
    }

    public function order($param1='')
    {
        if ($this->session->get("country") == NULL) {
            return redirect()->to(site_url());
        } else if ($this->session->get("country") == 2) {
            return redirect()->to(site_url("my"));
        }

        $view = "users";
        $page_data['order'] = $this->OrdersModel->where("id", $param1)->get()->getRowArray();
        $page_data['page_name'] = "order";
        
        return view($view . "/order", $page_data);
    }

    public function contact()
    {
        if ($this->session->get("country") == NULL) {
            return redirect()->to(site_url());
        } else if ($this->session->get("country") == 2) {
            return redirect()->to(site_url("my"));
        }

        $view = "users";
        $page_data['page_name'] = "contact";
        
        return view($view . "/index", $page_data);
    }
}

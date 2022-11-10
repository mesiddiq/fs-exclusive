<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ProductImageModel;
use App\Models\WishlistModel;
use App\Models\OrdersModel;
use App\Models\ReviewModel;

class My extends BaseController
{

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->CategoryModel = new CategoryModel();
        $this->ProductModel = new ProductModel();
        $this->ProductImageModel = new ProductImageModel();
        $this->WishlistModel = new WishlistModel();
        $this->OrdersModel = new OrdersModel();
        $this->ReviewModel = new ReviewModel();
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
        } else if ($this->session->get("country") == 1) {
            return redirect()->to(site_url("uk"));
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
        } else if ($this->session->get("country") == 1) {
            return redirect()->to(site_url("uk"));
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
        } else if ($this->session->get("country") == 1) {
            return redirect()->to(site_url("uk"));
        }

        $view = "users";
        $page_data['page_name'] = "products";
        $page_data['categoryID'] = $param2;
        $page_data['products'] = $this->ProductModel->where(array("category" => $param2, "country" => $this->session->get("country")))->get()->getResultArray();
        
        return view($view . "/index", $page_data);
    }

    public function product($param1='', $param2='')
    {
        $view = "users";
        $page_data["page_name"] = "product";
        $page_data["product"] = $this->ProductModel->where(array("slug" => $param1, "id" => $param2, "country" => $this->session->get("country")))->get()->getRowArray();
        $page_data["reviews"] = $this->ReviewModel->where(array("productId" => $param2, "status" => 1))->get()->getResultArray();
        $page_data["rating"] = $this->db->table("productreviews")->select("AVG(rating) rating")->where(array("productId" => $param2, "status" => 1))->get()->getResultArray();
        $page_data["isPurchased"] = $this->isPurchased($param2);
        $this->session->set("productId", $param2);
        
        return view($view . "/index", $page_data);
    }

    public function isPurchased($productID)
    {
        $userId = $this->session->get("userId");

        if ($userId != NULL) {
            $orders = $this->OrdersModel->where("userId", $userId)->get()->getResultArray();
            $ordersArr = array();
            $productsArr = array();
            $productsIdArr = array();
            
            foreach ($orders as $key => $order) {
                array_push($ordersArr, json_decode($order["products"]));
            }

            foreach ($ordersArr as $key => $orderArr) {
                foreach ($orderArr as $key => $value) {
                    array_push($productsIdArr, $value->productId);
                }
            }

            if (in_array($productID, $productsIdArr)) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }
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

    public function wishlist()
    {
        if ($this->session->get("country") == NULL) {
            return redirect()->to(site_url());
        } else if ($this->session->get("country") == 1) {
            return redirect()->to(site_url("uk"));
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
        } else if ($this->session->get("country") == 1) {
            return redirect()->to(site_url("uk"));
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
        } else if ($this->session->get("country") == 1) {
            return redirect()->to(site_url("uk"));
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
        } else if ($this->session->get("country") == 1) {
            return redirect()->to(site_url("uk"));
        }

        $view = "users";
        $page_data['page_name'] = "contact";
        
        return view($view . "/index", $page_data);
    }
}

<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ProductImageModel;
use App\Models\CartModel;
use App\Models\AddressModel;
use App\Models\OrdersModel;

class Home extends BaseController
{

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->CategoryModel = new CategoryModel();
        $this->ProductModel = new ProductModel();
        $this->ProductImageModel = new ProductImageModel();
        $this->CartModel = new CartModel();
        $this->AddressModel = new AddressModel();
        $this->OrdersModel = new OrdersModel();
    }

    public function index()
    {
        if ($this->session->get("country") == NULL) {
            $view = "users";

            return view($view . "/main");
        } else {
            $sessCountry = $this->db->table("country")->where("id", $this->session->get("country"))->get()->getRowArray();
            return redirect()->to(site_url(strtolower($sessCountry["code"])));
        }
    }

    public function country()
    {
        $country = (int) $this->request->getPost("country");
        $this->session->set("country", $country);
        echo $this->session->get("country");
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

    public function addToCart()
    {
        $product = $this->ProductModel->where("id", $this->request->getPost("productId"))->get()->getRowArray();

        if ($product["isDiscount"] == 1) {
            $price = $product["discountedPrice"];
        } else {
            $price = $product["price"];
        }

        $checkCart = $this->CartModel->orderBy("id DESC")->where(array("userId" => $this->session->get("userId"), "productId" => $this->request->getPost("productId")))->get()->getResultArray();

        if (count($checkCart) > 0) {
            $newQty = $checkCart[0]["productQty"] + $this->request->getPost("productQty");
            $newPrice = $checkCart[0]["productPrice"] + ($this->request->getPost("productQty") * $price);
            $this->db->table("cart")->where("id", $checkCart[0]["id"])->update(array("productQty" => $newQty, "productPrice" => $newPrice));
        } else {
            $data["userId"] = $this->session->get("userId");
            $data["productId"] = $this->request->getPost("productId");
            $data["productQty"] = $this->request->getPost("productQty");
            $data["productPrice"] = $this->request->getPost("productQty") * $price;
            $data["country"] = $this->session->get("country");
            $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));

            $this->CartModel->insert($data);
        }

        echo json_encode($checkCart);
    }

    public function cart()
    {
        $view = "users";
        $page_data["cart"] = $this->CartModel->orderBy("id DESC")->where(array("userId" => $_SESSION["userId"], "country" => $_SESSION["country"]))->get()->getResultArray();
        $page_data['page_name'] = "cart";
        
        return view($view . "/index", $page_data);
    }


    public function removeFromCart()
    {
        $id = $this->request->getPost("id");

        $this->CartModel->delete($id);
        echo true;
    }

    public function checkout()
    {
        $view = "users";
        $page_data["cart"] = $this->CartModel->orderBy("id DESC")->where(array("userId" => $_SESSION["userId"], "country" => $_SESSION["country"]))->get()->getResultArray();
        $page_data["addresses"] = $this->AddressModel->orderBy("id DESC")->where(array("userId" => $_SESSION["userId"], "country" => $_SESSION["country"]))->get()->getResultArray();
        $page_data['page_name'] = "checkout";
        
        return view($view . "/index", $page_data);
    }

    public function addAddress()
    {
        $data["userId"] = $this->session->get("userId");
        $data["name"] = $this->request->getPost("name");
        $data["email"] = $this->request->getPost("email");
        $data["contact"] = $this->request->getPost("contact");
        $data["address"] = $this->request->getPost("address");
        $data["address2"] = $this->request->getPost("address2");
        $data["country"] = $this->session->get("country");
        $data["city"] = $this->request->getPost("city");
        $data["state"] = $this->request->getPost("state");
        $data["zipcode"] = $this->request->getPost("zipcode");

        $this->AddressModel->insert($data);
        echo true;
    }

    public function placeOrder($value='')
    {
        $cart = $this->CartModel->orderBy("id DESC")->where(array("userId" => $_SESSION["userId"], "country" => $_SESSION["country"]))->get()->getResultArray();

        $data["userId"] = $this->session->get("userId");
        $data["addressId"] = $this->request->getPost("addressId");
        $data["products"] = json_encode($cart);
        $data["subtotal"] = $this->request->getPost("subtotal");
        $data["discount"] = $this->request->getPost("discount");
        $data["total"] = $this->request->getPost("total");
        $data["country"] = $this->session->get("country");
        $data["orderDate"] = strtotime(date("d-M-Y H:i:s"));
        $data["orderStatus"] = 1;
        $data["paymentMethod"] = $this->request->getPost("paymentMethod");
        $data["paymentStatus"] = 1;

        $this->OrdersModel->insert($data);
        echo true;
    }

    public function deleteUserCart()
    {
        $userCart = $this->CartModel->where("userId", $_SESSION["userId"])->get()->getResultArray();

        foreach ($userCart as $key => $userCart) {
            $this->CartModel->delete($userCart["id"]);
        }

        echo true;

    }

    public function contact()
    {
        $view = "users";
        $page_data['page_name'] = "contact";
        
        return view($view . "/index", $page_data);
    }
}

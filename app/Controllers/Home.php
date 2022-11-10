<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ProductImageModel;
use App\Models\CartModel;
use App\Models\WishlistModel;
use App\Models\AddressModel;
use App\Models\OrdersModel;
use App\Models\EmailModel;
use App\Models\CustomModel;
use App\Models\ReviewModel;

class Home extends BaseController
{

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->CategoryModel = new CategoryModel();
        $this->ProductModel = new ProductModel();
        $this->ProductImageModel = new ProductImageModel();
        $this->CartModel = new CartModel();
        $this->WishlistModel = new WishlistModel();
        $this->AddressModel = new AddressModel();
        $this->OrdersModel = new OrdersModel();
        $this->EmailModel = new EmailModel();
        $this->CustomModel = new CustomModel();
        $this->ReviewModel = new ReviewModel();
    }

    public function index()
    {
        if ($this->session->get("countryId") == NULL) {
            $view = "users";

            return view($view . "/main");
        } else {
            $sessCountry = $this->db->table("country")->where("id", $this->session->get("countryId"))->get()->getRowArray();
            $this->session->set("countryId", $sessCountry["id"]);
            $this->session->set("countryName", $sessCountry["name"]);
            $this->session->set("countryCode", $sessCountry["code"]);
            $this->session->set("countryCurrency", $sessCountry["currency"]);
            
            $view = "users";
            $page_data["page_name"] = "home";

            return view($view . "/index", $page_data);
        }
    }

    public function country()
    {
        $country = (int) $this->request->getPost("country");
        $sessCountry = $this->db->table("country")->where("id", $country)->get()->getRowArray();
        $this->session->set("countryId", $sessCountry["id"]);
        $this->session->set("countryName", $sessCountry["name"]);
        $this->session->set("countryCode", $sessCountry["code"]);
        $this->session->set("countryCurrency", $sessCountry["currency"]);
        echo true;
    }

    public function search()
    {
        if ($this->session->get("countryId") == NULL) {
            return redirect()->to(site_url());
        }

        $view = "users";
        $page_data["page_name"] = "search";
        $page_data["products"] = $this->ProductModel->like("name", $_GET["keyword"])->where("country", $this->session->get("countryId"))->get()->getResultArray();
        $page_data["categories"] = $this->CategoryModel->where("country", $this->session->get("countryId"))->get()->getResultArray();
        
        return view($view . "/index", $page_data);
    }

    public function shop()
    {
        if ($this->session->get("countryId") == NULL) {
            return redirect()->to(site_url());
        }

        $selectedCategoryID = "all";

        // Get the category ids
        if (isset($_GET["category"]) && !empty($_GET["category"] && $_GET["category"] != "all")) {
            $selectedCategoryID = $this->CategoryModel->getCategoryIDs($_GET["category"]);
            // $page_data["products"] = $this->ProductModel->where(array("country" => $this->session->get("country"), "category" => $selectedCategoryID[0]["id"]))->get()->getResultArray();
            $selectedCategoryProducts = array();
            foreach ($selectedCategoryID as $key => $selectedCategory) {
                $selectedCategoryProduct = $this->ProductModel->where(array("country" => $this->session->get("countryId"), "category" => $selectedCategory["id"]))->get()->getRowArray();
                array_push($selectedCategoryProducts, $selectedCategoryProduct);
            }
            $page_data["products"] = $selectedCategoryProducts;
        }

        if ($selectedCategoryID == "all") {
            $page_data["products"] = $this->ProductModel->where("country", $this->session->get("countryId"))->get()->getResultArray();
        }

        $view = "users";
        $page_data["page_name"] = "shop";
        $page_data["selected_category_id"] = $selectedCategoryID;
        $page_data["categories"] = $this->CategoryModel->where("country", $this->session->get("countryId"))->get()->getResultArray();
        
        return view($view . "/index", $page_data);
    }

    public function category($param1="", $param2="")
    {
        if ($this->session->get("countryId") == NULL) {
            return redirect()->to(site_url());
        }

        $view = "users";
        $page_data["page_name"] = "products";
        $page_data["categoryID"] = $param2;
        $page_data["products"] = $this->ProductModel->where(array("category" => $param2, "country" => $this->session->get("countryId")))->get()->getResultArray();
        
        return view($view . "/index", $page_data);
    }

    public function product($param1='', $param2='')
    {
        if ($this->session->get("countryId") == NULL) {
            return redirect()->to(site_url());
        }

        $view = "users";
        $page_data["page_name"] = "product";
        $page_data["product"] = $this->ProductModel->where(array("slug" => $param1, "id" => $param2, "country" => $this->session->get("countryId")))->get()->getRowArray();
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

    public function addToCart()
    {
        $product = $this->ProductModel->where("id", $this->request->getPost("productId"))->get()->getRowArray();

        if ($product["isDiscount"] == 1) {
            $price = $product["discountedPrice"];
        } else {
            $price = $product["price"];
        }

        if ($this->session->get("logged_in")) {
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
                $data["country"] = $this->session->get("countryId");
                $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));

                $this->CartModel->insert($data);
            }

            echo "cart";
        } else {
            if (!isset($_SESSION["cartItems"])) {
                $_SESSION["cartItems"] = array();
            }

            $sessCartItems = $this->session->get("cartItems");

            $data["productId"] = $this->request->getPost("productId");
            $data["productQty"] = $this->request->getPost("productQty");
            $data["productPrice"] = $this->request->getPost("productQty") * $price;
            $data["country"] = $this->session->get("countryId");
            $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));

            // if (count($_SESSION["cartItems"]) > 0) {
            //     foreach ($_SESSION["cartItems"] as $key => $sessCartItem) {
            //         if ($sessCartItem["productId"] == $this->request->getPost("productId")) {
            //             $_SESSION["cartItems"][$key]["productQty"] = $sessCartItem["productQty"] + $this->request->getPost("productQty");
            //             $_SESSION["cartItems"][$key]["productPrice"] = $sessCartItem["productPrice"] + ($this->request->getPost("productQty") * $price);
            //         }
            //     }
            // } else {
                array_push($_SESSION["cartItems"], $data);
            // }

            echo "checkout";
        }

    }

    public function cart()
    {
        $view = "users";
        $page_data["cart"] = $this->CartModel->orderBy("id DESC")->where(array("userId" => $this->session->get("userId"), "country" => $this->session->get("countryId")))->get()->getResultArray();
        $page_data['page_name'] = "cart";
        
        return view($view . "/index", $page_data);
    }


    public function removeFromCart()
    {
        $id = $this->request->getPost("id");

        $this->CartModel->delete($id);
        echo true;
    }

    public function removeFromSessionCart()
    {
        $id = $this->request->getPost("id");

        unset($_SESSION["cartItems"][$id]);
        echo true;
    }

    public function checkout()
    {
        $view = "users";
        $page_data["cart"] = $this->CartModel->orderBy("id DESC")->where(array("userId" => $this->session->get("userId"), "country" => $this->session->get("countryId")))->get()->getResultArray();
        $page_data["addresses"] = $this->AddressModel->orderBy("id DESC")->where(array("userId" => $this->session->get("userId")))->get()->getResultArray();
        $page_data['page_name'] = "checkout";
        
        return view($view . "/index", $page_data);
    }

    public function addAddress()
    {
        if ($this->session->get("logged_in")) {
            $data["userId"] = $this->session->get("userId");
        } else {
            $checkEmail = $this->UserModel->where("email", $this->request->getPost("email"))->first();

            if ($checkEmail != NULL) {
                $this->session->set("logged_in", true);
                $this->session->set("userId", $checkEmail["id"]);
                $this->session->set("userName", $checkEmail["name"]);
                $this->session->set("userEmail", $checkEmail["email"]);
                $this->session->set("userRole", $checkEmail["role"]);
                foreach ($this->session->get("cartItems") as $key => $value) {
                    $this->CartModel->insert(array(
                        "userId" => $this->session->get("userId"),
                        "productId" => $value["productId"],
                        "productQty" => $value["productQty"],
                        "productPrice" => $value["productPrice"],
                        "country" => $value["country"],
                        "createdAt" => $value["createdAt"],
                    ));
                }
                $data["userId"] = $checkEmail["id"];
            } else {
                $this->UserModel->insert(array(
                    "name" => $this->request->getPost("name"),
                    "email" => $this->request->getPost("email"),
                    "role" => 3,
                    "status" => 0,
                    "verificationCode" => substr(md5(time()), 0, 15),
                    "createdAt" => strtotime(date('d-M-Y H:i:s'))
                ));
                $checkRegEmail = $this->UserModel->where("email", $this->request->getPost("email"))->first();
                $this->session->set("logged_in", true);
                $this->session->set("userId", $checkRegEmail["id"]);
                $this->session->set("userName", $checkRegEmail["name"]);
                $this->session->set("userEmail", $checkRegEmail["email"]);
                $this->session->set("userRole", $checkRegEmail["role"]);
                foreach ($this->session->get("cartItems") as $key => $value) {
                    $this->CartModel->insert(array(
                        "userId" => $this->session->get("userId"),
                        "productId" => $value["productId"],
                        "productQty" => $value["productQty"],
                        "productPrice" => $value["productPrice"],
                        "country" => $value["country"],
                        "createdAt" => $value["createdAt"],
                    ));
                }
                $data["userId"] = $checkRegEmail["id"];
            }
        }

        $data["name"] = $this->request->getPost("name");
        $data["email"] = $this->request->getPost("email");
        $data["contact"] = $this->request->getPost("contact");
        $data["address"] = $this->request->getPost("address");
        $data["address2"] = $this->request->getPost("address2");
        $data["city"] = $this->request->getPost("city");
        $data["state"] = $this->request->getPost("state");
        $data["country"] = $this->request->getPost("country");
        $data["zipcode"] = $this->request->getPost("zipcode");

        $this->AddressModel->insert($data);
        echo true;
    }

    public function getAddress() {
        $id = $this->request->getPost("addressId");
        $address = $this->AddressModel->where("id", $id)->get()->getRowArray();
        echo json_encode($address);
    }

    public function updateAddress() {
        $id = $this->request->getPost("id");

        $data["name"] = $this->request->getPost("name");
        $data["email"] = $this->request->getPost("email");
        $data["contact"] = $this->request->getPost("contact");
        $data["address"] = $this->request->getPost("address");
        $data["address2"] = $this->request->getPost("address2");
        $data["city"] = $this->request->getPost("city");
        $data["state"] = $this->request->getPost("state");
        $data["country"] = $this->request->getPost("country");
        $data["zipcode"] = $this->request->getPost("zipcode");

        $address = $this->db->table("address")->where("id", $id)->update($data);
        echo true;
    }

    public function placeOrder()
    {
        $cart = $this->CartModel->orderBy("id DESC")->where(array("userId" => $this->session->get("userId"), "country" => $this->session->get("countryId")))->get()->getResultArray();

        $data["userId"] = $this->session->get("userId");
        $data["addressId"] = $this->request->getPost("addressId");
        $data["products"] = json_encode($cart);
        $data["subtotal"] = $this->request->getPost("subtotal");
        $data["discount"] = $this->request->getPost("discount");
        $data["total"] = $this->request->getPost("total");
        $data["country"] = $this->session->get("countryId");
        $data["orderDate"] = strtotime(date("d-M-Y H:i:s"));
        $data["orderStatus"] = 1;
        $data["paymentMethod"] = $this->request->getPost("paymentMethod");
        $data["paymentStatus"] = 1;

        $this->OrdersModel->insert($data);
        echo true;
    }

    public function customProduct()
    {
        $data["name"] = $this->request->getPost("name");
        $data["email"] = $this->request->getPost("email");
        $data["contact"] = $this->request->getPost("contact");
        $data["contact2"] = $this->request->getPost("contact2");
        $data["address"] = $this->request->getPost("address");
        $data["address2"] = $this->request->getPost("address2");
        $data["city"] = $this->request->getPost("city");
        $data["state"] = $this->request->getPost("state");
        $data["country"] = $this->request->getPost("country");
        $data["zipcode"] = $this->request->getPost("zipcode");
        $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));
        $imagesArr = array();

        if (($_FILES['images']['name']!="")) {
            // Where the file is going to be stored
            $target_dir = FCPATH . "uploads/custom/";
            for ($i=0; $i < count($_FILES['images']['name']); $i++) { 
                $file = $_FILES['images']['name'][$i];
                $path = pathinfo($file);
                $filename = strtotime(date("d-M-Y H:i:s")).rand(0, 3000);
                $ext = $path['extension'];
                $temp_name = $_FILES['images']['tmp_name'][$i];
                $path_filename_ext = $target_dir . $filename . "." . $ext;

                // Check if file already exists
                if (file_exists($path_filename_ext)) {
                    $data["images"] = NULL;
                } else {
                    $move_uploaded_file = move_uploaded_file($temp_name, $path_filename_ext);
                    array_push($imagesArr, $filename . "." . $ext);
                    $data["images"] = json_encode($imagesArr);
                }
            }
        } else {
            $data["images"] = NULL;
        }

        $this->CustomModel->insert($data);
        return redirect()->to(site_url());
    }

    public function review()
    {
        $data["userId"] = $this->session->get("userId");
        $data["productId"] = $this->session->get("productId");
        $data["rating"] = $this->request->getPost("rating");
        $data["review"] = $this->request->getPost("review");
        $data["status"] = 0;
        $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));

        $this->ReviewModel->insert($data);
        echo true;
    }

    public function deleteUserCart()
    {
        $userCart = $this->CartModel->where("userId", $this->session->get("userId"))->get()->getResultArray();

        foreach ($userCart as $key => $userCart) {
            $this->CartModel->delete($userCart["id"]);
        }

        $this->session->set("cartItems", array());

        echo true;
    }

    public function wishlist()
    {
        if ($this->session->get("country") == NULL) {
            return redirect()->to(site_url());
        }

        $view = "users";
        $page_data["wishlists"] = $this->WishlistModel->where(array("userId" => $this->session->get("userId"), "country" => $this->session->get("countryId")))->get()->getResultArray();
        $page_data["page_name"] = "wishlist";
        
        return view($view . "/index", $page_data);
    }

    public function toggleWishlist()
    {
        $productId = $this->request->getPost("productId");

        $check = $this->WishlistModel->where(array("userId" => $this->session->get("userId"), "productId" => $productId))->get()->getResultArray();

        if (count($check) > 0) {
            $this->WishlistModel->delete($check[0]["id"]);
            echo "removed";
        } else {
            $this->WishlistModel->insert(array("userId" => $this->session->get("userId"), "productId" => $productId, "country" => $this->session->get("countryId"), "createdAt" => strtotime(date("d-M-Y H:i:s"))));
            echo "added";
        }
    }

    public function orders($param1="", $param2="")
    {
        if ($this->session->get("country") == NULL) {
            return redirect()->to(site_url());
        }

        if ($param1 == "view") {
            $view = "users";
            $page_data["order"] = $this->OrdersModel->where("id", $param2)->get()->getRowArray();
            $page_data["page_name"] = "order";
            
            return view($view . "/order", $page_data);
        } else {
            $view = "users";
            $page_data["orders"] = $this->OrdersModel->where(array("userId" => $this->session->get("userId"), "country" => $this->session->get("countryId")))->get()->getResultArray();
            $page_data["page_name"] = "orders";
            
            return view($view . "/index", $page_data);
        }
    }

    public function contact()
    {

        $view = "users";
        $page_data["page_name"] = "contact";
        
        return view($view . "/index", $page_data);
    }

    public function sendMail()
    {
        // $res = $this->EmailModel->sendMail("This is a test message", "Test Mail", "mdsiddiq1495@gmail.com");
        // var_dump($res);
        echo substr(md5(time()), 0, 15);
    }
}

<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

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
use App\Models\ProductVariantsModel;
use App\Models\ProductAttributesVariantsModel;
use App\Models\CouponsModel;

use App\Libraries\Toyyib;
use App\Libraries\Stripe;

class Home extends BaseController
{

    public function __construct()
    {
        require APPPATH . 'vendor/autoload.php';

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
        $this->ProductVariantsModel = new ProductVariantsModel();
        $this->ProductAttributesVariantsModel = new ProductAttributesVariantsModel();
        $this->CouponsModel = new CouponsModel();
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

            $this->session->set("isCoupon", false);
            $this->session->set("couponCode", "");
            $this->session->set("couponDiscount", 0);
            
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
            $view = "users";

            return view($view . "/main");
        }

        $view = "users";
        $page_data["page_name"] = "search";
        $page_data["products"] = $this->ProductModel->like("name", $_GET["keyword"])->where(array("country" => $this->session->get("countryId"), "status" => 1))->get()->getResultArray();
        $page_data["categories"] = $this->CategoryModel->where("country", $this->session->get("countryId"))->get()->getResultArray();
        
        return view($view . "/index", $page_data);
    }

    public function shop()
    {
        if ($this->session->get("countryId") == NULL) {
            $view = "users";

            return view($view . "/main");
        }

        $selectedCategoryID = "all";
        $selectedCategoryProducts = array();
        $mergedArray = array();

        // Get the category ids
        if (isset($_GET["category"]) && !empty($_GET["category"] && $_GET["category"] != "all")) {
            $selectedCategoryID = $this->CategoryModel->getCategoryIDs($_GET["category"], $this->session->get("countryId"));
            // $page_data["products"] = $this->ProductModel->where(array("country" => $this->session->get("countryId"), "category" => $selectedCategoryID[0]["id"]))->get()->getResultArray();
            foreach ($selectedCategoryID as $key => $selectedCategory) {
                $selectedCategoryProduct = $this->ProductModel->where(array("country" => $this->session->get("countryId"), "category" => $selectedCategory["id"], "status" => 1))->get()->getResultArray();
                array_push($selectedCategoryProducts, $selectedCategoryProduct);
            }

            if (count($selectedCategoryProducts) > 0) {
                foreach ($selectedCategoryProducts as $subArray) {
                    foreach ($subArray as $item) {
                        $mergedArray[] = $item;
                    }
                }

                $page_data["products"] = $mergedArray;
            } else {
                $page_data["products"] = $selectedCategoryProducts;
            }
            
        }

        if ($selectedCategoryID == "all") {
            $page_data["products"] = $this->ProductModel->where(array("country" => $this->session->get("countryId"), "status" => 1))->get()->getResultArray();
        }


        $view = "users";
        $page_data["page_name"] = "shop";
        $page_data["selected_category_id"] = $selectedCategoryID;
        $page_data["categories"] = $this->CategoryModel->where(array("country" => $this->session->get("countryId"), "status" => 1))->get()->getResultArray();
        
        return view($view . "/index", $page_data);
    }

    public function category($param1="", $param2="")
    {
        if ($this->session->get("countryId") == NULL) {
            $view = "users";

            return view($view . "/main");
        }

        $view = "users";
        $page_data["page_name"] = "products";
        $page_data["categoryID"] = $param2;
        $page_data["products"] = $this->ProductModel->where(array("category" => $param2, "country" => $this->session->get("countryId"), "status" => 1))->get()->getResultArray();
        
        return view($view . "/index", $page_data);
    }

    public function product($param1='', $param2='')
    {
        if ($this->session->get("countryId") == NULL) {
            $view = "users";

            return view($view . "/main");
        }

        $view = "users";
        $page_data["page_name"] = "product";
        $page_data["product"] = $this->ProductModel->where(array("slug" => $param1, "id" => $param2, "country" => $this->session->get("countryId")))->get()->getRowArray();
        $page_data["reviews"] = $this->ReviewModel->where(array("productId" => $param2, "status" => 1))->get()->getResultArray();
        $page_data["rating"] = $this->db->table("productreviews")->select("AVG(rating) rating")->where(array("productId" => $param2, "status" => 1))->get()->getResultArray();
        $page_data["isPurchased"] = $this->isPurchased($param2);
        
        if ($page_data["product"]["type"] == 2) {
            $page_data["sizes"] = $this->productVariantSizes($param2);
            $page_data["colors"] = $this->productVariantColors($param2);
        }

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

    public function productVariantSizes($id)
    {
        $builder = $this->db->table("productvariants p");
        $builder->select("p.size");
        $builder->distinct();
        $builder->where("productId", $id);
        return $builder->get()->getResultArray();
    }

    public function productVariantColors($id)
    {
        $builder = $this->db->table("productvariants p");
        $builder->select("p.color");
        $builder->distinct();
        $builder->where("productId", $id);
        return $builder->get()->getResultArray();
    }

    public function addToCart()
    {
        $product = $this->ProductModel->where("id", $this->request->getPost("productId"))->get()->getRowArray();
        $updatedQuantity = (int) $product["quantity"] - $this->request->getPost("productQty");

        if ($product["isDiscount"] == 1) {
            $price = $product["discountedPrice"];
        } else {
            $price = $product["price"];
        }

        if ($this->session->get("logged_in")) {
            // $checkCart = $this->CartModel->orderBy("id DESC")->where(array("userId" => $this->session->get("userId"), "productId" => $this->request->getPost("productId")))->get()->getResultArray();

            // if (count($checkCart) > 0) {
            //     $newQty = $checkCart[0]["productQty"] + $this->request->getPost("productQty");
            //     $newPrice = $checkCart[0]["productPrice"] + ($this->request->getPost("productQty") * $price);
            //     $this->db->table("cart")->where("id", $checkCart[0]["id"])->update(array("productQty" => $newQty, "productPrice" => $newPrice));
            // } else {
                $data["userId"] = $this->session->get("userId");
                $data["productId"] = $this->request->getPost("productId");
                $data["productType"] = 1;
                $data["productSize"] = NULL;
                $data["productColor"] = NULL;
                $data["productQty"] = $this->request->getPost("productQty");
                $data["productPrice"] = $this->request->getPost("productQty") * $price;
                $data["country"] = $this->session->get("countryId");
                $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));

                // $this->db->table("products")->where("id", $this->request->getPost("productId"))->update(array("quantity" => $updatedQuantity));

                $this->CartModel->insert($data);
            // }

            echo "cart";
        } else {
            if (!isset($_SESSION["cartItems"])) {
                $_SESSION["cartItems"] = array();
            }

            $sessCartItems = $this->session->get("cartItems");

            $data["tempId"] = strtotime(date("d-M-Y H:i:s"));
            $data["userId"] = NULL;
            $data["productId"] = $this->request->getPost("productId");
            $data["productType"] = 1;
            $data["productSize"] = NULL;
            $data["productColor"] = NULL;
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
            // $this->db->table("products")->where("id", $this->request->getPost("productId"))->update(array("quantity" => $updatedQuantity));

            array_push($_SESSION["cartItems"], $data);
            $this->CartModel->insert($data);
            // }


            echo "checkout";
        }

    }

    public function getVariantColor()
    {
        $colorsArr = array();
        $resultArr = array();

        $size = $this->request->getPost("size");
        $productId = $this->session->get("productId");

        $colors = $this->productVariantColors($productId);

        foreach ($colors as $key => $color) {
            $builder = $this->db->table("productvariants p");
            $builder->select("p.*, pv.name");
            $builder->join("productattributesvariants pv", "p.color = pv.id");
            $builder->where(array("productId" => $productId, "size" => $size, "color" => $color["color"]));
            $asd = $builder->get()->getRowArray();

            if ($asd == null) {
                $row = $this->ProductAttributesVariantsModel->where("id", $color["color"])->get()->getRowArray();
                array_push($colorsArr, array("exists" => false, "row" => $row));
            } else {
                array_push($colorsArr, array("exists" => true, "row" => $asd));
            }
        }

        echo json_encode($colorsArr);
    }

    public function addToCartVariant()
    {
        $product = $this->ProductModel->where("id", $this->request->getPost("productId"))->get()->getRowArray();

        if ($product["isDiscount"] == 1) {
            $price = $product["discountedPrice"];
        } else {
            $price = $product["price"];
        }

        if ($this->session->get("logged_in")) {
            // $checkCart = $this->CartModel->orderBy("id DESC")->where(array("userId" => $this->session->get("userId"), "productId" => $this->request->getPost("productId")))->get()->getResultArray();

            // if (count($checkCart) > 0) {
            //     $newQty = $checkCart[0]["productQty"] + $this->request->getPost("productQty");
            //     $newPrice = $checkCart[0]["productPrice"] + ($this->request->getPost("productQty") * $price);
            //     $this->db->table("cart")->where("id", $checkCart[0]["id"])->update(array("productQty" => $newQty, "productPrice" => $newPrice));
            // } else {
                $checkVariant = $this->ProductVariantsModel->where(array("productId" => $this->request->getPost("productId"), "size" => $this->request->getPost("productSize"), "color" => $this->request->getPost("productColor")))->get()->getRowArray();

                if ($checkVariant == NULL) {
                    echo json_encode(array("error" => true, "message" => "Combination not available"));
                } else {
                    if ($checkVariant["quantity"] == "0") {
                        echo json_encode(array("error" => true, "message" => "Out of Stock"));
                    } else {
                        $data["userId"] = $this->session->get("userId");
                        $data["productId"] = $this->request->getPost("productId");
                        $data["productType"] = 2;
                        $data["productSize"] = $this->request->getPost("productSize");
                        $data["productColor"] = $this->request->getPost("productColor");
                        $data["productQty"] = $this->request->getPost("productQty");
                        $data["productPrice"] = $this->request->getPost("productQty") * $price;
                        $data["country"] = $this->session->get("countryId");
                        $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));

                        // $updatedQuantity = $checkVariant["quantity"] - $data["productQty"];

                        // $this->db->table("productvariants")->where("id", $checkVariant["id"])->update(array("quantity" =>$updatedQuantity));

                        $this->CartModel->insert($data);
                        echo json_encode(array("error" => false, "message" => "cart"));
                    }
                }
        } else {
            if (!isset($_SESSION["cartItems"])) {
                $_SESSION["cartItems"] = array();
            }

            $sessCartItems = $this->session->get("cartItems");

            $checkVariant = $this->ProductVariantsModel->where(array("productId" => $this->request->getPost("productId"), "size" => $this->request->getPost("productSize"), "color" => $this->request->getPost("productColor")))->get()->getRowArray();
                
            if ($checkVariant == NULL) {
                echo json_encode(array("error" => true, "message" => "Combination not available"));
            } else {
                if ($checkVariant["quantity"] == "0") {
                    echo json_encode(array("error" => true, "message" => "Out of Stock"));
                } else {
                    $data["tempId"] = strtotime(date("d-M-Y H:i:s"));
                    $data["userId"] = NULL;
                    $data["productId"] = $this->request->getPost("productId");
                    $data["productType"] = 2;
                    $data["productSize"] = $this->request->getPost("productSize");
                    $data["productColor"] = $this->request->getPost("productColor");
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

                    // $updatedQuantity = $checkVariant["quantity"] - $data["productQty"];

                    // $this->db->table("productvariants")->where("id", $checkVariant["id"])->update(array("quantity" =>$updatedQuantity));

                    array_push($_SESSION["cartItems"], $data);
                    $this->CartModel->insert($data);
                    echo json_encode(array("error" => false, "message" => "checkout", "data" => json_encode($_SESSION["cartItems"])));
                }
            }

            // if (count($_SESSION["cartItems"]) > 0) {
            //     foreach ($_SESSION["cartItems"] as $key => $sessCartItem) {
            //         if ($sessCartItem["productId"] == $this->request->getPost("productId")) {
            //             $_SESSION["cartItems"][$key]["productQty"] = $sessCartItem["productQty"] + $this->request->getPost("productQty");
            //             $_SESSION["cartItems"][$key]["productPrice"] = $sessCartItem["productPrice"] + ($this->request->getPost("productQty") * $price);
            //         }
            //     }
            // } else {
                // array_push($_SESSION["cartItems"], $data);
            // }
        }

    }

    public function cart()
    {
        if ($this->session->get("countryId") == NULL) {
            $view = "users";

            return view($view . "/main");
        }

        $view = "users";
        $page_data["cart"] = $this->CartModel->orderBy("id DESC")->where(array("userId" => $this->session->get("userId"), "country" => $this->session->get("countryId")))->get()->getResultArray();
        $page_data['page_name'] = "cart";
        
        return view($view . "/index", $page_data);
    }

    public function updateCart()
    {
        $id = $this->request->getPost("cartId");
        $subTotal = (int) $this->request->getPost("cartSubTotal");
        $action = $this->request->getPost("action");

        $getCart = $this->CartModel->where("id", $id)->first();
        $getProduct = $this->ProductModel->where("id", $getCart["productId"])->first();

        if ($getProduct["isDiscount"] == 1) {
            $price = $getProduct["discountedPrice"];
        } else {
            $price = $getProduct["price"];
        }

        if ($action == "plus") {
            $newQty = $getCart["productQty"] + 1;
            $newPrice = $newQty * $price;
        } else if ($action == "minus") {
            $newQty = $getCart["productQty"] - 1;
            $newPrice = $newQty * $price;
        }


        if ($newQty > 0) {
            $this->db->table("cart")->where("id", $id)->update(array("productQty" => $newQty, "productPrice" => $newPrice));

            $userCart = $this->CartModel->where(array("userId" => $this->session->get("userId"), "country" => $this->session->get("countryId")))->get()->getResultArray();

            $newSubTotal = 0;

            foreach ($userCart as $key => $userCart) {
                $newSubTotal += $userCart["productPrice"];
            }

            $getUpdatedCart = $this->CartModel->where("id", $id)->first();
            $getUpdatedCart["cartSubTotal"] = $newSubTotal;
            echo json_encode($getUpdatedCart);
        } else {
            $getCart["cartSubTotal"] = $subTotal;
            echo json_encode($getCart);
        }
        
    }

    public function removeFromCart()
    {
        $id = $this->request->getPost("id");

        $cartRow = $this->CartModel->where("id", $id)->get()->getRowArray();

        if ($cartRow["productType"] == "1") {
            $product = $this->ProductModel->where("id", $cartRow["productId"])->get()->getRowArray();
            if ($product != NULL) {
                $updatedQuantity = (int) $product["quantity"] + $cartRow["productQty"];
            }

            // $this->db->table("products")->where("id", $product["id"])->update(array("quantity" => $updatedQuantity));
        } elseif ($cartRow["productType"] == "2") {
            $productVariant = $this->ProductVariantsModel->where(array("productId" => $cartRow["productId"], "size" => $cartRow["productSize"], "color" => $cartRow["productColor"]))->get()->getRowArray();
            if ($productVariant != NULL) {
                $updatedQuantity = (int) $productVariant["quantity"] + $cartRow["productQty"];
            }

            // $this->db->table("productvariants")->where("id", $productVariant["id"])->update(array("quantity" => $updatedQuantity));
        }

        $this->session->set("isCoupon", false);
        $this->session->set("couponCode", "");
        $this->session->set("couponDiscount", 0);

        $this->CartModel->delete($cartRow["id"]);
        echo true;
    }

    public function removeFromSessionCart()
    {
        $id = $this->request->getPost("id");

        $cartRow = $this->CartModel->where("tempId", $id)->get()->getRowArray();

        if ($cartRow["productType"] == "1") {
            $product = $this->ProductModel->where("id", $cartRow["productId"])->get()->getRowArray();
            if ($product != NULL) {
                $updatedQuantity = (int) $product["quantity"] + $cartRow["productQty"];
            }

            // $this->db->table("products")->where("id", $product["id"])->update(array("quantity" => $updatedQuantity));
        } elseif ($cartRow["productType"] == "2") {
            $productVariant = $this->ProductVariantsModel->where(array("productId" => $cartRow["productId"], "size" => $cartRow["productSize"], "color" => $cartRow["productColor"]))->get()->getRowArray();
            if ($productVariant != NULL) {
                $updatedQuantity = (int) $productVariant["quantity"] + $cartRow["productQty"];
            }

            // $this->db->table("productvariants")->where("id", $productVariant["id"])->update(array("quantity" => $updatedQuantity));
        }

        foreach ($_SESSION["cartItems"] as $key => $value) {
            if ($value["tempId"] == $id) {
                unset($_SESSION["cartItems"][$key]);
            }
        }
        $this->CartModel->delete($cartRow["id"]);
        echo true;
    }

    public function checkout()
    {
        if ($this->session->get("countryId") == NULL) {
            $view = "users";

            return view($view . "/main");
        }

        $view = "users";
        $page_data["cart"] = $this->CartModel->orderBy("id DESC")->where(array("userId" => $this->session->get("userId"), "country" => $this->session->get("countryId")))->get()->getResultArray();
        $page_data["addresses"] = $this->AddressModel->orderBy("id DESC")->where(array("userId" => $this->session->get("userId"), "location" => $this->session->get("countryId")))->get()->getResultArray();
        $page_data['page_name'] = "checkout";
        
        return view($view . "/index", $page_data);
    }

    public function addAddress()
    {
        $country = $this->request->getPost("country");

        if ($country == "") {
            return "Something went wrong. Please try again";
        } else {
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
                        $this->db->table("cart")->where("tempId", $value["tempId"])->update(array("userId" => $this->session->get("userId")));
                        // $this->CartModel->insert(array(
                        //     "userId" => $this->session->get("userId"),
                        //     "productId" => $value["productId"],
                        //     "productQty" => $value["productQty"],
                        //     "productPrice" => $value["productPrice"],
                        //     "country" => $value["country"],
                        //     "createdAt" => $value["createdAt"],
                        // ));
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
                        // $this->CartModel->insert(array(
                        //     "userId" => $this->session->get("userId"),
                        //     "productId" => $value["productId"],
                        //     "productQty" => $value["productQty"],
                        //     "productPrice" => $value["productPrice"],
                        //     "country" => $value["country"],
                        //     "createdAt" => $value["createdAt"],
                        // ));
                        $this->db->table("cart")->where("tempId", $value["tempId"])->update(array("userId" => $this->session->get("userId")));
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
            $data["location"] = $this->session->get("countryId");
            $data["zipcode"] = $this->request->getPost("zipcode");
            $data["createdAt"] = strtotime(date('d-M-Y H:i:s'));

            $this->AddressModel->insert($data);
            echo true;
        }
    }

    public function getAddress() {
        $id = $this->request->getPost("addressId");
        $address = $this->AddressModel->where("id", $id)->get()->getRowArray();
        echo json_encode($address);
    }

    public function updateAddress() {
        $id = $this->request->getPost("id");
        $country = $this->request->getPost("country");

        if ($id == "" || $country == "") {
            return "Something went wrong. Please try again";
        } else {
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
    }

    public function getShipping()
    {
        $address = $this->AddressModel->where("id", $this->request->getPost("addressId"))->get()->getRowArray();

        $weight = $this->request->getPost("weight");

        $query = "SELECT * FROM `shipping` WHERE `minimum` <= $weight AND `maximum` >= $weight AND `country` = {$address['country']} AND `status` = 1";
        $shipping = $this->db->query($query)->getRowArray();

        // $shipping = $this->db->table("shipping")->where("minimum <=", $this->request->getPost("weight"))->where("maximum >=", $this->request->getPost("weight"))->where("country", $address["country"])->where("status", 1)->get()->getRowArray();

        echo json_encode($shipping);
    }

    public function getShippingCountries()
    {
        $countries = $this->db->table("shippingcountry")->where(array("status" => 1, "location" => $this->session->get('countryId')))->get()->getResultArray();
        echo json_encode($countries);
    }

    public function applyCoupon()
    {
        if ($this->session->get("logged_in")) {
            $code = $this->request->getPost("coupon");

            $coupon = $this->CouponsModel->where(array("code" => $code, "country" => $this->session->get("countryId"), "status" => 1))->get()->getRowArray();

            if ($coupon == null) {
                echo json_encode(["status" => "error", "message" => "Invalid Coupon Code"]);
            } else {
                $type = $coupon["type"];
                $value = $coupon["value"];
                $product = $coupon["product"];
                $expiry = $coupon["expiry"];
                $subTotal = 0;
                $discount = 0;
                $isDiscount = 0;
                $price = 0;

                $cart = $this->CartModel->where(array("userId" => $this->session->get("userId"), "country" => $this->session->get("countryId")))->get()->getResultArray();
                
                if ($expiry != NULL) {
                    $now = strtotime(date("d-M-Y"));

                    if ($now > $expiry) {
                        $this->session->set("isCoupon", false);
                        $this->session->set("couponCode", "");
                        $this->session->set("couponDiscount", 0);
                        
                        echo json_encode(["status" => "error", "message" => "Coupon Code Expired"]);
                    } else {
                        if ($product != "") {
                            $productArr = array();
                            foreach ($cart as $key => $cart) {
                                $cproduct = $this->db->table("products")->where("id", $cart["productId"])->get()->getRowArray();
                                
                                if ($cproduct["isDiscount"] == 1) {
                                    $subTotal += $cart["productQty"] * $cproduct["discountedPrice"];
                                } else {
                                    $subTotal += $cart["productQty"] * $cproduct["price"];
                                }

                                // if ($cproduct["id"] == $product) {
                                if (in_array($cproduct["id"], json_decode($product))) {
                                    array_push($productArr, $cproduct);
                                }

                            }

                            if (count($productArr) > 0) {
                                foreach ($productArr as $key => $productArray) {
                                    if (strval($productArray["isDiscount"]) == "1") {
                                        $price = $productArray["discountedPrice"];
                                        $isDiscount = 0;
                                    } else {
                                        $price = $productArray["price"];
                                        $isDiscount = $productArray["price"];
                                    }

                                    if ($type == 1) {
                                        if ($price > $value) {
                                            if ($isDiscount == 0) {
                                                $discount += 0;
                                            } else {
                                                $discount += $value;
                                            }
                                        }
                                    } else if ($type == 2) {
                                        $discount += ($value * $isDiscount) / 100;
                                    }
                                }
                            }

                            $this->session->set("isCoupon", true);
                            $this->session->set("couponCode", $code);
                            $this->session->set("couponDiscount", $discount);
                            
                            echo json_encode(["status" => "success", "currency" => $this->session->get("countryCurrency"), "subTotal" => $subTotal, "discount" => $discount, "price" => $price, "message" => "Coupon Applied..!"]);
                        } else {
                            foreach ($cart as $key => $cart) {
                                $product = $this->db->table("products")->where("id", $cart["productId"])->get()->getRowArray();
                                
                                if ($product["isDiscount"] == 1) {
                                    $subTotal += $cart["productQty"] * $product["discountedPrice"];
                                    $isDiscount += 0;
                                } else {
                                    $subTotal += $cart["productQty"] * $product["price"];
                                    $isDiscount += $cart["productQty"] * $product["price"];
                                }
                            }

                            if ($type == 1) {
                                if ($subTotal > $value) {
                                    if ($isDiscount == 0) {
                                        $discount += 0;
                                    } else {
                                        $discount += $value;
                                    }
                                }
                            } else if ($type == 2) {
                                $discount += ($value * $isDiscount) / 100;
                            }

                            $this->session->set("isCoupon", true);
                            $this->session->set("couponCode", $code);
                            $this->session->set("couponDiscount", $discount);
                            
                            echo json_encode(["status" => "success", "currency" => $this->session->get("countryCurrency"), "subTotal" => $subTotal, "discount" => $discount, "product" => $cart, "message" => "Coupon Applied..!"]);
                        }
                    }
                } else {
                    if ($product != "") {
                        $productArr = array();
                        foreach ($cart as $key => $cart) {
                            $cproduct = $this->db->table("products")->where("id", $cart["productId"])->get()->getRowArray();
                            
                            if ($cproduct["isDiscount"] == 1) {
                                $subTotal += $cart["productQty"] * $cproduct["discountedPrice"];
                            } else {
                                $subTotal += $cart["productQty"] * $cproduct["price"];
                            }

                            // if ($cproduct["id"] == $product) {
                            if (in_array($cproduct["id"], json_decode($product))) {
                                array_push($productArr, $cproduct);
                            }

                        }

                        if (count($productArr) > 0) {
                            foreach ($productArr as $key => $productArray) {
                                if ($productArray["isDiscount"] == 1) {
                                    $price = $productArray["discountedPrice"];
                                    $isDiscount = 0;
                                } else {
                                    $price = $productArray["price"];
                                    $isDiscount = $productArray["price"];
                                }

                                if ($type == 1) {
                                    if ($isDiscount == 0) {
                                        $discount += 0;
                                    } else {
                                        $discount += $value;
                                    }
                                } else if ($type == 2) {
                                    $discount += ($value * $isDiscount) / 100;
                                }
                            }
                        }

                        $this->session->set("isCoupon", true);
                        $this->session->set("couponCode", $code);
                        $this->session->set("couponDiscount", $discount);
                        
                        echo json_encode(["status" => "success", "currency" => $this->session->get("countryCurrency"), "subTotal" => $subTotal, "discount" => $discount, "price" => $price, "message" => "Coupon Applied..!"]);
                    } else {
                        foreach ($cart as $key => $cart) {
                            $product = $this->db->table("products")->where("id", $cart["productId"])->get()->getRowArray();
                            
                            if ($product["isDiscount"] == 1) {
                                $subTotal += $cart["productQty"] * $product["discountedPrice"];
                                $isDiscount += 0; 
                            } else {
                                $subTotal += $cart["productQty"] * $product["price"];
                                $isDiscount += $cart["productQty"] * $product["price"];
                            }
                        }

                        if ($type == 1) {
                            if ($subTotal > $value) {
                                if ($isDiscount == 0) {
                                    $discount += 0;
                                } else {
                                    $discount += $value;
                                }
                            }
                        } else if ($type == 2) {
                            $discount += ($value * $isDiscount) / 100;
                        }

                        $this->session->set("isCoupon", true);
                        $this->session->set("couponCode", $code);
                        $this->session->set("couponDiscount", $discount);
                        
                        echo json_encode(["status" => "success", "currency" => $this->session->get("countryCurrency"), "subTotal" => $subTotal, "discount" => $discount, "product" => $cart, "message" => "Coupon Applied..!"]);
                    }
                }

            }
        } else {
            echo json_encode(["status" => "failed", "message" => "Please login", "cart" => $_SESSION["cartItems"]]);
        }
    }

    public function removeCoupon()
    {
        $this->session->set("isCoupon", false);
        $this->session->set("couponCode", "");
        $this->session->set("couponDiscount", 0);

        echo json_encode(["status" => "success", "currency" => $this->session->get("countryCurrency")]);
    }

    public function proceedToCheckout()
    {
        if ($this->session->get("logged_in")) {
            $userId = $this->session->get("userId");

            $cart = $this->CartModel->where("userId", $userId)->get()->getResultArray();
            $productSimpleIdArr = array();
            $productVariableIdArr = array();
            $productSimpleArr = array();
            $productVariableArr = array();
            $productMsgArr = array();

            foreach ($cart as $key => $value) {
                if ($value["productType"] == "1") {
                    if (in_array($value["productId"], $productSimpleIdArr)) {
                        $keyValue = array_search($value["productId"], $productSimpleIdArr);
                        $newQty = (int) $cart[$key]["productQty"] + (int) $productSimpleArr[$keyValue]["productQty"];
                        $productSimpleArr[$keyValue]["productQty"] = $newQty;
                    } else {
                        array_push($productSimpleIdArr, $value["productId"]);
                        array_push($productSimpleArr, array("productId" => $value["productId"], "productType" => $value["productType"], "productQty" => $value["productQty"]));
                    }
                } else if ($value["productType"] == "2") {
                    $joinedId = $value["productId"] . "," . $value["productSize"] . "," . $value["productColor"];
                    if (in_array($joinedId, $productVariableIdArr)) {
                        $keyValue = array_search($joinedId, $productVariableIdArr);
                        $newQty = (int) $cart[$key]["productQty"] + (int) $productVariableArr[$keyValue]["productQty"];
                        $productVariableArr[$keyValue]["productQty"] = $newQty;
                    } else {
                        array_push($productVariableIdArr, $joinedId);
                        array_push($productVariableArr, array("productId" => $value["productId"], "productType" => $value["productType"], "productSize" => $value["productSize"], "productColor" => $value["productColor"], "productQty" => $value["productQty"]));
                    }
                }
            }

            foreach ($productSimpleArr as $key => $productSimple) {
                $product = $this->ProductModel->where("id", $productSimple["productId"])->get()->getRowArray();

                if ($productSimple["productQty"] > $product["quantity"]) {
                    array_push($productMsgArr, array("error" => true, "message" => $product["name"] . " only have " . $product["quantity"] . " quantity. But you added " . $productSimple["productQty"]));
                }
            }

            foreach ($productVariableArr as $key => $productVariable) {
                $product = $this->ProductVariantsModel->where(array("productId" => $productVariable["productId"], "size" => $productVariable["productSize"], "color" => $productVariable["productColor"]))->get()->getRowArray();

                if ($productVariable["productQty"] > $product["quantity"]) {
                    $name = $this->ProductModel->where("id", $product["productId"])->get()->getRow()->name;
                    $size = $this->ProductAttributesVariantsModel->where("id", $product["size"])->get()->getRow()->name;
                    $color = $this->ProductAttributesVariantsModel->where("id", $product["color"])->get()->getRow()->name;
                    array_push($productMsgArr, array("error" => true, "message" => $name . " <small><em>(Size: " . $size . " Color: " . $color . ")</em></small> only have " . $product["quantity"] . " quantity. But you added " . $productVariable["productQty"]));
                }
            }

            echo json_encode($productMsgArr);
        }
    }

    public function placeOrder()
    {
        if ($this->session->get("countryId") == NULL) {
            $view = "users";

            return view($view . "/main");
        }
        
        $cart = $this->CartModel->orderBy("id DESC")->where(array("userId" => $this->session->get("userId"), "country" => $this->session->get("countryId")))->get()->getResultArray();

        $data["userId"] = $this->session->get("userId");
        $data["addressId"] = $this->request->getPost("addressId");
        $data["products"] = json_encode($cart);
        $data["subtotal"] = $this->request->getPost("subtotal");
        $data["shipping"] = $this->request->getPost("shipping");
        
        if ($this->session->get("isCoupon") != Null) {
            $data["coupon"] = $this->session->get("couponCode");
        } else {
            $data["coupon"] = Null;
        }
        
        $data["discount"] = $this->request->getPost("discount");
        $data["total"] = $this->request->getPost("total");
        $data["country"] = $this->session->get("countryId");
        $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));
        $data["orderStatus"] = 1;
        $data["paymentMethod"] = $this->request->getPost("paymentMethod");
        $data["paymentStatus"] = 0; // 1 = Success, 2 = Pending, 3 = Failed

        $this->OrdersModel->insert($data);
        $orderID = $this->OrdersModel->getInsertID();

        $this->session->set("paymentOrderID", $orderID);

        $userData = $this->UserModel->where("id", $data["userId"])->first();
        $addressData = $this->AddressModel->where("id", $data["addressId"])->first();

        if ($this->session->get("countryId") == 1) {
            $stripe = new Stripe();

            $response = $stripe->createPayment($this->request->getPost("total"), $this->session->get("userEmail"));
            echo json_encode(array("payment" => "stripe", "response" => $response));
        } else if ($this->session->get("countryId") == 2) {
            $toyyib = new Toyyib();

            $response = $toyyib->createBill($data, $userData, $addressData, $orderID);
            echo json_encode(array("payment" => "toyyib", "response" => $response));
        } else {
            echo json_encode(array("message" => "Something is not right"));

        }
    }

    public function paymentStatus()
    {
        $orderID = $this->session->get("paymentOrderID");

        if ($_GET["payment"] == "stripe") {
            $stripe = new Stripe();

            $response = $stripe->verifyPayment($_GET['session_id']);

            if ($response->payment_status == "paid" && $response->status == "complete") {
                $data["paymentMethod"] = $_GET["payment"];
                $data["paymentStatus"] = 1;
                $data["paymentBillId"] = $response->id;
                $data["paymentOrderId"] = "FS" . $orderID . mt_rand(10000000, 99999999);
                $data["paymentTransactionId"] = $response->payment_intent;
            } else {
                $data["paymentMethod"] = $_GET["payment"];
                $data["paymentStatus"] = 3;
                $data["paymentBillId"] = $response->id;
                $data["paymentOrderId"] = "FS" . $orderID . mt_rand(10000000, 99999999);
                $data["paymentTransactionId"] = $response->payment_intent;
            }
        } else if ($_GET["payment"] == "toyyib") {
            $toyyib = new Toyyib();

            $response = $toyyib->verifyBill($_GET["billcode"], $_GET["status_id"]);
            
            $data["paymentMethod"] = $_GET["payment"];
            $data["paymentBillId"] = $_GET["billcode"];
            $data["paymentStatus"] = $response[0]->billpaymentStatus;
            $data["paymentOrderId"] = $response[0]->billExternalReferenceNo;
            $data["paymentTransactionId"] = $response[0]->billpaymentInvoiceNo;
        }

        $this->session->set("paymentStatus", $data["paymentStatus"]);
        $this->session->set("paymentOrderId", $data["paymentOrderId"]);

        $this->db->table("orders")->where("id", $orderID)->update($data);

        if ($data["paymentStatus"] == "1") {
            $this->updateProductQuantity($this->session->get("paymentOrderId"));
            $sendOrderConfirmationUserMail = $this->EmailModel->sendOrderConfirmationUserMail($orderID);
            $sendOrderConfirmationAdminMail = $this->EmailModel->sendOrderConfirmationAdminMail($orderID);
            $this->db->table("orders")->where("id", $orderID)->update(array("userEmail" => $sendOrderConfirmationUserMail, "adminEmail" => $sendOrderConfirmationAdminMail));
            $this->deleteUserCart();
        }

        // unset($_SESSION["paymentOrderID"]);

        return redirect()->to(site_url("order-confirmation"));
    }

    public function orderConfirmation()
    {
        $view = "users";
        $page_data["page_name"] = "payment";
        $page_data["paymentStatus"] = $this->session->get("paymentStatus");
        $page_data["paymentOrderId"] = $this->session->get("paymentOrderId");
        
        // unset($_SESSION["paymentStatus"]);
        // unset($_SESSION["paymentOrderId"]);

        return view($view . "/index", $page_data);
    }

    public function updateProductQuantity($paymentOrderId)
    {
        $order = $this->OrdersModel->select("products")->where("paymentOrderId", $paymentOrderId)->get()->getRowArray();

        foreach (json_decode($order["products"]) as $key => $product) {
            if ($product->productType == "1") {
                $productInfo = $this->ProductModel->where("id", $product->productId)->get()->getRowArray();
                $updatedQuantity = (int) $productInfo["quantity"] - (int) $product->productQty;
                
                $update = $this->db->table("products")->where("id", $productInfo["id"])->update(array("quantity" => $updatedQuantity));
            } elseif ($product->productType == "2") {
                $productVariant = $this->ProductVariantsModel->where(array("productId" => $product->productId, "size" => $product->productSize, "color" => $product->productColor))->get()->getRowArray();
                $updatedQuantity = (int) $productVariant["quantity"] - (int) $product->productQty;
                
                $update = $this->db->table("productvariants")->where("id", $productVariant["id"])->update(array("quantity" => $updatedQuantity));
            }
        }

    }

    public function deleteUserCart()
    {
        $userCart = $this->CartModel->where("userId", $this->session->get("userId"))->get()->getResultArray();

        foreach ($userCart as $key => $userCart) {
            $this->CartModel->delete($userCart["id"]);
        }

        $this->session->set("cartItems", array());

        return true;
    }

    public function preOrder()
    {
        $view = "users";
        $page_data["page_name"] = "preOrder";

        return view($view . "/index", $page_data);
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
        $data["url"] = $this->request->getPost("url");
        $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));
        $imagesArr = array();

        if ($_FILES['images']['name'][0] != "") {
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
        $this->EmailModel->sendCustomProductUserMail($data["name"], $data["email"]);
        $this->EmailModel->sendCustomProductAdminMail($data);
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

    public function wishlist()
    {
        if ($this->session->get("countryId") == NULL) {
            $view = "users";

            return view($view . "/main");
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
        if ($this->session->get("countryId") == NULL) {
            $view = "users";

            return view($view . "/main");
        }

        if ($param1 == "view") {
            $view = "users";
            $page_data["order"] = $this->OrdersModel->where("paymentOrderId", $param2)->get()->getRowArray();
            $page_data["page_name"] = "order";
            
            return view($view . "/order", $page_data);
        } else {
            $view = "users";
            $page_data["orders"] = $this->OrdersModel->where(array("userId" => $this->session->get("userId"), "country" => $this->session->get("countryId"), "paymentStatus" => 1))->get()->getResultArray();
            $page_data["page_name"] = "orders";
            
            return view($view . "/index", $page_data);
        }
    }

    public function about()
    {

        $view = "users";
        $page_data["page_name"] = "about";
        
        return view($view . "/index", $page_data);
    }

    public function contact()
    {

        $view = "users";
        $page_data["page_name"] = "contact";
        
        return view($view . "/index", $page_data);
    }

    public function submitContact()
    {
        $data["name"] = $this->request->getPost("name");
        $data["email"] = $this->request->getPost("email");
        $data["phone"] = $this->request->getPost("phone");
        $data["subject"] = $this->request->getPost("subject");
        $data["message"] = $this->request->getPost("message");
        
        $this->EmailModel->sendContactUserMail($data);
        $res = $this->EmailModel->sendContactAdminMail($data);

        echo $res;
    }

    public function privacyPolicy()
    {
        $view = "users";
        $page_data["page_name"] = "privacyPolicy";
        $page_data["privacyPolicy"] = getSettings("privacyPolicy");
        
        return view($view . "/index", $page_data);
    }

    public function terms()
    {
        $view = "users";
        $page_data["page_name"] = "terms";
        $page_data["terms"] = getSettings("terms");
        
        return view($view . "/index", $page_data);
    }

    public function refundPolicy()
    {
        $view = "users";
        $page_data["page_name"] = "refundPolicy";
        $page_data["refundPolicy"] = getSettings("refundPolicy");
        
        return view($view . "/index", $page_data);
    }

    public function sendMail()
    {
        // $data = array(
        //     "name" => "Test User",
        //     "email" => "test@tewst.com",
        //     "contact" => "1234567890",
        //     "address" => "Test address 1",
        //     "city" => "London",
        //     "state" => "UK",
        //     "country" => "United Kingdom",
        //     "zipcode" => "12345",
        //     "url" => "https://google.com",
        // );
        // $res = $this->EmailModel->sendMail("Test mail", "Test123", "celoxor959@raotus.com");
        // var_dump($res);
        // echo substr(md5(time()), 0, 15);
        // $myTime = new Time('now');
        // echo $myTime;
        $productVariant = $this->AddressModel->where(array("id" => 436))->get()->getRowArray();
        var_dump($productVariant);
        // $email = "honeystarss@yahoo.com";
        // $user = $this->UserModel->where("email", $email)->first();

        // if ($user == NULL) {
        //     echo false;
        // } else {
        //     $this->session->set("logged_in", true);
        //     $this->session->set("userId", $user["id"]);
        //     $this->session->set("userName", $user["name"]);
        //     $this->session->set("userEmail", $user["email"]);
        //     $this->session->set("userImage", $user["image"]);
        //     $this->session->set("userRole", $user["role"]);
        // }
    }
    
}

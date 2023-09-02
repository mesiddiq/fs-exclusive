<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ProductImageModel;
use App\Models\OrdersModel;
use App\Models\CustomModel;
use App\Models\ReviewModel;
use App\Models\TestimonialImageModel;
use App\Models\CountriesModel;
use App\Models\ShippingModel;
use App\Models\ShippingCountryModel;
use App\Models\ProductAttributesCategoryModel;
use App\Models\ProductAttributesVariantsModel;
use App\Models\ProductVariantsModel;
use App\Models\CouponsModel;

class Admin extends BaseController
{

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->CategoryModel = new CategoryModel();
        $this->ProductModel = new ProductModel();
        $this->ProductImageModel = new ProductImageModel();
        $this->OrdersModel = new OrdersModel();
        $this->CustomModel = new CustomModel();
        $this->ReviewModel = new ReviewModel();
        $this->TestimonialImageModel = new TestimonialImageModel();
        $this->CountriesModel = new CountriesModel();
        $this->ShippingModel = new ShippingModel();
        $this->ShippingCountryModel = new ShippingCountryModel();
        $this->ProductAttributesCategoryModel = new ProductAttributesCategoryModel();
        $this->ProductAttributesVariantsModel = new ProductAttributesVariantsModel();
        $this->ProductVariantsModel = new ProductVariantsModel();
        $this->CouponsModel = new CouponsModel();
    }

    public function index()
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                return redirect()->to("admin/dashboard");
            } else {
                return redirect()->to(site_url());
            }
        } else {
            return redirect()->to(site_url());
        }
    }

    public function dashboard()
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                $page_data["orders"] = $this->OrdersModel->orderBy("id", "DESC")->limit(10)->get()->getResultArray();
                $view = "admin";
                $page_data["page_title"] = "Dashboard";
                $page_data["page_name"] = "dashboard";

                return view($view . "/index", $page_data);
            } else {
                return redirect()->to(site_url());
            }
        } else {
            return redirect()->to(site_url());
        }
    }

    public function coupons($param1="", $param2="")
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "add") {
                    $page_data["countries"] = $this->CountriesModel->where("status", 1)->get()->getResultArray();
                    $page_data["products"] = $this->ProductModel->get()->getResultArray();
                    $view = "admin";
                    $page_data["page_title"] = "Add Coupons";
                    $page_data["page_name"] = "coupons-add";
                    
                    return view($view . "/index", $page_data);
                } else if ($param1 == "create") {
                    $data["userId"] = (int) $this->session->get("userId");
                    $data["code"] = $this->request->getPost("code");
                    $data["type"] = (int) $this->request->getPost("type");
                    $data["value"] = (int) $this->request->getPost("value");
                    $data["country"] = (int) $this->request->getPost("country");
                    $data["product"] = (int) $this->request->getPost("product");
                    if ($this->request->getPost("expiry") == "") {
                        $data["expiry"] = Null;
                    } else {
                        $data["expiry"] = strtotime($this->request->getPost("expiry"));
                    }
                    $data["count"] = 0;
                    $data["status"] = (int) $this->request->getPost("status");
                    $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));

                    $create = $this->CouponsModel->insert($data);
                    return redirect()->to("admin/coupons");
                } else if ($param1 == "edit") {
                    $page_data["coupon"] = $this->CouponsModel->where("id", $param2)->get()->getRowArray();
                    $page_data["countries"] = $this->CountriesModel->where("status", 1)->get()->getResultArray();
                    $page_data["products"] = $this->ProductModel->get()->getResultArray();
                    $view = "admin";
                    $page_data["page_title"] = "Edit Coupons";
                    $page_data["page_name"] = "coupons-edit";
                    
                    return view($view . "/index", $page_data);
                } else if ($param1 == "update") {
                    $data["code"] = $this->request->getPost("code");
                    $data["type"] = (int) $this->request->getPost("type");
                    $data["value"] = (int) $this->request->getPost("value");
                    $data["country"] = (int) $this->request->getPost("country");
                    $data["product"] = (int) $this->request->getPost("product");
                    if ($this->request->getPost("expiry") == "") {
                        $data["expiry"] = Null;
                    } else {
                        $data["expiry"] = strtotime($this->request->getPost("expiry"));
                    }
                    $data["status"] = (int) $this->request->getPost("status");
                    $data["updatedAt"] = strtotime(date("d-M-Y H:i:s"));

                    $update = $this->db->table("coupons")->where("id", $param2)->update($data);
                    return redirect()->to("admin/coupons");
                } else if ($param1 == "delete") {
                    $delete = $this->db->table("coupons")->where("id", $param2)->delete();
                    return redirect()->to("admin/coupons");
                } else {
                    $page_data["coupons"] = $this->CouponsModel->get()->getResultArray();
                    $view = "admin";
                    $page_data["page_title"] = "Coupons";
                    $page_data["page_name"] = "coupons";

                    return view($view . "/index", $page_data);
                }
            } else {
                return redirect()->to(site_url());
            }
        } else {
            return redirect()->to(site_url());
        }
    }

    public function categories($param1="", $param2="")
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "add") {
                    $view = "admin";
                    $page_data["page_title"] = "Add Category";
                    $page_data["page_name"] = "categories-add";
                    
                    return view($view . "/index", $page_data);
                } else if ($param1 == "create") {
                    $data["country"] = (int) $this->request->getPost("country");
                    $data["name"] = $this->request->getPost("name");
                    $data["slug"] = $this->slugify($this->request->getPost("name"));
                    $data["parent"] = $this->request->getPost("parent");
                    $data["status"] = $this->request->getPost("status");
                    $data["author"] = (int) $this->session->get("userId");
                    $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));

                    if (($_FILES["image"]["name"]!="")) {
                        // Where the file is going to be stored
                        $target_dir = FCPATH . "uploads/category/";
                        $file = $_FILES["image"]["name"];
                        $path = pathinfo($file);
                        $filename = strtotime(date("d-M-Y H:i:s")).rand(0, 3000);
                        $ext = $path["extension"];
                        $temp_name = $_FILES["image"]["tmp_name"];
                        $path_filename_ext = $target_dir . $filename . "." . $ext;
 
                        // Check if file already exists
                        if (file_exists($path_filename_ext)) {
                            echo "Sorry, file already exists.";
                            $data["image"] = NULL;
                        } else {
                            move_uploaded_file($temp_name,$path_filename_ext);
                            $data["image"] = $filename . "." . $ext;
                            echo "Congratulations! File Uploaded Successfully.";
                        }
                    } else {
                        $data["image"] = NULL;
                    }
                    $create = $this->CategoryModel->insert($data);
                    return redirect()->to("admin/categories");
                } else if ($param1 == "edit") {
                    $page_data["category"] = $this->CategoryModel->where("id", $param2)->get()->getRowArray();
                    $view = "admin";
                    $page_data["page_title"] = "Edit Category";
                    $page_data["page_name"] = "categories-edit";
                    
                    return view($view . "/index", $page_data);
                } else if ($param1 == "update") {
                    $data["country"] = (int) $this->request->getPost("country");
                    $data["name"] = $this->request->getPost("name");
                    $data["slug"] = $this->slugify($this->request->getPost("name"));
                    $data["parent"] = $this->request->getPost("parent");
                    $data["status"] = $this->request->getPost("status");
                    $data["updatedAt"] = strtotime(date("d-M-Y H:i:s"));

                    if (($_FILES["image"]["name"] != "")) {
                        // Where the file is going to be stored
                        $target_dir = FCPATH . "uploads/category/";
                        $file = $_FILES["image"]["name"];
                        $path = pathinfo($file);
                        $filename = strtotime(date("d-M-Y H:i:s")).rand(0, 3000);
                        $ext = $path["extension"];
                        $temp_name = $_FILES["image"]["tmp_name"];
                        $path_filename_ext = $target_dir . $filename . "." . $ext;
 
                        // Check if file already exists
                        if (file_exists($path_filename_ext)) {
                            echo "Sorry, file already exists.";
                            $data["image"] = $this->request->getPost("imageName");
                        } else {
                            move_uploaded_file($temp_name, $path_filename_ext);
                            $data["image"] = $filename . "." . $ext;
                            echo "Congratulations! File Uploaded Successfully.";
                        }
                    } else {
                        $data["image"] = $this->request->getPost("imageName");
                    }
                    $update = $this->db->table("category")->where("id", $param2)->update($data);
                    return redirect()->to("admin/categories");
                } else {
                    $page_data["categories"] = $this->CategoryModel->findAll();
                    $view = "admin";
                    $page_data["page_title"] = "Categories";
                    $page_data["page_name"] = "categories";

                    return view($view . "/index", $page_data);
                }
            } else {
                return redirect()->to(site_url());
            }
        } else {
            return redirect()->to(site_url());
        }
    }

    public function products($param1="", $param2="")
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "add") {
                    $this->session->set("productVariants", array());

                    $view = "admin";
                    $page_data["page_title"] = "Add Products";
                    $page_data["page_name"] = "products-add";
                    $this->session->set("adminProductCountryId", 1);
                    $this->session->set("productVariants", array());
                    
                    return view($view . "/index", $page_data);
                } else if ($param1 == "create") {
                    $data["name"] = $this->request->getPost("name");
                    $data["slug"] = $this->slugify($this->request->getPost("name"));
                    $data["type"] = (int) $this->request->getPost("type");
                    $data["shortDescription"] = $this->request->getPost("shortDescription");
                    $data["description"] = json_encode($this->request->getPost("description"));
                    $data["category"] = $this->request->getPost("category");
                    $data["country"] = (int) $this->request->getPost("country");
                    $data["isDiscount"] = (int) $this->request->getPost("isDiscount");
                    $data["price"] = $this->request->getPost("price");
                    $data["discountedPrice"] = $this->request->getPost("discountedPrice");
                    $data["quantity"] = (int) $this->request->getPost("quantity");
                    $data["weight"] = (int) $this->request->getPost("weight");
                    $data["sizeChart"] = (int) $this->request->getPost("sizeChart");
                    $data["isTopProduct"] = (int) $this->request->getPost("isTopProduct");
                    $data["isOutOfStock"] = (int) $this->request->getPost("isOutOfStock");
                    $data["status"] = (int) $this->request->getPost("status");
                    $data["author"] = (int) $this->session->get("userId");
                    $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));

                    $create = $this->ProductModel->insert($data);
                    $productID = $this->ProductModel->getInsertID();

                    if (($_FILES["image"]["name"] != "")) {
                        for ($i=0; $i < count($_FILES["image"]["name"]) ; $i++) { 
                            // Where the file is going to be stored
                            $target_dir = FCPATH . "uploads/products/";
                            $file = $_FILES["image"]["name"][$i];
                            $path = pathinfo($file);
                            $filename = strtotime(date("d-M-Y H:i:s")).rand(0, 3000);
                            $ext = $path["extension"];
                            $temp_name = $_FILES["image"]["tmp_name"][$i];
                            $path_filename_ext = $target_dir . $filename . "." . $ext;
     
                            // Check if file already exists
                            if (!file_exists($path_filename_ext)) {
                                move_uploaded_file($temp_name, $path_filename_ext);
                                $image = [
                                    "name" => $filename . "." . $ext,
                                    "productId"  => $productID,
                                    "createdAt"  => strtotime(date("d-M-Y H:i:s")),
                                ];

                                $this->ProductImageModel->insert($image);
                            }
                        }
                    }

                    if ($data["type"] == "2") {
                        $productVariants = $this->session->get("productVariants");

                        if (count($productVariants) > 0) {
                            foreach ($productVariants as $key => $value) {
                                $this->db->table("productvariants")->where("tempId", $value)->update(array("productId" => $productID));
                            }
                        }
                    }

                    return redirect()->to("admin/products");
                } else if ($param1 == "edit") {
                    $page_data["product"] = $this->ProductModel->where("id", $param2)->get()->getRowArray();
                    $view = "admin";
                    $page_data["page_title"] = "Edit Product";
                    $page_data["page_name"] = "products-edit";

                    $this->session->set("productVariants", array());
                    $this->session->set("productEditId", $param2);
                    
                    return view($view . "/index", $page_data);
                } else if ($param1 == "update") {
                    $data["name"] = $this->request->getPost("name");
                    $data["slug"] = $this->slugify($this->request->getPost("name"));
                    $data["type"] = (int) $this->request->getPost("type");
                    $data["shortDescription"] = $this->request->getPost("shortDescription");
                    $data["description"] = json_encode($this->request->getPost("description"));
                    $data["category"] = $this->request->getPost("category");
                    // $data["country"] = (int) $this->request->getPost("country");
                    $data["isDiscount"] = (int) $this->request->getPost("isDiscount");
                    $data["price"] = $this->request->getPost("price");
                    $data["discountedPrice"] = $this->request->getPost("discountedPrice");
                    $data["quantity"] = (int) $this->request->getPost("quantity");
                    $data["weight"] = (int) $this->request->getPost("weight");
                    $data["sizeChart"] = (int) $this->request->getPost("sizeChart");
                    $data["isTopProduct"] = (int) $this->request->getPost("isTopProduct");
                    $data["isOutOfStock"] = (int) $this->request->getPost("isOutOfStock");
                    $data["status"] = (int) $this->request->getPost("status");
                    $data["updatedAt"] = strtotime(date("d-M-Y H:i:s"));

                    if (($_FILES["image"]["name"][0] != "")) {
                        for ($i=0; $i < count($_FILES["image"]["name"]) ; $i++) { 
                            // Where the file is going to be stored
                            $target_dir = FCPATH . "uploads/products/";
                            $file = $_FILES["image"]["name"][$i];
                            $path = pathinfo($file);
                            $filename = strtotime(date("d-M-Y H:i:s")).rand(0, 3000);
                            $ext = $path["extension"];
                            $temp_name = $_FILES["image"]["tmp_name"][$i];
                            $path_filename_ext = $target_dir . $filename . "." . $ext;
     
                            // Check if file already exists
                            if (!file_exists($path_filename_ext)) {
                                move_uploaded_file($temp_name, $path_filename_ext);
                                $image = [
                                    "name" => $filename . "." . $ext,
                                    "productId"  => $param2,
                                    "createdAt"  => strtotime(date("d-M-Y H:i:s")),
                                ];

                                $this->ProductImageModel->insert($image);
                            }
                        }
                    }
                    
                    $update = $this->db->table("products")->where("id", $param2)->update($data);
                    return redirect()->to("admin/products");
                } else if ($param1 == "delete") {
                    $delete = $this->db->table("products")->where("id", $param2)->delete();
                    return redirect()->to("admin/products");
                } else if ($param1 == "setImageFeatured") {
                    $id = $this->request->getPost("id");
                    $productID = $this->request->getPost("productID");

                    $productImages = $this->db->table("productimages")->where("productID", $productID)->get()->getResultArray();
                    foreach ($productImages as $key => $productImage) {
                        if ($id == $productImage["id"]) {
                            $this->db->table("productimages")->where("id", $productImage["id"])->update(array("featured" => 1));
                        } else {
                            $this->db->table("productimages")->where("id", $productImage["id"])->update(array("featured" => NULL));
                        }
                    }
                    echo true;
                } else if ($param1 == "deleteImage") {
                    $id = $this->request->getPost("id");
                    $this->ProductImageModel->delete($id);
                    echo true;
                } else if ($param1 == "variants") {
                    if ($param2 == "add") {
                        $productVariants = array();

                        $data["tempId"] = strtotime(date("d-M-Y H:i:s"));
                        $data["productId"] = $this->session->get("productEditId");
                        $data["size"] = $this->request->getPost("size");
                        $data["color"] = $this->request->getPost("color");
                        $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));

                        if ($this->session->get("productVariants") == "") {
                            $this->session->set("productVariants", array($data["tempId"]));
                        } else {
                            $sessionVariants = $this->session->get("productVariants");
                            array_push($sessionVariants, $data["tempId"]);
                            $this->session->set("productVariants", $sessionVariants);
                        }

                        $this->ProductVariantsModel->insert($data);

                        foreach ($this->session->get("productVariants") as $key => $value) {
                            $variant = $this->ProductVariantsModel->where("tempId", $value)->get()->getRowArray();
                            $size = $this->ProductAttributesVariantsModel->where("id", $variant["size"])->get()->getRow()->name;
                            $color = $this->ProductAttributesVariantsModel->where("id", $variant["color"])->get()->getRow()->name;
                            array_push($productVariants, array("id" => $variant["id"], "tempId" => $variant["tempId"], "productId" => $variant["productId"], "size" => $size, "color" => $color, "quantity" => $variant["quantity"]));
                        }

                        echo json_encode($productVariants);
                    } else if ($param2 == "update") {
                        $id = $this->request->getPost("id");
                        $data["productId"] = $this->session->get("productEditId");
                        $data["quantity"] = $this->request->getPost("quantity");

                        $this->db->table("productvariants")->where("id", $id)->update($data);

                        echo true;
                    } else if ($param2 == "delete") {
                        $productVariants = array();
                        $sessionVariants = array();


                        $deleteVariant = $this->ProductVariantsModel->where("id", $this->request->getPost("id"))->get()->getRowArray();

                        foreach ($this->session->get("productVariants") as $key => $value) {
                            if ($value != $deleteVariant["tempId"]) {
                                $variant = $this->ProductVariantsModel->where("tempId", $value)->get()->getRowArray();
                                $size = $this->ProductAttributesVariantsModel->where("id", $variant["size"])->get()->getRow()->name;
                                $color = $this->ProductAttributesVariantsModel->where("id", $variant["color"])->get()->getRow()->name;
                                array_push($productVariants, array("id" => $variant["id"], "tempId" => $variant["tempId"], "productId" => $variant["productId"], "size" => $size, "color" => $color, "quantity" => $variant["quantity"]));
                                array_push($sessionVariants, $value);

                            }
                        }

                        $this->db->table("productvariants")->where("id", $this->request->getPost("id"))->delete();
                        $this->session->set("productVariants", $sessionVariants);
                        echo json_encode($productVariants);
                    }
                } else {
                    $page_data["products"] = $this->ProductModel->findAll();
                    $view = "admin";
                    $page_data["page_title"] = "Products";
                    $page_data["page_name"] = "products";

                    return view($view . "/index", $page_data);
                }
            } else {
                return redirect()->to(site_url());
            }
        } else {
            return redirect()->to(site_url());
        }
    }

    public function attributes($param1="", $param2="", $param3="")
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "category") {
                    if ($param2 == "add") {
                        $view = "admin";
                        $page_data["page_title"] = "Add Attributes";
                        $page_data["page_name"] = "attributes-add";

                        return view($view . "/index", $page_data);
                    } else if ($param2 == "create") {
                        $data["name"] = $this->request->getPost("name");
                        $data["status"] = (int) $this->request->getPost("status");
                        $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));
                        
                        $this->ProductAttributesCategoryModel->insert($data);
                        return redirect()->to("admin/attributes");
                    } else if ($param2 == "edit") {
                        if ($param3 == "") {
                            return redirect()->to(site_url('admin/attributes'));
                        } else {
                            $page_data["attribute"] = $this->ProductAttributesCategoryModel->where("id", $param3)->get()->getRowArray();
                            $view = "admin";
                            $page_data["page_title"] = "Edit Attribute";
                            $page_data["page_name"] = "attributes-edit";
                            
                            return view($view . "/index", $page_data);
                        }
                    } else if ($param2 == "update") {
                        if ($param3 == "") {
                            return redirect()->to(site_url('admin/attributes'));
                        } else {
                            $data["name"] = $this->request->getPost("name");
                            $data["status"] = (int) $this->request->getPost("status");
                            $data["updatedAt"] = strtotime(date("d-M-Y H:i:s"));
                            
                            $update = $this->db->table("productattributescategory")->where("id", $param3)->update($data);
                            return redirect()->to("admin/attributes");
                        }
                    } else if ($param2 == "delete") {
                        if ($param3 == "") {
                            return redirect()->to(site_url('admin/attributes'));
                        } else {
                            $this->db->table("productattributescategory")->where("id", $param3)->delete();
                            return redirect()->to("admin/attributes");
                        }
                    } else if ($param2 == "get") {
                        $categories = $this->request->getPost("categories");
                        $attributes = array();

                        foreach ($categories as $key => $category) {
                            $variants = $this->db->table("productattributesvariants")->where("category", $category)->get()->getResultArray();
                            // 0 => 1,3
                            // 1 => 2,4,6
                            // 0 => 1 2, 1 4, 1 6, 3 2, 3 4, 3 6
                            array_push($attributes, $variants);
                        }

                        echo json_encode($attributes);
                    }
                    
                } else if ($param1 == "variants") {
                    if ($param2 == "add") {
                        $view = "admin";
                        $page_data["page_title"] = "Add Variants";
                        $page_data["page_name"] = "attributes-variants-add";

                        return view($view . "/index", $page_data);
                    } else if ($param2 == "create") {
                        $data["name"] = $this->request->getPost("name");
                        $data["category"] = (int) $this->request->getPost("category");
                        $data["isColor"] = $this->request->getPost("isColor");
                        $data["colorCode"] = $this->request->getPost("colorCode");
                        $data["status"] = (int) $this->request->getPost("status");
                        $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));
                        
                        $this->ProductAttributesVariantsModel->insert($data);
                        return redirect()->to("admin/attributes");
                    } else if ($param2 == "edit") {
                        if ($param3 == "") {
                            return redirect()->to(site_url('admin/attributes'));
                        } else {
                            $page_data["variant"] = $this->ProductAttributesVariantsModel->where("id", $param3)->get()->getRowArray();
                            $view = "admin";
                            $page_data["page_title"] = "Edit Variant";
                            $page_data["page_name"] = "attributes-variants-edit";

                            return view($view . "/index", $page_data);
                        }
                    } else if ($param2 == "update") {
                        if ($param3 == "") {
                            return redirect()->to(site_url('admin/attributes'));
                        } else {
                            $data["name"] = $this->request->getPost("name");
                            $data["category"] = (int) $this->request->getPost("category");
                            $data["isColor"] = $this->request->getPost("isColor");
                            $data["colorCode"] = $this->request->getPost("colorCode");
                            $data["status"] = (int) $this->request->getPost("status");
                            $data["updatedAt"] = strtotime(date("d-M-Y H:i:s"));

                            $update = $this->db->table("productattributesvariants")->where("id", $param3)->update($data);
                            return redirect()->to("admin/attributes");
                        }
                    } else if ($param2 == "delete") {
                        if ($param3 == "") {
                            return redirect()->to(site_url('admin/attributes'));
                        } else {
                            $this->db->table("productattributesvariants")->where("id", $param3)->delete();
                            return redirect()->to("admin/attributes");
                        }
                    }
                } else {
                    $page_data["attributes"] = $this->ProductAttributesCategoryModel->findAll();
                    $page_data["variants"] = $this->ProductAttributesVariantsModel->findAll();
                    $view = "admin";
                    $page_data["page_title"] = "Attributes";
                    $page_data["page_name"] = "attributes";

                    return view($view . "/index", $page_data);
                }
            } else {
                return redirect()->to(site_url());
            }
        } else {
            return redirect()->to(site_url());
        }
    }

    public function updateAdminProductCountryId()
    {
        $id = $this->request->getPost("id");
        $this->session->set("adminProductCountryId", $id);
        $categories = $this->CategoryModel->where("country", $_SESSION["adminProductCountryId"])->get()->getResultArray();
        echo json_encode($categories);
    }

    public function orders($param1="", $param2="")
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "view") {
                    $page_data["order"] = $this->OrdersModel->where("id", $param2)->get()->getRowArray();
                    $view = "admin";
                    $page_data["page_title"] = "View Order";
                    $page_data["page_name"] = "orders-view";
                    
                    return view($view . "/index", $page_data);
                } else if ($param1 == "update") {
                    $data["orderStatus"] = (int) $this->request->getPost("orderStatus");
                    $data["orderNote"] = $this->request->getPost("orderNote");

                    $update = $this->db->table("orders")->where("id", $param2)->update($data);

                    return redirect()->to(site_url("admin/orders/view/".$param2));
                } else {
                    $page_data["orders"] = $this->OrdersModel->orderBy("id", "DESC")->get()->getResultArray();
                    $view = "admin";
                    $page_data["page_title"] = "Orders";
                    $page_data["page_name"] = "orders";

                    return view($view . "/index", $page_data);
                }
            } else {
                return redirect()->to(site_url());
            }
        } else {
            return redirect()->to(site_url());
        }
    }

    public function reviews($param1="", $param2="")
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "add") {
                    $view = "admin";
                    $page_data["page_title"] = "Add Review";
                    $page_data["page_name"] = "reviews-add";
                    $page_data["users"] = $this->UserModel->where(array("role" => 3))->get()->getResultArray();
                    $page_data["products"] = $this->ProductModel->where(array("status" => 1))->get()->getResultArray();
                    
                    return view($view . "/index", $page_data);
                } else if ($param1 == "create") {
                    $data["userId"] = $this->request->getPost("userId");
                    $data["productId"] = $this->request->getPost("productId");
                    $data["rating"] = $this->request->getPost("rating");
                    $data["review"] = $this->request->getPost("review");
                    $data["status"] = (int) $this->request->getPost("status");
                    $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));

                    $create = $this->ReviewModel->insert($data);
                    return redirect()->to("admin/reviews");
                } else if ($param1 == "edit") {
                    $view = "admin";
                    $page_data["page_title"] = "Edit Review";
                    $page_data["page_name"] = "reviews-edit";
                    $page_data["review"] = $this->ReviewModel->where("id", $param2)->get()->getRowArray();
                    
                    return view($view . "/index", $page_data);
                } else if ($param1 == "update") {
                    $data["rating"] = $this->request->getPost("rating");
                    $data["review"] = $this->request->getPost("review");
                    $data["status"] = (int) $this->request->getPost("status");

                    $update = $this->db->table("productreviews")->where("id", $param2)->update($data);
                    return redirect()->to("admin/reviews");
                } else {
                    $view = "admin";
                    $page_data["page_title"] = "Reviews";
                    $page_data["page_name"] = "reviews";
                    $page_data["reviews"] = $this->ReviewModel->findAll();

                    return view($view . "/index", $page_data);
                }
            } else {
                return redirect()->to(site_url());
            }
        } else {
            return redirect()->to(site_url());
        }
    }

    public function requirements($param1="", $param2="")
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "view") {
                    $view = "admin";
                    $page_data["page_title"] = "View Pre-Orders";
                    $page_data["page_name"] = "requirements-view";
                    $page_data["requirement"] = $this->CustomModel->where("id", $param2)->get()->getRowArray();
                    
                    return view($view . "/index", $page_data);
                } else {
                    $view = "admin";
                    $page_data["page_title"] = "Pre-Orders";
                    $page_data["page_name"] = "requirements";
                    $page_data["requirements"] = $this->CustomModel->findAll();

                    return view($view . "/index", $page_data);
                }
            } else {
                return redirect()->to(site_url());
            }
        } else {
            return redirect()->to(site_url());
        }
    }

    public function users($param1="", $param2="")
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "add") {
                    $view = "admin";
                    $page_data["page_title"] = "Add Users";
                    $page_data["page_name"] = "users-add";
                    
                    return view($view . "/index", $page_data);
                } else if ($param1 == "create") {
                    $data["name"] = $this->request->getPost("name");
                    $data["email"] = $this->request->getPost("email");
                    $data["contact"] = $this->request->getPost("contact");
                    $data["role"] = $this->request->getPost("role");
                    $data["status"] = $this->request->getPost("status");

                    $create = $this->UserModel->insert($data);
                    return redirect()->to("admin/users");
                } else if ($param1 == "edit") {
                    $view = "admin";
                    $page_data["page_title"] = "Edit User";
                    $page_data["page_name"] = "users-edit";
                    $page_data["user"] = $this->UserModel->where("id", $param2)->get()->getRowArray();
                    
                    return view($view . "/index", $page_data);
                } else if ($param1 == "update") {
                    $data["name"] = $this->request->getPost("name");
                    $data["email"] = $this->request->getPost("email");
                    $data["contact"] = $this->request->getPost("contact");
                    $data["role"] = $this->request->getPost("role");
                    $data["status"] = $this->request->getPost("status");

                    if (($_FILES["image"]["name"] != "")) {
                        // Where the file is going to be stored
                        $target_dir = FCPATH . "uploads/users/";
                        $file = $_FILES["image"]["name"];
                        $path = pathinfo($file);
                        $filename = strtotime(date("d-M-Y H:i:s"));
                        $ext = $path["extension"];
                        $temp_name = $_FILES["image"]["tmp_name"];
                        echo $path_filename_ext = $target_dir . $filename . "." . $ext;
 
                        // Check if file already exists
                        if (file_exists($path_filename_ext)) {
                            echo "Sorry, file already exists.";
                            $data["image"] = $this->request->getPost("imageName");
                        } else {
                            move_uploaded_file($temp_name, $path_filename_ext);
                            $data["image"] = $filename . "." . $ext;
                            echo "Congratulations! File Uploaded Successfully.";
                        }
                    } else {
                        $data["image"] = $this->request->getPost("imageName");
                    }
                    
                    $update = $this->db->table("users")->where("id", $param2)->update($data);
                    return redirect()->to("admin/users");
                } else if ($param1 == "delete") {
                    $delete = $this->db->table("users")->where("id", $param2)->delete();
                    return redirect()->to("admin/users");
                } else {
                    $view = "admin";
                    $page_data["page_title"] = "Users";
                    $page_data["page_name"] = "users";
                    $page_data["users"] = $this->UserModel->findAll();
                    
                    return view($view . "/index", $page_data);
                }

            } else {
                return redirect()->to(site_url());
            }
        } else {
            return redirect()->to(site_url());
        }
    }

    public function logo($param1="")
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "header") {
                    if (($_FILES["headerLogo"]["name"] != "")) {
                        // Where the file is going to be stored
                        $target_dir = FCPATH . "uploads/";
                        $file = $_FILES["headerLogo"]["name"];
                        $path = pathinfo($file);
                        $filename = "logo";
                        $ext = "png";
                        $temp_name = $_FILES["headerLogo"]["tmp_name"];
                        $path_filename_ext = $target_dir . $filename . "." . $ext;
 
                        move_uploaded_file($temp_name, $path_filename_ext);
                    } else {
                        $data["image"] = $this->request->getPost("imageName");
                    }

                    return redirect()->to("admin/logo");
                } else if ($param1 == "footer") {
                    if (($_FILES["footerLogo"]["name"] != "")) {
                        // Where the file is going to be stored
                        $target_dir = FCPATH . "uploads/";
                        $file = $_FILES["footerLogo"]["name"];
                        $path = pathinfo($file);
                        $filename = "footer_logo";
                        $ext = "png";
                        $temp_name = $_FILES["footerLogo"]["tmp_name"];
                        $path_filename_ext = $target_dir . $filename . "." . $ext;
 
                        move_uploaded_file($temp_name, $path_filename_ext);
                    } else {
                        $data["image"] = $this->request->getPost("imageName");
                    }

                    return redirect()->to("admin/logo");
                } else if ($param1 == "favicon") {
                    if (($_FILES["favicon"]["name"] != "")) {
                        // Where the file is going to be stored
                        $target_dir = FCPATH . "uploads/";
                        $file = $_FILES["favicon"]["name"];
                        $path = pathinfo($file);
                        $filename = "favicon";
                        $ext = "png";
                        $temp_name = $_FILES["favicon"]["tmp_name"];
                        $path_filename_ext = $target_dir . $filename . "." . $ext;
 
                        move_uploaded_file($temp_name, $path_filename_ext);
                    } else {
                        $data["image"] = $this->request->getPost("imageName");
                    }

                    return redirect()->to("admin/logo");
                } else {
                    $view = "admin";
                    $page_data["page_title"] = "Logo";
                    $page_data["page_name"] = "logo";
                }
            } else {
                return redirect()->to(site_url());
            }
        } else {
            return redirect()->to(site_url());
        }

        return view($view . "/index", $page_data);
    }

    public function socialLinks($param1="")
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "update") {
                    $data["value"] = $this->request->getPost("facebookLink");
                    $this->db->table("settings")->where("key", "facebookLink")->update($data);

                    $data["value"] = $this->request->getPost("twitterLink");
                    $this->db->table("settings")->where("key", "twitterLink")->update($data);

                    $data["value"] = $this->request->getPost("instagramLink");
                    $this->db->table("settings")->where("key", "instagramLink")->update($data);

                    $data["value"] = $this->request->getPost("linkedinLink");
                    $this->db->table("settings")->where("key", "linkedinLink")->update($data);

                    $data["value"] = $this->request->getPost("youtubeLink");
                    $this->db->table("settings")->where("key", "youtubeLink")->update($data);

                    $data["value"] = $this->request->getPost("tiktokLink");
                    $this->db->table("settings")->where("key", "tiktokLink")->update($data);

                    return redirect()->to("admin/social-links");
                } else {
                    $view = "admin";
                    $page_data["page_title"] = "Social Links";
                    $page_data["page_name"] = "social-links";
                }
            } else {
                return redirect()->to(site_url());
            }
        } else {
            return redirect()->to(site_url());
        }

        return view($view . "/index", $page_data);
    }

    public function testimonials($param1="")
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "create") {
                    if (($_FILES["image"]["name"] != "")) {
                        for ($i=0; $i < count($_FILES["image"]["name"]) ; $i++) { 
                            // Where the file is going to be stored
                            $target_dir = FCPATH . "uploads/testimonials/";
                            $file = $_FILES["image"]["name"][$i];
                            $path = pathinfo($file);
                            $filename = strtotime(date("d-M-Y H:i:s")).rand(0, 3000);
                            $ext = $path["extension"];
                            $temp_name = $_FILES["image"]["tmp_name"][$i];
                            $path_filename_ext = $target_dir . $filename . "." . $ext;
     
                            // Check if file already exists
                            if (!file_exists($path_filename_ext)) {
                                move_uploaded_file($temp_name, $path_filename_ext);
                                $image = [
                                    "name" => $filename . "." . $ext,
                                    "order"  => NULL,
                                    "createdAt"  => strtotime(date("d-M-Y H:i:s")),
                                ];

                                $this->TestimonialImageModel->insert($image);
                            }
                        }
                    }

                    return redirect()->to("admin/testimonials");
                } else if ($param1 == "deleteImage") {
                    $id = $this->request->getPost("id");
                    $this->TestimonialImageModel->delete($id);
                    echo true;
                } else if ($param1 == "updateOrder") {
                    $id = $this->request->getPost("id");
                    $data["order"] = $this->request->getPost("order");

                    $this->db->table("testimonialimages")->where("id", $id)->update($data);
                    echo true;
                } else {
                    $view = "admin";
                    $page_data["page_title"] = "Testimonials";
                    $page_data["page_name"] = "testimonials";
                    
                    return view($view . "/index", $page_data);
                }
            } else {
                return redirect()->to(site_url());
            }
        } else {
            return redirect()->to(site_url());
        }

    }

    public function countries($param1="", $param2="")
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "add") {
                    $view = "admin";
                    $page_data["page_title"] = "Add Country";
                    $page_data["page_name"] = "countries-add";
                    
                    return view($view . "/index", $page_data);
                } else if ($param1 == "create") {
                    $data["name"] = $this->request->getPost("name");
                    $data["code"] = $this->request->getPost("code");
                    $data["currency"] = $this->request->getPost("currency");
                    $data["status"] = $this->request->getPost("status");
                    $data["created"] = $this->session->get("userId");

                    $create = $this->CountriesModel->insert($data);
                    return redirect()->to("admin/countries");
                } else if ($param1 == "edit") {
                    $view = "admin";
                    $page_data["page_title"] = "Edit Country";
                    $page_data["page_name"] = "countries-edit";
                    $page_data["country"] = $this->CountriesModel->where("id", $param2)->get()->getRowArray();
                    
                    return view($view . "/index", $page_data);
                } else if ($param1 == "update") {
                    $data["name"] = $this->request->getPost("name");
                    $data["code"] = $this->request->getPost("code");
                    $data["currency"] = $this->request->getPost("currency");
                    $data["status"] = $this->request->getPost("status");

                    $update = $this->db->table("country")->where("id", $param2)->update($data);
                    return redirect()->to("admin/countries");
                } else {
                    $view = "admin";
                    $page_data["page_title"] = "Countries";
                    $page_data["page_name"] = "countries";
                    $page_data["countries"] = $this->CountriesModel->findAll();

                    return view($view . "/index", $page_data);
                }
            } else {
                return redirect()->to(site_url());
            }
        } else {
            return redirect()->to(site_url());
        }
    }

    public function shipping($param1="", $param2="", $param3="")
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "country") {
                    if ($param2 == "add") {
                        $view = "admin";
                        $page_data["page_title"] = "Add Country";
                        $page_data["page_name"] = "shipping-country-add";
                        
                        return view($view . "/index", $page_data);
                    } else if ($param2 == "create") {
                        $data["country"] = $this->request->getPost("country");
                        $data["location"] = $this->request->getPost("location");
                        $data["status"] = $this->request->getPost("status");
                        $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));

                        $create = $this->ShippingCountryModel->insert($data);
                        return redirect()->to("admin/shipping/country");
                    } else if ($param2 == "edit") {
                        $view = "admin";
                        $page_data["page_title"] = "Edit Country";
                        $page_data["page_name"] = "shipping-country-edit";
                        $page_data["country"] = $this->ShippingCountryModel->where("id", $param3)->get()->getRowArray();
                        
                        return view($view . "/index", $page_data);
                    } else if ($param2 == "update") {
                        $data["country"] = $this->request->getPost("country");
                        $data["location"] = $this->request->getPost("location");
                        $data["status"] = $this->request->getPost("status");
                        $data["updatedAt"] = strtotime(date("d-M-Y H:i:s"));

                        $update = $this->db->table("shippingcountry")->where("id", $param3)->update($data);
                        return redirect()->to("admin/shipping/country");
                    } else if ($param2 == "delete") {
                        $delete = $this->db->table("shippingcountry")->where("id", $param3)->delete();
                        return redirect()->to("admin/shipping/country");
                    } else {
                        $view = "admin";
                        $page_data["page_title"] = "Shipping Countries";
                        $page_data["page_name"] = "shipping-country";
                        $page_data["shippingCountry"] = $this->ShippingCountryModel->findAll();

                        return view($view . "/index", $page_data);
                    }
                } else if ($param1 == "price") {
                    if ($param2 == "add") {
                        $view = "admin";
                        $page_data["page_title"] = "Add Shipping";
                        $page_data["page_name"] = "shipping-price-add";
                        
                        return view($view . "/index", $page_data);
                    } else if ($param2 == "create") {
                        $data["name"] = $this->request->getPost("name");
                        $data["location"] = $this->request->getPost("location");
                        $data["country"] = $this->request->getPost("country");
                        $data["minimum"] = $this->request->getPost("minimum");
                        $data["maximum"] = $this->request->getPost("maximum");
                        $data["price"] = $this->request->getPost("price");
                        $data["status"] = $this->request->getPost("status");
                        $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));

                        $create = $this->ShippingModel->insert($data);
                        return redirect()->to("admin/shipping/price");
                    } else if ($param2 == "edit") {
                        $view = "admin";
                        $page_data["page_title"] = "Edit Shipping";
                        $page_data["page_name"] = "shipping-price-edit";
                        $page_data["shipping"] = $this->ShippingModel->where("id", $param3)->get()->getRowArray();
                        
                        return view($view . "/index", $page_data);
                    } else if ($param2 == "update") {
                        $data["name"] = $this->request->getPost("name");
                        $data["country"] = $this->request->getPost("country");
                        $data["minimum"] = $this->request->getPost("minimum");
                        $data["maximum"] = $this->request->getPost("maximum");
                        $data["price"] = $this->request->getPost("price");
                        $data["status"] = $this->request->getPost("status");
                        $data["updatedAt"] = strtotime(date("d-M-Y H:i:s"));

                        $update = $this->db->table("shipping")->where("id", $param3)->update($data);
                        return redirect()->to("admin/shipping/price");
                    } else if ($param2 == "delete") {
                        $delete = $this->db->table("shipping")->where("id", $param3)->delete();
                        return redirect()->to("admin/shipping/price");
                    } else if ($param2 == "countries") {
                        $location = $this->request->getPost("location");

                        $countries = $this->ShippingCountryModel->where(array("location" => $location, "status" => 1))->get()->getResultArray();

                        echo json_encode($countries);
                    } else {
                        $view = "admin";
                        $page_data["page_title"] = "Shipping Price";
                        $page_data["page_name"] = "shipping-price";
                        $page_data["shipping"] = $this->ShippingModel->findAll();
                        $page_data["shippingCountry"] = $this->ShippingCountryModel->findAll();

                        return view($view . "/index", $page_data);
                    }
                } else {
                    $view = "admin";
                    $page_data["page_title"] = "Shipping";
                    $page_data["page_name"] = "shipping";
                    $page_data["shipping"] = $this->ShippingModel->findAll();
                    $page_data["shippingCountry"] = $this->ShippingCountryModel->findAll();

                    return view($view . "/index", $page_data);
                }
            } else {
                return redirect()->to(site_url());
            }
        } else {
            return redirect()->to(site_url());
        }
    }

    public function privacyPolicy($param1="")
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "update") {
                    $data["value"] = base64_encode($this->request->getPost("privacyPolicy"));
                    $this->db->table("settings")->where("key", "privacyPolicy")->update($data);

                    return redirect()->to("admin/privacy-policy");
                } else {
                    $view = "admin";
                    $page_data["page_title"] = "Privacy Policy";
                    $page_data["page_name"] = "privacy-policy";
                }
            } else {
                return redirect()->to(site_url());
            }
        } else {
            return redirect()->to(site_url());
        }

        return view($view . "/index", $page_data);
    }

    public function terms($param1="")
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "update") {
                    $data["value"] = base64_encode($this->request->getPost("terms"));
                    $this->db->table("settings")->where("key", "terms")->update($data);

                    return redirect()->to("admin/terms");
                } else {
                    $view = "admin";
                    $page_data["page_title"] = "Terms";
                    $page_data["page_name"] = "terms";
                }
            } else {
                return redirect()->to(site_url());
            }
        } else {
            return redirect()->to(site_url());
        }

        return view($view . "/index", $page_data);
    }

    public function refundPolicy($param1="")
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "update") {
                    $data["value"] = base64_encode($this->request->getPost("refundPolicy"));
                    $this->db->table("settings")->where("key", "refundPolicy")->update($data);

                    return redirect()->to("admin/refund-policy");
                } else {
                    $view = "admin";
                    $page_data["page_title"] = "Refund Policy";
                    $page_data["page_name"] = "refund-policy";
                }
            } else {
                return redirect()->to(site_url());
            }
        } else {
            return redirect()->to(site_url());
        }

        return view($view . "/index", $page_data);
    }

    function slugify($text) {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        $text = strtolower($text);
        //$text = preg_replace('~[^-\w]+~', "", $text);
        if (empty($text))
        return 'n-a';
        return $text;
    }

    public function testpage()
    {
        $categories = [1,2];
        $attributes = array();
        $arrayMerge = array();

        foreach ($categories as $key => $category) {
            $variants = $this->db->table("productattributesvariants")->where("category", $category)->get()->getResultArray();
            // 0 => 1,3
            // 1 => 2,4
            // 0 => 1 2, 1 4, 3 2, 3 4
            array_push($attributes, $variants);
        }

        // $arr0 = $attributes[0];
        // $arr1 = $attributes[1];

        // for ($i=0; $i < count($arr0); $i++) { 
        //     for ($j=0; $j < count($arr1); $j++) { 
        //         $tempArr = array($arr0[$i], $arr1[$j]);
        //         array_push($arrayMerge, $tempArr);
        //     }
        // }
        echo "<pre>";
        print_r($attributes);
        echo "</pre>";
    }

}

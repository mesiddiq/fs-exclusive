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
                    $view = "admin";
                    $page_data["page_title"] = "Add Products";
                    $page_data["page_name"] = "products-add";
                    $this->session->set("adminProductCountryId", 1);
                    
                    return view($view . "/index", $page_data);
                } else if ($param1 == "create") {
                    $data["name"] = $this->request->getPost("name");
                    $data["slug"] = $this->slugify($this->request->getPost("name"));
                    $data["shortDescription"] = $this->request->getPost("shortDescription");
                    $data["description"] = json_encode($this->request->getPost("description"));
                    $data["category"] = $this->request->getPost("category");
                    $data["country"] = (int) $this->request->getPost("country");
                    $data["isDiscount"] = (int) $this->request->getPost("isDiscount");
                    $data["price"] = $this->request->getPost("price");
                    $data["discountedPrice"] = $this->request->getPost("discountedPrice");
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

                    return redirect()->to("admin/products");
                } else if ($param1 == "edit") {
                    $page_data["product"] = $this->ProductModel->where("id", $param2)->get()->getRowArray();
                    $view = "admin";
                    $page_data["page_title"] = "Edit Product";
                    $page_data["page_name"] = "products-edit";
                    
                    return view($view . "/index", $page_data);
                } else if ($param1 == "update") {
                    $data["name"] = $this->request->getPost("name");
                    $data["slug"] = $this->slugify($this->request->getPost("name"));
                    $data["shortDescription"] = $this->request->getPost("shortDescription");
                    $data["description"] = json_encode($this->request->getPost("description"));
                    $data["category"] = $this->request->getPost("category");
                    // $data["country"] = (int) $this->request->getPost("country");
                    $data["isDiscount"] = (int) $this->request->getPost("isDiscount");
                    $data["price"] = $this->request->getPost("price");
                    $data["discountedPrice"] = $this->request->getPost("discountedPrice");
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
                    $data["status"] = $this->request->getPost("status");
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
                    $data["status"] = $this->request->getPost("status");

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
                    $page_data["page_title"] = "View Requirements";
                    $page_data["page_name"] = "requirements-view";
                    $page_data["requirement"] = $this->CustomModel->where("id", $param2)->get()->getRowArray();
                    
                    return view($view . "/index", $page_data);
                } else {
                    $view = "admin";
                    $page_data["page_title"] = "Requirements";
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
                    $page_data["page_title"] = "Edit Review";
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

    public function privacyPolicy($param1="")
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "update") {
                    $data["value"] = json_encode($this->request->getPost("privacyPolicy"));
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
                    $data["value"] = json_encode($this->request->getPost("terms"));
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
                    $data["value"] = json_encode($this->request->getPost("refundPolicy"));
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

}

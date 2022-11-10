<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\ProductImageModel;
use App\Models\OrdersModel;
use App\Models\CustomModel;
use App\Models\ReviewModel;
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
                $view = "admin";
                $page_data['page_title'] = "Dashboard";
                $page_data['page_name'] = "dashboard";

                return view($view . "/index", $page_data);
            } else {
                return redirect()->to(site_url());
            }
        } else {
            return redirect()->to(site_url());
        }
    }

    public function categories($param1='', $param2='')
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "add") {
                    $view = "admin";
                    $page_data["page_title"] = "Add Category";
                    $page_data["page_name"] = "categories-add";
                    
                    return view($view . "/index", $page_data);
                } elseif ($param1 == "create") {
                    $data["name"] = $this->request->getPost("name");
                    $data["slug"] = $this->slugify($this->request->getPost("name"));
                    $data["parent"] = $this->request->getPost("parent");
                    $data["status"] = $this->request->getPost("status");
                    $data["author"] = (int) $this->session->get("userId");
                    $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));

                    if (($_FILES['image']['name']!="")) {
                        // Where the file is going to be stored
                        $target_dir = FCPATH . "uploads/category/";
                        $file = $_FILES['image']['name'];
                        $path = pathinfo($file);
                        $filename = strtotime(date("d-M-Y H:i:s")).rand(0, 3000);
                        $ext = $path['extension'];
                        $temp_name = $_FILES['image']['tmp_name'];
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
                } elseif ($param1 == "edit") {
                    $page_data["category"] = $this->CategoryModel->where('id', $param2)->get()->getRowArray();
                    $view = "admin";
                    $page_data["page_title"] = "Edit Category";
                    $page_data["page_name"] = "categories-edit";
                    
                    return view($view . "/index", $page_data);
                } elseif ($param1 == "update") {
                    $data["name"] = $this->request->getPost("name");
                    $data["slug"] = $this->slugify($this->request->getPost("name"));
                    $data["parent"] = $this->request->getPost("parent");
                    $data["status"] = $this->request->getPost("status");
                    $data["updatedAt"] = strtotime(date("d-M-Y H:i:s"));

                    if (($_FILES['image']['name'] != "")) {
                        // Where the file is going to be stored
                        $target_dir = FCPATH . "uploads/category/";
                        $file = $_FILES['image']['name'];
                        $path = pathinfo($file);
                        $filename = strtotime(date("d-M-Y H:i:s")).rand(0, 3000);
                        $ext = $path['extension'];
                        $temp_name = $_FILES['image']['tmp_name'];
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
                    $update = $this->db->table('category')->where('id', $param2)->update($data);
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

    public function products($param1='', $param2='')
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "add") {
                    $view = "admin";
                    $page_data["page_title"] = "Add Products";
                    $page_data["page_name"] = "products-add";
                    $this->session->set("adminProductCountryId", 1);
                    
                    return view($view . "/index", $page_data);
                } elseif ($param1 == "create") {
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
                    $data["status"] = (int) $this->request->getPost("status");
                    $data["author"] = (int) $this->session->get("userId");
                    $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));

                    if (($_FILES['image']['name'] != "")) {
                        for ($i=0; $i < count($_FILES['image']['name']) ; $i++) { 
                            // Where the file is going to be stored
                            $target_dir = FCPATH . "uploads/products/";
                            $file = $_FILES['image']['name'][$i];
                            $path = pathinfo($file);
                            $filename = strtotime(date("d-M-Y H:i:s")).rand(0, 3000);
                            $ext = $path['extension'];
                            $temp_name = $_FILES['image']['tmp_name'][$i];
                            $path_filename_ext = $target_dir . $filename . "." . $ext;
     
                            // Check if file already exists
                            if (!file_exists($path_filename_ext)) {
                                move_uploaded_file($temp_name, $path_filename_ext);
                                $image = [
                                    'name' => $filename . "." . $ext,
                                    'productId'  => $param2,
                                    'createdAt'  => strtotime(date("d-M-Y H:i:s")),
                                ];
                                $this->ProductImageModel->insert($image);
                                echo "Congratulations! File Uploaded Successfully.";
                            }
                        }
                    }

                    $create = $this->ProductModel->insert($data);
                    return redirect()->to("admin/products");
                } elseif ($param1 == "edit") {
                    $page_data["product"] = $this->ProductModel->where('id', $param2)->get()->getRowArray();
                    $view = "admin";
                    $page_data["page_title"] = "Edit Product";
                    $page_data["page_name"] = "products-edit";
                    
                    return view($view . "/index", $page_data);
                } elseif ($param1 == "update") {
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
                    $data["status"] = (int) $this->request->getPost("status");
                    $data["updatedAt"] = strtotime(date("d-M-Y H:i:s"));

                    if (($_FILES['image']['name'][0] != "")) {
                        for ($i=0; $i < count($_FILES['image']['name']) ; $i++) { 
                            // Where the file is going to be stored
                            $target_dir = FCPATH . "uploads/products/";
                            $file = $_FILES['image']['name'][$i];
                            $path = pathinfo($file);
                            $filename = strtotime(date("d-M-Y H:i:s")).rand(0, 3000);
                            $ext = $path['extension'];
                            $temp_name = $_FILES['image']['tmp_name'][$i];
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
                                echo "Congratulations! File Uploaded Successfully.";
                            }
                        }
                    }
                    
                    $update = $this->db->table("products")->where("id", $param2)->update($data);
                    return redirect()->to("admin/products");
                } elseif ($param1 == "delete") {
                    $delete = $this->db->table("products")->where("id", $param2)->delete();
                    return redirect()->to("admin/products");
                } elseif ($param1 == "setImageFeatured") {
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
                } elseif ($param1 == "deleteImage") {
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
        $categories = $this->CategoryModel->where("id", $_SESSION["adminProductCountryId"])->get()->getResultArray();
        echo json_encode($categories);
    }

    public function orders($param1='', $param2='')
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "view") {
                    $page_data["order"] = $this->OrdersModel->where('id', $param2)->get()->getRowArray();
                    $view = "admin";
                    $page_data["page_title"] = "View Order";
                    $page_data["page_name"] = "orders-view";
                    
                    return view($view . "/index", $page_data);
                } else {
                    $page_data["orders"] = $this->OrdersModel->findAll();
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

    public function reviews($param1='', $param2='')
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
                } elseif ($param1 == "create") {
                    $data["userId"] = $this->request->getPost("userId");
                    $data["productId"] = $this->request->getPost("productId");
                    $data["rating"] = $this->request->getPost("rating");
                    $data["review"] = $this->request->getPost("review");
                    $data["status"] = $this->request->getPost("status");
                    $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));

                    $create = $this->ReviewModel->insert($data);
                    return redirect()->to("admin/reviews");
                } elseif ($param1 == "edit") {
                    $view = "admin";
                    $page_data["page_title"] = "Edit Review";
                    $page_data["page_name"] = "reviews-edit";
                    $page_data["review"] = $this->ReviewModel->where('id', $param2)->get()->getRowArray();
                    
                    return view($view . "/index", $page_data);
                } elseif ($param1 == "update") {
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

    public function requirements($param1='', $param2='')
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "view") {
                    $view = "admin";
                    $page_data["page_title"] = "View Requirements";
                    $page_data["page_name"] = "requirements-view";
                    $page_data["requirement"] = $this->CustomModel->where('id', $param2)->get()->getRowArray();
                    
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

    public function users($param1='', $param2='')
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "add") {
                    $view = "admin";
                    $page_data["page_title"] = "Add Users";
                    $page_data["page_name"] = "users-add";
                    
                    return view($view . "/index", $page_data);
                } elseif ($param1 == "create") {
                    $data["name"] = $this->request->getPost("name");
                    $data["email"] = $this->request->getPost("email");
                    $data["contact"] = $this->request->getPost("contact");
                    $data["role"] = $this->request->getPost("role");
                    $data["status"] = $this->request->getPost("status");

                    $create = $this->UserModel->insert($data);
                    return redirect()->to("admin/users");
                } elseif ($param1 == "edit") {
                    $view = "admin";
                    $page_data["page_title"] = "Edit User";
                    $page_data["page_name"] = "users-edit";
                    $page_data["user"] = $this->UserModel->where('id', $param2)->get()->getRowArray();
                    
                    return view($view . "/index", $page_data);
                } elseif ($param1 == "update") {
                    $data["name"] = $this->request->getPost("name");
                    $data["email"] = $this->request->getPost("email");
                    $data["contact"] = $this->request->getPost("contact");
                    $data["role"] = $this->request->getPost("role");
                    $data["status"] = $this->request->getPost("status");

                    if (($_FILES['image']['name'] != "")) {
                        // Where the file is going to be stored
                        $target_dir = FCPATH . "uploads/users/";
                        $file = $_FILES['image']['name'];
                        $path = pathinfo($file);
                        $filename = strtotime(date("d-M-Y H:i:s"));
                        $ext = $path['extension'];
                        $temp_name = $_FILES['image']['tmp_name'];
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
                    
                    $update = $this->db->table('users')->where('id', $param2)->update($data);
                    return redirect()->to("admin/users");
                } elseif ($param1 == "delete") {
                    $delete = $this->db->table('users')->where('id', $param2)->delete();
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

    public function countries($param1='', $param2='')
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                if ($param1 == "add") {
                    $view = "admin";
                    $page_data["page_title"] = "Add Country";
                    $page_data["page_name"] = "countries-add";
                    
                    return view($view . "/index", $page_data);
                } elseif ($param1 == "create") {
                    $data["name"] = $this->request->getPost("name");
                    $data["code"] = $this->request->getPost("code");
                    $data["currency"] = $this->request->getPost("currency");
                    $data["status"] = $this->request->getPost("status");
                    $data["created"] = $this->session->get("userId");

                    $create = $this->CountriesModel->insert($data);
                    return redirect()->to("admin/countries");
                } elseif ($param1 == "edit") {
                    $view = "admin";
                    $page_data["page_title"] = "Edit Review";
                    $page_data["page_name"] = "countries-edit";
                    $page_data["country"] = $this->CountriesModel->where('id', $param2)->get()->getRowArray();
                    
                    return view($view . "/index", $page_data);
                } elseif ($param1 == "update") {
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

    function slugify($text) {
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        $text = trim($text, '-');
        $text = strtolower($text);
        //$text = preg_replace('~[^-\w]+~', '', $text);
        if (empty($text))
        return 'n-a';
        return $text;
    }

}

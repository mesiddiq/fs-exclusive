<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CategoryModel;

class Admin extends BaseController
{

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->CategoryModel = new CategoryModel();
    }

    public function index()
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                return redirect()->to("admin/dashboard");
            } else {
                return redirect()->to("admin/login");
            }
        } else {
            return redirect()->to("admin/login");
        }
    }

    public function login()
    {
        if ($this->session->get("logged_in") == true) {
            if ($this->session->get("userRole") === "1") {
                return redirect()->to("admin/dashboard");
            } else {
                return view("admin/login");
            }
        } else {
            return view("admin/login");
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
                return redirect()->to("admin/login");
            }
        } else {
            return redirect()->to("admin/login");
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
                    $data["parent"] = $this->request->getPost("parent");
                    $data["status"] = $this->request->getPost("status");
                    $data["author"] = (int) $this->session->get("userId");
                    $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));

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
                    $data["parent"] = $this->request->getPost("parent");
                    $data["status"] = $this->request->getPost("status");
                    $data["updatedAt"] = strtotime(date("d-M-Y H:i:s"));
                    
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
                return redirect()->to("admin/login");
            }
        } else {
            return redirect()->to("admin/login");
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
                    $data["parent"] = $this->request->getPost("parent");
                    $data["status"] = $this->request->getPost("status");
                    $data["author"] = (int) $this->session->get("userId");
                    $data["createdAt"] = strtotime(date("d-M-Y H:i:s"));

                    $create = $this->UserModel->insert($data);
                    return redirect()->to("admin/users");
                } elseif ($param1 == "edit") {
                    $page_data["user"] = $this->UserModel->where('id', $param2)->get()->getRowArray();
                    $view = "admin";
                    $page_data["page_title"] = "Edit User";
                    $page_data["page_name"] = "users-edit";
                    
                    return view($view . "/index", $page_data);
                } elseif ($param1 == "update") {
                    $data["name"] = $this->request->getPost("name");
                    $data["email"] = $this->request->getPost("email");
                    $data["contact"] = $this->request->getPost("contact");
                    $data["role"] = $this->request->getPost("role");
                    
                    $update = $this->db->table('users')->where('id', $param2)->update($data);
                    return redirect()->to("admin/users");
                } else {
                    $page_data["users"] = $this->UserModel->findAll();
                    $view = "admin";
                    $page_data["page_title"] = "Users";
                    $page_data["page_name"] = "users";
                    
                    return view($view . "/index", $page_data);
                }

            } else {
                return redirect()->to("admin/login");
            }
        } else {
            return redirect()->to("admin/login");
        }
    }

}

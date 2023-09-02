<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table      = "category";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType     = "array";
    protected $allowedFields = ["name", "slug", "description", "image", "parent", "country", "status", "author", "createdAt", "updatedAt"];


    public function getCategoryIDs($slug = "", $countryId = "")
    {
        $categoryIDs = array();
        if (strpos($slug, ',') > 1) {
            $slugArr = explode(',', $slug);
            foreach ($slugArr as $key => $slug) {
                $category = $this->db->table("category")->where(array('slug' => $slug, 'country' => $countryId))->get()->getRowArray();
                if (!in_array($category['id'], $categoryIDs)) {
                    array_push($categoryIDs, $category);
                }
            }
        } else {
            $category = $this->db->table("category")->where(array('slug' => $slug, 'country' => $countryId))->get()->getRowArray();
            array_push($categoryIDs, $category);
        }
    
        return $categoryIDs;
    }

}
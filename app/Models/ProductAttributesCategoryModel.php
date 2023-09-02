<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductAttributesCategoryModel extends Model
{
    protected $table      = "productattributescategory";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType     = "array";
    protected $allowedFields = ["name", "status", "createdAt", "updatedAt"];

}
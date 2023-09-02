<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = "products";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType     = "array";
    protected $allowedFields = ["name", "slug", "shortDescription", "description", "type", "category", "subCategory", "country", "isDiscount", "price", "discountedPrice", "quantity", "isOutOfStock", "isTopProduct", "weight", "sizeChart", "status", "author", "createdAt", "updatedAt"];

}
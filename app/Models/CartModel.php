<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table      = "cart";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType     = "array";
    protected $allowedFields = ["tempId", "userId", "productId", "productType", "productSize", "productColor", "productQty", "productPrice", "country", "createdAt"];

}
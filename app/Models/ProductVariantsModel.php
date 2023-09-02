<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductVariantsModel extends Model
{
    protected $table      = "productvariants";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType     = "array";
    protected $allowedFields = ["tempId", "productId", "size", "color", "quantity", "isOutOfStock", "createdAt", "updatedAt"];

}
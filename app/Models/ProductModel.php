<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table      = 'products';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $allowedFields = ['name', 'shortDescription', 'description', 'category', 'subCategory', 'country', 'isDiscount', 'price', 'discountedPrice', 'images', 'status', 'author', 'createdAt', 'updatedAt'];

}
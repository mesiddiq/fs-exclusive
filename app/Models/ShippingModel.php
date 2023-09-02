<?php

namespace App\Models;

use CodeIgniter\Model;

class ShippingModel extends Model
{
    protected $table      = "shipping";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType     = "array";
    protected $allowedFields = ["name", "country", "location", "minimum", "maximum", "price", "status", "createdAt", "updatedAt"];

}
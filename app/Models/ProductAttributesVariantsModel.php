<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductAttributesVariantsModel extends Model
{
    protected $table      = "productattributesvariants";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType     = "array";
    protected $allowedFields = ["name", "category", "isColor", "colorCode", "status", "createdAt", "updatedAt"];

}
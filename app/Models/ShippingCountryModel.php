<?php

namespace App\Models;

use CodeIgniter\Model;

class ShippingCountryModel extends Model
{
    protected $table      = "shippingcountry";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType     = "array";
    protected $allowedFields = ["country", "location", "status", "createdAt", "updatedAt"];

}
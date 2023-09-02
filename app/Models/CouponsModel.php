<?php

namespace App\Models;

use CodeIgniter\Model;

class CouponsModel extends Model
{
    protected $table      = "coupons";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType     = "array";
    protected $allowedFields = ["userId", "code", "type", "value", "country", "product", "expiry", "count", "status", "createdAt", "updatedAt"];

}
<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomModel extends Model
{
    protected $table      = "customproduct";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType     = "array";
    protected $allowedFields = ["name", "email", "contact", "contact2", "address", "address2", "city", "state", "country", "zipcode", "url", "images", "createdAt"];

}
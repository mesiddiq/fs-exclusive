<?php

namespace App\Models;

use CodeIgniter\Model;

class TestimonialImageModel extends Model
{
    protected $table      = "testimonialimages";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType     = "array";
    protected $allowedFields = ["name", "order", "createdAt"];

}
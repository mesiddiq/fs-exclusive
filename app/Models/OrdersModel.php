<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table      = "orders";
    protected $primaryKey = "id";
    protected $useAutoIncrement = true;
    protected $returnType     = "array";
    protected $allowedFields = ["userId", "addressId", "products", "subtotal", "shipping", "coupon", "discount", "total", "country", "paymentMethod", "paymentStatus", "paymentBillId", "paymentOrderId", "paymentTransactionId", "orderStatus", "userEmail", "adminEmail", "createdAt"];

}
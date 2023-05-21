<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThanhToanMomo extends Model
{
    use HasFactory;
    protected $fillable=[
    "orderId",
    "requestId",
    "amount",
    "orderInfo",
    "orderType",
    "transId",
    "resultCode",
    "message",
    "payType",
    "responseTime",
    "extraData",
    "signature"];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function paymethod_name(){
        return $this->belongsTo(PaymentGateway::class, 'payment_id');
    }

}
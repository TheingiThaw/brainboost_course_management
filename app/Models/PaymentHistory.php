<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    //
    protected $fillable = [
        'user_name',
        'phone',
        'address',
        'payment_method',
        'enrol_code',
        'payslip_image',
        'total_amt'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractPayment extends Model
{
    protected $table = 'tbl_payments';
    protected $fillable = [
        'contract_id',
        'payment_date',
        'payment_amount',
        'remarks',
        'created_by'
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ContractPayment;

class Contract extends Model
{
    protected $table = 'tbl_contracts';

    protected $primaryKey = 'contract_id';

    public $timestamps = false;

    protected $guarded = [];

    public function payments(){
        return $this -> hasMany(ContractPayment::class, 'contract_id', 'contract_id');
    }

    public function getTotalPayment()
    {
        return $this->payments()->whereNotNull('payment_date')->sum('payment_amount');
    }

    public function getBalance()
    {
        return $this->contract_value - $this->total_paid;
    }
}



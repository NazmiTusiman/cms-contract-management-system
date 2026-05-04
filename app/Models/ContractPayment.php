<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractPayment extends Model
{
    protected $table = 'tbl_payments';
    protected $fillable = [
        'contract_id',
        'payment_name',
        'payment_date',
        'payment_amount',
        'payment_due',
        'invoice',
        'remarks',
        'created_by'
    ];

    public function getstatusAttribute()
    {
        if($this->payment_date){
            return $this->payment_date <= $this->payment_due ? 'Paid' : 'Late';
        }

        return now()->get($this->payment_due) ? 'Overdue' : 'Pending';
    }

    public function contract(){
        return $this->belongsTo(Contract::class);
    }

}
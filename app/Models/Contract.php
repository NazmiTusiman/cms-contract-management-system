<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'tbl_contracts';

    protected $primaryKey = 'contract_id';

    public $timestamps = false;

    protected $guarded = [];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReqRegis extends Model
{
    protected $table = 'tbl_reqregis';
    protected $primaryKey = 'reqregis_id';

    protected $fillable = [
        'full_name',
        'username',
        'mykad',
        'email',
        'num_phone',
        'type',
        'request_status',
        'division_id',
        'branch_id',
        'remarks',
    ];
}

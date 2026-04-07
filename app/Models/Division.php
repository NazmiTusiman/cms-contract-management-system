<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $table = 'tbl_division';
    protected $primaryKey = 'division_id';

    public $timestamps = false;
}

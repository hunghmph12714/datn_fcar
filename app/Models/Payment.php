<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = "payments";
    // protected $dates = ['deleted_at'];
    public $fillable = ['bill_code', 'user_id', 'money', 'note', 'vnp_response_code', 'code_vnp', 'code_bank', 'time'];

}

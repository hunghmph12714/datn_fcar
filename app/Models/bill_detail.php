<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bill_detail extends Model
{
    use HasFactory;
    protected $table = 'billdetail';
    public $fillable = ['product_id', 'quaty', 'bill_id', 'component_id', 'nhap', 'ban', 'bill_code', 'description'];

    public function list_bill()
    {
        return $this->hasOne(list_bill::class, 'code', 'bill_code');
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
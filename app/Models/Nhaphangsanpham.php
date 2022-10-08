<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhaphangsanpham extends Model
{
    use HasFactory;
    
    protected $table = "nhap_hang_sp";
    public $fillable = ['name','qty'];
    public function importProduct()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "products";
    protected $dates = ['deleted_at'];
    public $fillable = ['name', 'image','desc_short', 'import_price', 'price', 'qty', 'desc', 'status', 'companyCar_id', 'insurance','ram','cpu','cardgraphic','screen','harddrive','slug'];
    public function companyCar()
    {
        return $this->belongsTo(CarCompany::class, 'companyCar_id');
    }
    public function nhaphangsanpham()
    {
        return $this->hasMany(Nhaphangsanpham::class, 'product_id');
    }
    public function categories()
    {
        return $this->belongsToMany(AttributeValue::class, 'attribute_value','product_id','category_id');
    }

    public function bill()
    {
        return $this->hasMany(BillDetail::class, 'product_id');
    }
    public function bill_detail()
    {
        return $this->hasOne(bill_detail::class);
    }

    public function image_product()
    {
        return $this->hasMany(ImageProduct::class,'product_id','id');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BillDetail extends Model
{
    use HasFactory;

    protected $table = "bill_details";
    public $fillable = ['product_id', 'qty', 'price', 'bill_code'];

    public function bill()
    {
        return $this->belongsTo(Bill::class, 'bill_code');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // public function bill_user(){
    //     $bill=DB::table('products')
    //     ->join('bill_details','bill_details.product_id','=','products.id')
    //     ->join('bills','bill_details.bill_code','=','bills.code')
    //     ->join('users','bills.user_id','=','users.id')
    //     ->select('users.name')
    //     ->get();
    //     return $bill;
    // }
}

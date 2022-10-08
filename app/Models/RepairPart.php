<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RepairPart extends Model
{
    use HasFactory;
    protected $table = 'repair_parts';
    public $fillable = ['booking_detail_id', 'detail_product_id', 'unit_price', 'quantity', 'into_money', 'sale', 'insurance', 'warranty_period', 'created_at', 'name_product', 'component_id', 'updated_at'];

    /**
     * Get the user associated with the RepairPart
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function component()
    {
        return $this->hasOne(Component::class, 'id', 'component_id');
    }

    /**
     * Get the booking_Detail that owns the RepairPart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function booking_detail()
    {
        return $this->belongsTo(BookingDetail::class, 'booking_detail_id');
    }
}
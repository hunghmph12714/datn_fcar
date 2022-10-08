<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class list_bill extends Model
{
    use HasFactory;
    protected $table = 'list_bill';
    public $fillable = ['user_id', 'booking_detail_id', 'status', 'type', 'total_price', 'date', 'customers_pay', 'excess_cash', 'debt', 'code', 'method', 'codebill'];
    public function bill()
    {
        return $this->hasMany(bill_detail::class, 'bill_id', 'id');
    }
    // public function booking()
    // {
    //     return $this->hasOne(Booking::class, 'booking_detail_id', 'booking_detail_id');
    // }

    public function booking()
    {
        return $this->belongsToMany(Booking::class, 'booking_details', 'booking_detail_id', 'booking_id');
    }
    /**
     * Get the booking_detail associated with the Bill
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function booking_detail()
    {
        return $this->hasOne(BookingDetail::class, 'id', 'booking_detail_id');
    }
    /**
     * Get the component that owns the list_bill
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function component()
    {
        return $this->belongsTo(Component::class, 'id', 'component_id');
    }

    public function bill_user()
    {
        return $this->hasOne(BillUser::class, 'code', 'bill_code');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

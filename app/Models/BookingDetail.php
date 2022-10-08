<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;
    protected $table = "booking_details";
    public $fillable = ["booking_id", 'company_car_id', 'expected_cost', 'repair', 'repair_type', 'description', 'start_time', 'finish_time', 'active', 'name_car', 'comment', 'status_repair', 'status_booking'];
    public function carCompany()
    {
        return $this->belongsTo(CarCompany::class, 'company_car_id', 'id');
    }
    public function booking()
    {
        return $this->hasOne(Booking::class, 'id', 'booking_id');
    }
    /**
     * Get the list_bill associated with the BookingDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function list_bill()
    {
        return $this->hasOne(list_bill::class, 'booking_detail_id', 'id');
    }
    /**
     * The roles that belong to the BookingDetail
     *
     */
    public function user_repair()
    {
        return $this->hasOne(UserRepair::class, 'booking_detail_id');
    }
    /**
     * The users that belong to the BookingDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_repairs', 'booking_detail_id', 'user_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRepair extends Model
{
    use HasFactory;
    protected $table = "user_repairs";
    public $fillable = ['user_id', 'booking_id', 'status', 'desc', 'booking_detail_id'];
    /**
     * Get the repair associated with the UserRepair
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    // public function repair()
    // {
    //     return $this->hasOne(User::class, 'foreign_key', 'local_key');
    // }
}
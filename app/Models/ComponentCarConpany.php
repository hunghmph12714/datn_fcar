<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComponentCarConpany extends Model
{
    use HasFactory;
    protected $table = 'component_car_conpanies';
    public $fillable = ['component_id', 'car_conpany_id', 'active'];
}

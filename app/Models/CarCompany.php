<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarCompany extends Model
{
    use HasFactory;
    public $table = 'car_companies';
    public $fillable = ['company_name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    /**
     * The roles that belong to the ComputerCompany
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function component()
    {
        return $this->belongsToMany(Component::class, 'component_car_conpanies', 'car_conpany_id', 'component_id');
    }
}
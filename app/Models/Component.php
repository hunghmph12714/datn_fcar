<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;
    protected $table = 'components';
    public $fillable = ['name_component', 'image', 'price', 'desc', 'qty', 'status', 'import_price', 'insurance', 'category_component_id'];
    /**
     * The computer_companies that belong to the Component
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function car_companies()
    {
        return $this->belongsToMany(CarCompany::class, 'component_car_conpanies', 'component_id', 'car_conpany_id');
    }
}

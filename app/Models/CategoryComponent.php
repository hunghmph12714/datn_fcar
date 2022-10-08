<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryComponent extends Model
{
    use HasFactory;
    protected $table = 'category_components';
    public $fillable = ['name_category'];
}

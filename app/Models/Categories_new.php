<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories_new extends Model
{
    use HasFactory;
    protected $table="categories_news";
    public $fillable = ['name','quantity_news'];
    
    public function news(){
        return $this->hasMany(News::class, 'category_news_id');
    }
}
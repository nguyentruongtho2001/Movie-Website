<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public $timestamps = false;
    use HasFactory;
    public function showCategory(){
        return $this->belongsTo(Category::class,'category_id');
    }
    public function showGenre(){
        return $this->belongsTo(Genre::class,'genre_id');
    }
    public function showCountry(){
        return $this->belongsTo(Country::class,'country_id');
    }
}

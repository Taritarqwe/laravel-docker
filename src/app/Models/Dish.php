<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    public function ingredients(){
        return $this->belongsToMany(
            Ingredient::class,
            'dish_ingredient', 
            'id_dish',        
            'id_ingredient'
        );
    }
    public function user(){
        return $this->belongsTo(User::class, 'userID', 'id');
    }
}

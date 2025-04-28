<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cuisine_Type extends Model
{
    /** @use HasFactory<\Database\Factories\CuisineTypeFactory> */
    use HasFactory;

    protected $table = 'cuisine_types';

    protected $fillable = ['name', 'description'];

    public function recipes() : HasMany {
        return $this->hasMany(Recipe::class , 'cuisine_type_id');
    }

}

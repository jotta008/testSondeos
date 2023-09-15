<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Genders;

class Books extends Model
{
    use HasFactory;
    protected $guarded = [];    
    public function getGender (){
        return $this->hasOne(Genders::class, 'id', 'gender_id');
    }
}

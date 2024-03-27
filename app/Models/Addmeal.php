<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addmeal extends Model
{
    use HasFactory;

    public function Users()
    {
        return $this->belongstoMany(User::class,'addmeal_users','user_id','meal_id');
    }
}

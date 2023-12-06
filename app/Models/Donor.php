<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contact_information'];
    
    public function foodItems()
    {
        return $this->hasMany(FoodItem::class);
    }
    public function donatedItems()
    {
        return $this->hasMany(FoodItem::class, 'donor_id');
    }
    
}

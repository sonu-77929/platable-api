<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'contact_information'];
    
    public function foodItems()
    {
        return $this->hasMany(FoodItem::class);
    }
    public function receivedItems()
    {
        return $this->hasMany(FoodItem::class, 'recipient_id');
    }
}

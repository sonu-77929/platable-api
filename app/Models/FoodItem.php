<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'expiry_date', 'quantity', 'donor_id', 'recipient_id'];

    /**
     * Get the recipient associated with the food item.
     */
    public function recipient()
    {
        return $this->belongsTo(Recipient::class, 'recipient_id', 'id');
    }

    /**
     * Get the donor associated with the food item.
     */
    public function donor()
    {
        return $this->belongsTo(Donor::class, 'donor_id', 'id');
    }
}

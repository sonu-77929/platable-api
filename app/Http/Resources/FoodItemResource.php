<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'expiry_date' => $this->expiry_date,
            'quantity' => $this->quantity,
            'donor_id' => $this->donor_id,
            'donor' => new DonorResource($this->whenLoaded('donor')),
            'recipient' => new RecipientResource($this->whenLoaded('recipient')),
            'recipient_name' => $this->recipient->name,
        ];
    }
}

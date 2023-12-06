<?php

// app/Http/Resources/DonorResource.php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DonorResource extends JsonResource
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
            // Include any other fields you want to expose
        ];
    }
}



<?php

namespace App\Http\Resources\Receptionist;

use App\Http\Resources\TableSeatResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'location'      => $this->location,
            'max_capacity'  => $this->capacity,
            'status'        => $this->status,
            'seats'         => $this->seats ? TableSeatResource::collection($this->seats) : null,
        ];
    }
}

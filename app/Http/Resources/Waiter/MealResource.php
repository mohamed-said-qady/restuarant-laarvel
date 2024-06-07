<?php

namespace App\Http\Resources\Waiter;

use App\Http\Resources\TableSeatResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'seat'  => new TableSeatResource($this->seat),
            'items' => $this->items ? MealItemResource::collection($this->items) : null
        ];
    }
}

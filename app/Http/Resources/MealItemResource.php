<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MealItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
        'meal_id'           => $this->meal_id,
        'quantity'          => $this->quantity,
        'menu_item_id'      => $this->menu_item_id,
        ];
    }
}

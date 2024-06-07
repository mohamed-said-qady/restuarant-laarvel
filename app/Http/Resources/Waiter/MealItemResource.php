<?php

namespace App\Http\Resources\Waiter;

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
            'id'            => $this->id,
            'menu_item'     => [
                'id'            => $this->menuItem->id,
                'title'         => $this->menuItem->title,
                'descrition'    => $this->menuItem->description,
                'price'         => $this->menuItem->price,
                'image'         => asset('app/items/'.$this->menuItem->image),
            ],
            'quantity'      => $this->quantity
        ];
    }
}

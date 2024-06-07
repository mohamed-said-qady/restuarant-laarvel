<?php

namespace App\Http\Resources\Waiter;

use App\Http\Resources\Receptionist\TableResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'status'    => $this->status,
            'meals'     => MealResource::collection($this->meals),
            'table'     => new TableResource($this->table),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
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
            'title'         => $this->title,
            'descrition'    => $this->description,
            'price'         => $this->price,
            'image'         => asset('app/items/'.$this->image),
            'section'       => new MenuSectionResource($this->section),
        ];
    }
}

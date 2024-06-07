<?php

namespace App\Http\Resources;

use App\Http\Resources\Receptionist\TableResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'reservation_time'  => $this->reservation_time,
            'people_count'      => $this->people_count,
            'note'              => $this->note,
            'status'            => $this->status,
            'checkin_time'      => $this->checkin_time,
            'customer'          => new CustomerResource($this->customer),
            'table'             => TableResource::collection($this->tables)
        ];
    }
}

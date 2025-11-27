<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        
        return [

            "food" => $this->menuitem->name,
            "price" => $this->menuitem->price,
            "category" => $this->menuitem->category->name,
            "date" => $this->date,
            "time" => $this->time,
            "total" => $this->totalrevenue
        ];
    }
}

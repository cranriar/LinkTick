<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => [
                'id' => $this->id()->value(),
                'description' => $this->description()->value(),
                'discount' => $this->discount()->value(),
                'name' => $this->name()->value(),
                'price' => $this->price()->value(),
                'sku' => $this->sku()->value(),
                'status' => $this->status()->value(),
                'stock' => $this->stock()->value(),
            ]
        ];
    }
}

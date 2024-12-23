<?php

namespace App\Http\Resources;

use App\Models\furniture;
use App\Models\RealEstate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class Adresource extends  JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    private function getType($item)
    {
        if ($item ==  RealEstate::class) {
            return "realestate";
        }
        if ($item ==  furniture::class) {
            return "furniture";
        }
    }
    public function toArray(Request $request): array
    {

        return [
            'id' => (int) $this->id,
            'type' => $this->getType($this->item_type),
            'description' => $this->description,
            'price' => $this->price,
            'medias' => $this->medias()->count(),
            'ad_type' => $this->ad_type,
            'period' => $this->period,
            'devise' => $this->devise,
            'category' => new CategoryResource($this->category),
            'creation_date' => $this->created_at,
            'liked' => true
        ];
    }
}

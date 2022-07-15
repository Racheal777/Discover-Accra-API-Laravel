<?php

namespace App\Http\Resources;

use App\Models\Review;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'website' => $this->website,
            'location' => $this->location,
            'about' => $this->about,
            'amenities' => $this->amenities,
            'profile image' =>$this->profileimage,
            'hotel images' =>$this->hotelimages,
            'reviews' => new ReviewCollection($this->reviews)

        ];
    }
}

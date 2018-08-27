<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Shop extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'phone'     => $this->phone,
            'address'   => $this->address,
            'ward'      => $this->ward,
            'district'  => $this->district,
            'city'      => $this->city,
            'lat'       => $this->lat,
            'lng'       => $this->lng,
            'image'     => $this->image,
            'type'      => $this->company->type,
            'openTime'  => json_decode($this->openTime),
            'creditCard'=> $this->creditCard,
            'wifi'      => $this->wifi
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Promotion extends JsonResource
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
            "id"=> $this->id,
            "name"=> $this->name,
            "url"=> $this->url,
            "image"=> $this->image,
            "startDate"=> $this->startDate,
            "endDate"=> $this->endDate,
            "status"=> $this->status,
            "created_at"=> $this->created_at,
            "user"=> $this->user->email
        ];
    }
}

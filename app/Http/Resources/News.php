<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class News extends JsonResource
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
            "content"=> $this->content,
            "url"=> $this->url,
            "image"=> $this->image,
            "status"=> $this->status,
            "created_at"=> $this->created_at,
            "user"=> $this->user->email,
            "publishDate"=> $this->publishDate,
            "userName"=>$this->profile->name,
        ];
    }
}

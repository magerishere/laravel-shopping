<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'user_id' => $this->user_id,
            'views'  => $this->views,
            'catNames' => [$this->catNameKey,$this->catName],
            'title' => $this->title,
            'image' => $this->image,
            'content' => $this->content,
        ];
    }
}

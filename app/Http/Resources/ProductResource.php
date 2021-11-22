<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'views' => $this->views,
            'catNames' => [$this->catNameKey,$this->catName],
            'title' => $this->title,
            'image' => $this->image,
            'amount' => $this->amount,
            'qty' => $this->qty,
            'content' => $this->content,            
            'meta' => $this->whenLoaded('meta'),
            'user' => $this->whenLoaded('user'),
            'comments' => $this->whenLoaded('comments'),
            'likes' => $this->whenLoaded('likes'),
            'dislikes' => $this->whenLoaded('dislikes'),
        ];
    }
}

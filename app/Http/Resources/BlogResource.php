<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            'id' => $this->id,
            'user_id' => $this->user_id,
            'views'  => $this->views,
            'catNames' => [$this->catNameKey,$this->catName],
            'title' => $this->title,
            'image' => $this->image,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => $this->whenLoaded('user'),
            'comments' => $this->whenLoaded('comments'),
            'likes' => $this->whenLoaded('likes'),
            'dislikes' => $this->whenLoaded('dislikes'),
        ];
    }
}

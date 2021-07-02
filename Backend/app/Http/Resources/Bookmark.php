<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\Category as CategoryResource;

class Bookmark extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'is_category' => $this->is_category,
            'category' => new CategoryResource($this->category),
            'is_post' => $this->is_post,
            'post' => new PostResource($this->post),
            'user' => new UserResource($this->user),
            'created_at' => $this->created_at->format('Y-m-d h:m:i'),
            'updated_at' => $this->updated_at->format('Y-m-d h:m:i')
        ];
    }
}

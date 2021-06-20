<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'user' => $this->user,
            'approved_by' => $this->approved_by,
            'tags' => new TagCollection($this->tags),
            'histories' => new PostHistoryCollection($this->histories),
            'votes' => new PostVoteCollection($this->votes),
            'comments' => new PostCommentCollection($this->comments),
            'approved_at' => $this->approved_at->format('Y-m-d h:m:i'),
            'created_at' => $this->created_at->format('Y-m-d h:m:i'),
            'updated_at' => $this->updated_at->format('Y-m-d h:m:i')
        ];
    }
}

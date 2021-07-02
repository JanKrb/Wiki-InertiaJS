<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Post extends JsonResource
{
    private $detailed;

    public function __construct($resource, $detailed=false)
    {
        parent::__construct($resource);
        $this->detailed = $detailed;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'user' => $this->user,
            'thumbnail' => $this->thumbnail,
            'tags' => new TagCollection($this->tags),
            'histories_count' => sizeof($this->histories),
            'like_votes_count' => $this->votes->where('vote', 1)->count(),
            'dislike_votes_count' => $this->votes->where('vote', 0)->count(),
            'comments_count' => sizeof($this->comments),
            'created_at' => $this->created_at->format('Y-m-d h:m:i'),
            'updated_at' => $this->updated_at->format('Y-m-d h:m:i')
        ];

        if ($this->approved_at) {
            $data['approved_at'] = $this->approved_at->format('Y-m-d h:m:i');
            $data['approved_by'] = $this->approved_user;
        }

        if ($this->detailed) {
            $data['histories'] = new PostHistoryCollection($this->histories);
            $data['votes'] = new PostVoteCollection($this->votes);
            $data['comments'] = new PostCommentCollection($this->comments);
        }

        return $data;
    }
}

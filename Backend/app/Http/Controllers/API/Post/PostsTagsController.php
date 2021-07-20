<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\RelationController;
use App\Http\Resources\PostTag;
use App\Http\Resources\PostTagCollection;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostsTagsController extends RelationController
{
    protected $parentModel = Post::class;
    protected $childModel = Tag::class;

    protected $resource = PostTag::class;

    protected $collection = PostTagCollection::class;
}

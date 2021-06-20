<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\BaseController;
use App\Http\Resources\PostCollection;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\PostHistoryCollection;
use App\Http\Resources\PostHistory as PostHistoryResource;
use App\Models\Post;
use App\Models\PostHistory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends BaseController
{
    public function index(Request $request)
    {
        $per_page = $request->get('per_page', 15);
        return (new PostCollection(Post::paginate($per_page)))->additional([
            'success' => true,
            'message' => 'Successfully retrieved posts'
        ]);
    }

    public function show($id) {
        $post = Post::find($id);

        if (is_null($post)) {
            return $this->sendError('Post does not exists.');
        }

        return $this->sendResponse(new PostResource($post, true), 'Post retrieved successfully.');
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'content' => ''
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $input['user_id'] = auth()->user()->id;

        if (auth()->user()->hasPermission('posts_approve')) {
            $input['approved_by'] = auth()->user()->id;
            $input['approved_at'] = now();
        }

        $post = Post::create($input);
        return $this->sendResponse(new PostResource($post), 'Post created successfully');
    }

    public function update(Request $request, $post_id) {
        $post = Post::find($post_id);

        if (is_null($post)) {
            return $this->sendError('Post does not exists.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'content' => '',
            'approve' => 'boolean'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $history_post = PostHistory::create([
            'post_id' => $post->id,
            'user_id' => $post->user_id,
            'title' => $post->title,
            'content' => $post->content
        ]);

        $post->title = $input['title'];
        $post->content = $input['content'];

        if ($input['approve'] && auth()->user()->hasPermission('posts_approve')) {
            $post->approved_by = auth()->user()->id;
            $post->approved_at = now();
        }

        $post->save();

        return $this->sendResponse([
            'post' => new PostResource($post),
            'history_post' => new PostResource($history_post)
        ], 'Post updated successfully.');
    }

    public function destroy($post_id) {
        $post = Post::find($post_id);

        if (is_null($post)) {
            return $this->sendError('Post does not exists.');
        }

        $post->delete();

        return $this->sendResponse([], 'Post soft-deleted successfully.');
    }

    public function history(Request $request)
    {
        $per_page = $request->get('per_page', 15);
        return (new PostHistoryCollection(PostHistory::paginate($per_page)))->additional([
            'success' => true,
            'message' => 'Successfully retrieved post histories'
        ]);
    }

    public function post_history(Request $request, $post_id)
    {
        $post = PostHistory::find($post_id);

        if (is_null($post)) {
            return $this->sendError('Post History does not exists.');
        }

        $per_page = $request->get('per_page', 15);
        return (new PostHistoryCollection(PostHistory::where('id', $post->id)->paginate($per_page)))->additional([
            'success' => true,
            'message' => 'Successfully retrieved post histories of post'
        ]);
    }

    public function history_show($id) {
        $post = PostHistory::find($id);

        if (is_null($post)) {
            return $this->sendError('Post History does not exists.');
        }

        return $this->sendResponse(new PostHistoryResource($post), 'Post History retrieved successfully.');
    }

    public function recent_posts(Request $request) {
        $max = $request->get('max', 5);
        $posts = Post::all()->sortBy('updated_at', SORT_ASC)->take($max);
        return $this->sendResponse(new PostCollection($posts), 'Recent posts has been retrieved successfully');
    }
}

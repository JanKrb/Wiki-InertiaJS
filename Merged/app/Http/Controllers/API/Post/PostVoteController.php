<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostVote as PostVoteResource;
use App\Http\Resources\PostVoteCollection;
use App\Models\Post;
use App\Models\PostVote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostVoteController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->get('per_page', 15);
        return (new PostVoteCollection(PostVote::paginate($per_page)))->additional([
            'success' => true,
            'message' => 'Successfully retrieved votes'
        ]);
    }

    public function post_votes(Request $request, $post_id)
    {
        $post = Post::find($post_id);

        if (is_null($post)) {
            return $this->sendError('Post does not exists.');
        }

        $per_page = $request->get('per_page', 15);
        return (new PostVoteCollection(PostVote::where('post_id', $post->id)->paginate($per_page)))->additional([
            'success' => true,
            'message' => 'Successfully retrieved post votes'
        ]);
    }

    public function show($id) {
        $vote = PostVote::find($id);

        if (is_null($vote)) {
            return $this->sendError('Post Vote does not exists.');
        }

        return $this->sendResponse(new PostVoteResource($vote), 'Post Vote retrieved successfully.');
    }

    public function vote(Request $request, $post_id) {
        $post = Post::find($post_id);

        if (is_null($post)) {
            return $this->sendError('Post does not exists.');
        }

        $vote = PostVote::where([
            ['user_id', auth()->user()->id],
            ['post_id', $post_id]
        ])->first();

        $input = $request->all();
        $validator = Validator::make($input, [
            'vote' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()], 400);
        }

        if (is_null($vote)) {
            $input['post_id'] = $post_id;
            $input['user_id'] = auth()->user()->id;

            $vote = PostVote::create($input);
            return $this->sendResponse(new PostVoteResource($vote), 'Post Vote created successfully');
        }

        $vote->vote = $input['vote'];
        $vote->save();

        return $this->sendResponse(new PostVoteResource($vote), 'Post Vote updated successfully.');
    }
}

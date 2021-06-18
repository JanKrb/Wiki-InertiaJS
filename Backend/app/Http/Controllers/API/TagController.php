<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Resources\TagCollection;
use App\Models\Tag;
use App\Http\Resources\Tag as TagResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends BaseController
{
    public function index(Request $request)
    {
        $per_page = $request->get('per_page', 15);
        return (new TagCollection(Tag::paginate($per_page)))->additional([
            'success' => true,
            'message' => 'Successfully retrieved tags'
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|max:255',
            'description' => '',
            'color' => 'required|regex:^(?:[0-9a-fA-F]{3}){1,2}$^',
            'icon' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $input['user_id'] = auth()->user()->id;

        $tag = Tag::create($input);
        return $this->sendResponse(new TagResource($tag), 'Tag created successfully');
    }

    public function show($id) {
        $tag = Tag::find($id);

        if (is_null($tag)) {
            return $this->sendError('Tag does not exists.');
        }

        return $this->sendResponse(new TagResource($tag), 'Tag retrieved successfully.');
    }

    public function update(Request $request, Tag $tag) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|max:255',
            'description' => '',
            'color' => 'required|regex:^(?:[0-9a-fA-F]{3}){1,2}$^',
            'icon' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $tag->name = $input['name'];
        $tag->description = $input['description'];
        $tag->color = $input['color'];
        $tag->icon = $input['icon'];

        $tag->save();

        return $this->sendResponse(new TagResource($tag), 'Tag updated successfully.');
    }

    public function destroy(Tag $tag) {
        $tag->delete();
        return $this->sendResponse([], 'Tag soft-deleted successfully.');
    }
}

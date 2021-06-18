<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Models\Category;
use App\Http\Resources\Category as CategoryResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends BaseController
{
    public function index(Request $request)
    {
        $per_page = $request->get('per_page', 15);
        return [
            'success' => true,
            'message' => 'Categories retrieved successfully',
            'data' => Category::paginate($per_page)->toArray()
        ];
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'description' => 'required',
            'thumbnail' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $input['user_id'] = auth()->user()->id;

        $category = Category::create($input);
        return $this->sendResponse(new CategoryResource($category), 'Category created successfully');
    }

    public function show($id) {
        $category = Category::find($id);

        if (is_null($category)) {
            return $this->sendError('Category does not exists.');
        }

        return $this->sendResponse(new CategoryResource($category), 'Category retrieved successfully.');
    }

    public function update(Request $request, Category $category) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'description' => 'required',
            'thumbnail' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $category->title = $input['title'];
        $category->description = $input['description'];
        $category->thumbnail = $input['thumbnail'];

        $category->save();

        return $this->sendResponse(new CategoryResource($category), 'Category updated successfully.');
    }

    public function destroy(Category $category) {
        $category->delete();
        return $this->sendResponse([], 'Category soft-deleted successfully.');
    }
}

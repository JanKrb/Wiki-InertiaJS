<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\StructuredCategory as StructuredCategoryResource;
use App\Models\Category;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\StructuredCategoryCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->get('per_page', 15);
        return (new CategoryCollection(Category::paginate($per_page)))->additional([
            'success' => true,
            'message' => 'Successfully retrieved categories'
        ]);
    }

    public function structured(Request $request) {
        $per_page = $request->get('per_page', 15);
        return (new StructuredCategoryCollection(Category::paginate($per_page)))->additional([
            'success' => true,
            'message' => 'Successfully retrieved categories'
        ]);
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
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()], 400);
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

    public function update(Request $request, $category_id) {
        $category = Category::find($category_id);

        if (is_null($category)) {
            return $this->sendError('Category does not exists.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'description' => 'required',
            'thumbnail' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()], 400);
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

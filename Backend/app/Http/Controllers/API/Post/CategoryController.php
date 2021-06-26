<?php

namespace App\Http\Controllers\API\Post;

use App\Http\Controllers\BaseController;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\StructuredCategory as StructuredCategoryResource;
use App\Models\Category;
use App\Http\Resources\StructuredCategoryCollection;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    protected $model = Category::class;
    protected $resource = CategoryResource::class;
    protected $collection = CategoryCollection::class;

    protected $validations_create = [
        'title' => 'required|max:255',
        'description' => 'required',
        'thumbnail' => 'required|max:255'
    ];

    protected $validations_update = [
        'title' => 'required|max:255',
        'description' => 'required',
        'thumbnail' => 'required|max:255'
    ];

    public function structured(Request $request) {
        $per_page = $request->get('per_page', 15);
        return (new StructuredCategoryCollection(Category::where('parent_id', null)->paginate($per_page)))->additional([
            'success' => true,
            'message' => 'Successfully retrieved categories'
        ]);
    }
}

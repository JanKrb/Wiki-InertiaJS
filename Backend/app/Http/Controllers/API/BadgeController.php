<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Models\Badge;
use App\Http\Resources\Badge as BadgeResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BadgeController extends BaseController
{
    public function index(Request $request)
    {
        $per_page = $request->get('per_page', 15);
        return [
            'success' => true,
            'message' => 'Badges retrieved successfully',
            'data' => Badge::paginate($per_page)->toArray()
        ];
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'description' => '',
            'icon' => 'required',
            'color' => 'required|regex:^(?:[0-9a-fA-F]{3}){1,2}$^',
            'is_role_badge' => 'boolean',
            'role_id' => 'required_if:is_role_badge,true'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $input['user_id'] = auth()->user()->id;

        $badge = Badge::create($input);
        return $this->sendResponse(new BadgeResource($badge), 'Badge created successfully');
    }

    public function show($id) {
        $badge = Badge::find($id);

        if (is_null($badge)) {
            return $this->sendError('Badge does not exists.');
        }

        return $this->sendResponse(new BadgeResource($badge), 'Badge retrieved successfully.');
    }

    public function update(Request $request, Badge $badge) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'description' => '',
            'icon' => 'required',
            'color' => 'required|regex:^(?:[0-9a-fA-F]{3}){1,2}$^',
            'is_role_badge' => 'boolean',
            'role_id' => 'required_if:is_role_badge,true'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $badge->title = $input['title'];
        $badge->description = $input['description'];
        $badge->icon = $input['icon'];
        $badge->color = $input['color'];
        $badge->is_role_badge = $input['is_role_badge'];
        $badge->role_id = $input['role_id'];

        $badge->save();

        return $this->sendResponse(new BadgeResource($badge), 'Badge updated successfully.');
    }

    public function destroy(Badge $badge) {
        $badge->delete();
        return $this->sendResponse([], 'Badge soft-deleted successfully.');
    }
}

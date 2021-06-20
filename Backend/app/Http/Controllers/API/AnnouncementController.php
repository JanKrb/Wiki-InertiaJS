<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Resources\AnnouncementCollection;
use App\Models\Announcement;
use App\Http\Resources\Announcement as AnnouncementResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends BaseController
{
    public function index(Request $request)
    {
        $per_page = $request->get('per_page', 15);
        return (new AnnouncementCollection(Announcement::all()->sortBy('updated_at', SORT_ASC)->paginate($per_page)))->additional([
            'success' => true,
            'message' => 'Successfully retrieved announcements'
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $input['user_id'] = auth()->user()->id;

        $announce = Announcement::create($input);
        return $this->sendResponse(new AnnouncementResource($announce), 'Announcement created successfully');
    }

    public function show($id) {
        $announce = Announcement::find($id);

        if (is_null($announce)) {
            return $this->sendError('Announcement does not exists.');
        }

        return $this->sendResponse(new AnnouncementResource($announce), 'Announcement retrieved successfully.');
    }

    public function update(Request $request, $announcement_id) {
        $announce = Announcement::find($announcement_id);

        if (is_null($announce)) {
            return $this->sendError('Announcement does not exists.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $announce->title = $input['title'];
        $announce->description = $input['description'];

        $announce->save();

        return $this->sendResponse(new AnnouncementResource($announce), 'Announcement updated successfully.');
    }

    public function destroy($announcement_id) {
        $announce = Announcement::find($announcement_id);

        if (is_null($announce)) {
            return $this->sendError('Announcement does not exists.');
        }

        $announce->delete();

        return $this->sendResponse([], 'Announcement soft-deleted successfully.');
    }
}

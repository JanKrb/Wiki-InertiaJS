<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\BaseController;
use App\Http\Resources\NotificationCollection;
use App\Http\Resources\Notification as NotificationResource;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends BaseController
{
    public function index(Request $request) {
        $per_page = $request->get('per_page', 15);
        return (new NotificationCollection(Notification::paginate($per_page)))->additional([
            'success' => true,
            'message' => 'Successfully retrieved notifications'
        ]);
    }

    public function get_users(Request $request, $user_id) {
        $user = User::find($user_id);

        if (is_null($user)) {
            return $this->sendError('User does not exists.');
        }

        $per_page = $request->get('per_page', 15);

        return (new NotificationCollection(Notification::where('user_id', $user_id)->paginate($per_page)))->additional([
            'success' => true,
            'message' => 'Successfully retrieved user notifications'
        ]);
    }

    public function show(Request $request, $notification_id) {
        $notify = Notification::find($notification_id);

        if (is_null($notify)) {
            return $this->sendError('Notification does not exists.');
        }

        return $this->sendResponse(new NotificationResource($notify), 'Notification retrieved successfully.');
    }

    public function create(Request $request) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'color' => 'required|regex:^(?:[0-9a-fA-F]{3}){1,2}$^',
            'content' => 'required',
            'type' => 'required|integer',
            'icon' => 'required_if:type,1|max:255',
            'target_user' => 'required_if:type,2|integer|exists:users,id'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $input['user_id'] = auth()->user()->id;

        $notify = Notification::create($input);

        return $this->sendResponse(new NotificationResource($notify), 'Notification successfully created.');
    }

    public function update(Request $request, $notification_id) {
        $notify = Notification::find($notification_id);

        if (is_null($notify)) {
            return $this->sendError('Notification does not exists.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required|max:255',
            'color' => 'required|regex:^(?:[0-9a-fA-F]{3}){1,2}$^',
            'content' => 'required',
            'type' => 'required|integer',
            'icon' => 'required_if:type,1',
            'target_user' => 'required_if:type,2'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $notify->title = $input['title'];
        $notify->color = $input['color'];
        $notify->content = $input['content'];
        $notify->type = $input['type'];

        if ($request->has('icon')) {
            $notify->icon = $input['icon'];
        }


        if ($request->has('target_user')) {
            $notify->target_user = $input['target_user'];
        }

        $notify->save();

        return $this->sendResponse(new NotificationResource($notify), 'Notification successfully updated.');
    }

    public function destroy($notification_id) {
        $notify = Notification::find($notification_id);

        if (is_null($notify)) {
            return $this->sendError('Notification does not exists.');
        }

        $notify->delete();

        return $this->sendResponse([], 'Notification soft-deleted successfully.');
    }
}

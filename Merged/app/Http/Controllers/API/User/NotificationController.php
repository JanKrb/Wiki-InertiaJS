<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\BaseController;
use App\Http\Resources\NotificationCollection;
use App\Http\Resources\Notification as NotificationResource;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends BaseController
{
    protected $model = Notification::class;
    protected $resource = NotificationResource::class;
    protected $collection = NotificationCollection::class;

    protected $validations_create = [
        'title' => 'required|max:255',
        'color' => 'required|regex:^(?:[0-9a-fA-F]{3}){1,2}$^',
        'content' => 'required',
        'type' => 'required|integer',
        'icon' => 'required_if:type,1',
        'target_user' => 'required_if:type,2',
        'seen' => 'boolean'
    ];

    protected $validations_update = [
        'title' => 'string|max:255',
        'description' => 'string'
    ];

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
}

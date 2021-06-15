<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Models\Badge;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Collection;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserBadgesController extends BaseController
{
    public function index($user_id) {
        $user = User::find($user_id);

        if (is_null($user)) {
            return  $this->sendError('Invalid user id.', ['user_id' => $user_id]);
        }

        return [
            'success' => true,
            'message' => 'Successfully retrieved badges',
            'data' => (new Collection($user->badges))->paginate(15)
        ];
    }

    public function store(Request $request, $user_id) {
        $user = User::find($user_id);

        if (is_null($user)) {
            return  $this->sendError('Invalid user id.', ['user_id' => $user_id]);
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'badge_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $badge = Badge::find($input['badge_id']);

        if (is_null($badge)) {
            return $this->sendError('Invalid badge', ['badge_id' => $input['badge_id']]);
        }

        $user->badges()->save($badge);

        return $this->sendResponse($user->badges, 'Successfully added badge to user');
    }

    public function show($user_id, $badge_id) {
        $user = User::find($user_id);

        if (is_null($user)) {
            return  $this->sendError('Invalid user id.', ['user_id' => $user_id]);
        }

        foreach ($user->badges as $badge) {
            if ($badge->id == $badge_id) {
                $found_badge = Badge::find($badge_id);

                if (!is_null($found_badge)) {
                    return $this->sendResponse($found_badge, 'Successfully fetched badge of user');
                }
            }
        }

        return $this->sendError('Badge does not belong to user', ['user_id' => $user_id, 'badge_id' => $badge_id]);
    }

    public function destroy($user_id, $badge_id) {
        $user = User::find($user_id);

        if (is_null($user)) {
            return  $this->sendError('Invalid user id.', ['user_id' => $user]);
        }

        foreach ($user->badges as $badge) {
            if ($badge->id == $badge_id) {
                $found_badge = Badge::find($badge_id);

                if (!is_null($found_badge)) {
                    $found_badge->delete();
                    return $this->sendResponse([], 'Badge has been removed from user');
                }
            }
        }

        return $this->sendError('User has no badge with this id', ['user_id' => $user_id->id, 'badge_id' => $badge_id]);
    }
}
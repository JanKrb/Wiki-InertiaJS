<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Resources\BadgeCollection;
use App\Http\Resources\UserBadgeCollection;
use \App\Http\Resources\Badge as BadgeResource;
use App\Models\Badge;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Collection;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserBadgesController extends BaseController
{
    public function index(Request $request, $user_id) {
        $per_page = $request->get('per_page', 15);
        $user = User::find($user_id);

        if (is_null($user)) {
            return  $this->sendError('Invalid user id.', ['user_id' => $user_id]);
        }

        return (new UserBadgeCollection($user->badges->paginate($per_page)))->additional([
            'success' => true,
            'message' => 'Successfully retrieved user badges'
        ]);
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

        return $this->sendResponse(new BadgeResource($badge), 'Successfully added badge to user');
    }

    public function storeArray(Request $request, $user_id) {
        $user = User::find($user_id);

        if (is_null($user)) {
            return  $this->sendError('Invalid user id.', ['user_id' => $user_id]);
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'badges' => 'required|array',
            'badges.*' => 'exists:badges,id'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $badges = $input['badges'];
        foreach ($badges as $badge) {
            $user->badges()->save(Badge::find($badge));
        }

        return $this->sendResponse(new BadgeCollection($badges), 'Successfully added badges to user');
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
                    return $this->sendResponse(new BadgeResource($found_badge), 'Successfully fetched badge of user');
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
                $user->badges()->detach($badge_id);
                return $this->sendResponse([], 'Successfully removed badge from user');
            }
        }

        return $this->sendError('User has no badge with this id', ['user_id' => $user_id->id, 'badge_id' => $badge_id]);
    }

    public function destroyArray(Request $request, $user_id) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'badges' => 'required|array',
            'badges.*' => 'exists:badges,id'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $user = User::find($user_id);

        if (is_null($user)) {
            return  $this->sendError('Invalid user id.', ['user_id' => $user]);
        }

        $badges = $input['badges'];
        foreach ($badges as $badge_id) {
            foreach ($user->badges as $badge) {
                if ($badge->id == $badge_id) {
                    $user->badges()->detach($badge_id);
                }
            }

            return $this->sendResponse([], 'Successfully removed badges from user');
        }

        return $this->sendError('Unknown error on deleting badges of user', ['user_id' => $user_id->id, 'badge_id' => $badge_id]);
    }
}

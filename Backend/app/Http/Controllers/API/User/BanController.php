<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\BaseController;
use App\Http\Resources\BanCollection;
use App\Http\Resources\Ban as BanResource;
use App\Models\Ban;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BanController extends BaseController
{
    public function index(Request $request)
    {
        $per_page = $request->get('per_page', 15);
        return (new BanCollection(Ban::paginate($per_page)))->additional([
            'success' => true,
            'message' => 'Successfully retrieved bans'
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'target_id' => 'required|integer',
            'reason' => 'required|max:255',
            'description' => 'required',
            'ban_until' => 'required|date_format:Y-m-d H:i:s',
            'type' => 'integer|nullable'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $input['staff_id'] = auth()->user()->id;

        $ban = Ban::create($input);
        return $this->sendResponse(new BanResource($ban), 'Ban created successfully');
    }

    public function show($id) {
        $ban = Ban::find($id);

        if (is_null($ban)) {
            return $this->sendError('Ban does not exists.');
        }

        return $this->sendResponse(new BanResource($ban), 'Ban retrieved successfully.');
    }

    public function update(Request $request, $ban_id) {
        $ban = Ban::find($ban_id);

        if (is_null($ban)) {
            return $this->sendError('Ban does not exists.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'target_id' => 'required|integer',
            'reason' => 'required|max:255',
            'description' => 'required',
            'ban_until' => 'required|date_format:Y-m-d H:i:s',
            'type' => 'integer|nullable'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $ban->target_id = $input['target_id'];
        $ban->reason = $input['reason'];
        $ban->description = $input['description'];
        $ban->ban_until = $input['ban_until'];
        $ban->type = $input['type'];

        $ban->save();

        return $this->sendResponse(new BanResource($ban), 'Ban updated successfully.');
    }

    public function destroy($ban_id) {
        $ban = Ban::find($ban_id);

        if (is_null($ban)) {
            return $this->sendError('Ban does not exists.');
        }

        $ban->delete();
        return $this->sendResponse([], 'Ban soft-deleted successfully.');
    }

    public function count_bans() {
        # 0 => Global; 1 => Comments; 2 => Posts
        $bans = Ban::all();
        return $this->sendResponse([
            'global' => $bans->where('type', '=', 0)->count(),
            'comments' => $bans->where('type', '=', 1)->count(),
            'posts' => $bans->where('type', '=', 2)->count()
        ],
        'Ban count retrieved successfully');
    }
}

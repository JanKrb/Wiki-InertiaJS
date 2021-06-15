<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Models\Permission;
use App\Http\Resources\Permission as PermissionResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PermissionController extends BaseController
{
    public function index()
    {
        return [
            'success' => true,
            'message' => 'Permissions retrieved successfully',
            'data' => Permission::paginate(15)->toArray()
        ];
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $permission = Permission::create($input);
        return $this->sendResponse(new PermissionResource($permission), 'Permission created successfully');
    }

    public function show($id) {
        $permission = Permission::find($id);

        if (is_null($permission)) {
            return $this->sendError('Permission does not exists.');
        }

        return $this->sendResponse(new PermissionResource($permission), 'Permission retrieved successfully.');
    }

    public function update(Request $request, Permission $permission) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $permission->name = $input['name'];

        $permission->save();

        return $this->sendResponse(new PermissionResource($permission), 'Permission updated successfully.');
    }

    public function destroy(Permission $permission) {
        $permission->delete();
        return $this->sendResponse([], 'Permission soft-deleted successfully.');
    }
}

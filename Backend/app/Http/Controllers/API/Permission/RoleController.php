<?php

namespace App\Http\Controllers\API\Permission;

use App\Http\Controllers\BaseController;
use App\Http\Resources\RoleCollection;
use App\Models\Role;
use App\Http\Resources\Role as RoleResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends BaseController
{
    public function index(Request $request)
    {
        $per_page = $request->get('per_page', 15);
        return (new RoleCollection(Role::paginate($per_page)))->additional([
            'success' => true,
            'message' => 'Successfully retrieved roles'
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|max:255',
            'description' => '',
            'color' => 'required|regex:^(?:[0-9a-fA-F]{3}){1,2}$^'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()], 400);
        }

        $input['user_id'] = auth()->user()->id;

        $role = Role::create($input);
        return $this->sendResponse(new RoleResource($role), 'Role created successfully');
    }

    public function show($id) {
        $role = Role::find($id);

        if (is_null($role)) {
            return $this->sendError('Role does not exists.');
        }

        return $this->sendResponse(new RoleResource($role), 'Role retrieved successfully.');
    }

    public function update(Request $request, Role $role) {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|max:255',
            'description' => '',
            'color' => 'required|regex:^(?:[0-9a-fA-F]{3}){1,2}$^'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()], 400);
        }

        $role->name = $input['name'];
        $role->description = $input['description'];
        $role->color = $input['color'];

        $role->save();

        return $this->sendResponse(new RoleResource($role), 'Role updated successfully.');
    }

    public function destroy(Role $role) {
        $role->delete();
        return $this->sendResponse([], 'Role soft-deleted successfully.');
    }
}

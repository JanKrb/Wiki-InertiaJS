<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Models\Role;
use Illuminate\Support\Collection;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RolesPermissionsController extends BaseController
{
    public function index($role_id) {
        $role = Role::find($role_id);

        if (is_null($role)) {
            return  $this->sendError('Invalid role id.', ['role_id' => $role_id]);
        }

        return [
            'success' => true,
            'message' => 'Successfully retrieved permissions',
            'data' => (new Collection($role->permissions))->paginate(15)
        ];
    }

    public function store(Request $request, $role_id) {
        $role = Role::find($role_id);

        if (is_null($role)) {
            return  $this->sendError('Invalid role id.', ['role_id' => $role_id]);
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', ['errors' => $validator->errors()]);
        }

        $permission = Permission::where('name', $input['name'])->first();

        if (is_null($permission)) {
            return $this->sendError('Invalid permission', ['permission_name' => $input['name']]);
        }

        $role->permissions->push($permission);

        return $this->sendResponse($role->permissions, 'Successfully added permission to role');
    }

    public function show($role_id, $permission_id) {
        $role = Role::find($role_id);

        if (is_null($role)) {
            return  $this->sendError('Invalid role id.', ['role_id' => $role_id]);
        }

        $permission = Permission::find($permission_id);

        if (is_null($permission)) {
            return  $this->sendError('Invalid permission id.', ['permission_id' => $permission_id]);
        }

        return $this->sendResponse($permission, 'Successfully fetched permission of role');
    }

    public function show_name($role_id, $permission_name) {
        $role = Role::find($role_id);

        if (is_null($role)) {
            return  $this->sendError('Invalid role id.', ['role_id' => $role_id]);
        }

        $permission = Permission::where('name', $permission_name)->first();

        if (is_null($permission)) {
            return $this->sendError('Invalid permission', ['permission_name' => $permission_name]);
        }

        return $this->sendResponse($permission, 'Successfully fetched permission by name of role');
    }

    public function destroy($role_id, $permission_id) {
        $role = Role::find($role_id);

        if (is_null($role)) {
            return  $this->sendError('Invalid role id.', ['role_id' => $role_id]);
        }

        $permission = Permission::find($permission_id);

        if (is_null($permission)) {
            return $this->sendError('Invalid permission', ['permission_name' => $permission_id]);
        }

        foreach ($role->permissions as $test_permission) {
            if ($test_permission->id === $permission->id) {
                $test_permission->delete($permission);

                return $this->sendResponse($permission, 'Successfully removed permission by name from role');
            }
        }

        return $this->sendError('Role has no permission with this name', ['role_id' => $role->id, 'permission_id' => $permission_id]);
    }
}

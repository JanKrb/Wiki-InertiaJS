<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Models\Role;
use Illuminate\Support\Collection;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\RolePermissionCollection;
use App\Http\Resources\RolePermission as RolePermissionResource;

class RolesPermissionsController extends BaseController
{
    public function index(Request $request, $role_id) {
        $per_page = $request->get('per_page', 15);

        $role = Role::find($role_id);

        if (is_null($role)) {
            return  $this->sendError('Invalid role id.', ['role_id' => $role_id]);
        }

        return (new RolePermissionCollection($role->permissions->paginate($per_page)))->additional([
            'success' => true,
            'message' => 'Successfully retrieved role permissions'
        ]);
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

        $role->permissions()->save($permission); // [15.06.2021] If causes errors, change to: $role->permissions->push($permission);

        return $this->sendResponse(new RolePermissionResource($permission), 'Successfully added permission to role');
    }

    public function show($role_id, $permission_id) {
        $role = Role::find($role_id);

        if (is_null($role)) {
            return  $this->sendError('Invalid role id.', ['role_id' => $role_id]);
        }

        foreach ($role->permissions as $permission) {
            if ($permission->id == $permission_id) {
                $found_permission = Permission::find($permission_id);

                if (!is_null($found_permission)) {
                    return $this->sendResponse(new RolePermissionResource($found_permission), 'Successfully fetched permission of role');
                }
            }
        }

        return $this->sendError('Permission does not belong to role', ['role_id' => $role_id, 'permission_id' => $permission_id]);
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

        return $this->sendResponse(new RolePermissionResource($permission), 'Successfully fetched permission by name of role');
    }

    public function destroy($role_id, $permission_id) {
        $role = Role::find($role_id);

        if (is_null($role)) {
            return  $this->sendError('Invalid role id.', ['role_id' => $role_id]);
        }

        foreach ($role->permissions as $permission) {
            if ($permission->id == $permission_id) {
                $found_permission = Permission::find($permission_id);

                if (!is_null($found_permission)) {
                    $found_permission->delete();
                    return $this->sendResponse([], 'Permission has been removed from role');
                }
            }
        }

        return $this->sendError('Role has no permission with this id', ['role_id' => $role->id, 'permission_id' => $permission_id]);
    }
}

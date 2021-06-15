<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Models\Role;
use http\Client\Request;
use Illuminate\Support\Collection;
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
}

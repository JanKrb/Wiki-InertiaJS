<?php

namespace App\Http\Controllers\API;

use App\Models\Role;

class RolesPermissionsController
{
    protected $model = Role::class;
    protected $relation = 'permissions';

    protected function keyName(): string {

    }
}

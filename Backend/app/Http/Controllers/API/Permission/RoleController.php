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
    protected $model = Role::class;
    protected $resource = RoleResource::class;
    protected $collection = RoleCollection::class;

    protected $validations_create = [
        'name' => 'required|max:255',
        'description' => '',
        'color' => 'required|regex:^(?:[0-9a-fA-F]{3}){1,2}$^'
    ];

    protected $validations_update = [
        'name' => 'max:255',
        'description' => 'string',
        'color' => 'regex:^(?:[0-9a-fA-F]{3}){1,2}$^'
    ];
}

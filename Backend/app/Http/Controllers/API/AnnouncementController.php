<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use App\Http\Resources\AnnouncementCollection;
use App\Models\Announcement;
use App\Http\Resources\Announcement as AnnouncementResource;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends BaseController
{
    protected $model = Announcement::class;
    protected $resource = AnnouncementResource::class;
    protected $collection = AnnouncementCollection::class;

    protected $validations_create = [
        'title' => 'required|max:255',
        'description' => 'required'
    ];

    protected $validations_update = [
        'title' => 'string|max:255',
        'description' => 'string'
    ];

    public function __construct() {
        $this->middleware(function ($request, $next) {
            $this->additionalCreateData = [
                'user_id' => Auth::user()->id
            ];

            return $next($request);
        });
    }
}

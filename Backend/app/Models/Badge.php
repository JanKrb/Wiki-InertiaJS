<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Badge extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'icon',
        'color',
        'is_role_badge',
        'role_id'
    ];

    /**
     * Role Relation
     */
    public function role(): ?BelongsTo
    {
        if (!$this->is_role_badge) {
            return null;
        }

        return $this->belongsTo(Role::class);
    }
}

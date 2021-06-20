<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'approved_by',
        'approved_at'
    ];

    /**
     * User relation
     */
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function approved_by() {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Tags relation
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    /**
     * Post relations
     */
    public function histories() {
        return $this->hasMany(PostHistory::class);
    }

    public function votes() {
        return $this->hasMany(PostVote::class);
    }

    public function comments() {
        return $this->hasMany(PostComment::class);
    }
}

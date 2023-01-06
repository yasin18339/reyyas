<?php

namespace Alireza\Comment\Property;

use Alireza\Comment\Models\Comment;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;


class HaveComments

{
    use HasRelationships;

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function activeComments()
    {
        return $this->morphMany(Comment::class, 'commentable')
            ->where('status', Comment::STATUS_ACTIVE)
            ->with('comments')->whereNull('comment_id');
    }



}

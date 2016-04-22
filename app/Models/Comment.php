<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'description',
        'commentable_id'
    ];

    public function commentable()
    {
        return $this->morphTo();
    }
}

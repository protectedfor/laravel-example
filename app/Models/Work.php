<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];

    public function canAccessed()
    {
        return $this->user_id == Auth::id();
    }

    public function getMainImageAttribute()
    {
        if (count($this->photos) > 0)
            return route('imagecache', ['works', $this->photos()->first()->path]);
        return 'http://placehold.it/150x200';
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'imageable');
    }
}

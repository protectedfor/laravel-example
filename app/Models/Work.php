<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id'
    ];

    public function photos()
    {
        return $this->morphMany(Photo::class, 'imageable');
    }

    public function getMainImageAttribute()
    {
        if(count($this->photos) > 0)
            return url('images/uploads/' . $this->photos()->first()->path);
        return 'http://placehold.it/250x167';
    }
}

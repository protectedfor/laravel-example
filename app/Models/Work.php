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
}

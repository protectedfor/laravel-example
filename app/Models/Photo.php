<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    protected $fillable = [
        'path',
        'imageable_id'
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}

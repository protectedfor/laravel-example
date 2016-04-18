<?php

namespace App\Models;

use App\User;
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
        return 'http://placehold.it/325x210';
    }

    public function photos()
    {
        return $this->morphMany(Photo::class, 'imageable');
    }

    public function setImagesAttribute($images)
    {
        $this->photos()->delete();
        $imgs = [];
        foreach ($images as $img) {
            $img = str_replace(config('admin.imagesUploadDirectory') . '/', '', $img);
            $imgs[] = Photo::create(['imageable_id' => $this->id, 'path' => $img]);
        }
        $this->photos()->saveMany($imgs);
    }

    public function getImagesAttribute()
    {
        $imgs = [];
        foreach ($this->photos as $img) {
            $imgs[] = config('admin.imagesUploadDirectory') . '/' . $img->path;
        }
        return $imgs;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

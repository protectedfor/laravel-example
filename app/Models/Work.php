<?php

namespace App\Models;

use App\User;
use Auth;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Work extends Model
{
    use Translatable, SearchableTrait;

    public $translatedAttributes = ['title', 'description', 'slug'];

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'slug'
    ];

    protected $searchable = [
        'columns' => [
            'work_translations.title' => 10,
            'work_translations.description' => 10,
        ],
        'joins' => [
            'work_translations' => ['works.id','work_translations.work_id'],
        ],
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

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function setImagesAttribute($images)
    {
        $this->photos()->delete();
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

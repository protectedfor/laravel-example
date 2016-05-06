<?php

namespace App\Models;

use App\User;
use Auth;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class WorkTranslation extends Model implements SluggableInterface
{
    use SluggableTrait;

    public $timestamps = false;

    public $fillable = ['title', 'description', 'slug'];

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

}

<?php

namespace App\Models;

use App\User;
use Auth;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class WorkTranslation extends Model
{
    public $timestamps = false;

    public $fillable = ['title', 'description'];

}

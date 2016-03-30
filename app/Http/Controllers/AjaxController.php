<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Libraries\UploadHandler;

class AjaxController extends Controller
{
    public function upload(Request $request)
    {
        new UploadHandler();
    }
}

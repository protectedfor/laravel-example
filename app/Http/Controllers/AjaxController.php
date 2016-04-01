<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Libraries\UploadHandler;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function upload(Request $request)
    {
        new UploadHandler();
    }
}

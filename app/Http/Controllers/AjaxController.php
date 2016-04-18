<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Libraries\UploadHandler;
use App\Models\Work;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->method() == "GET") {
            $work_id = $request->get('work_id');
            $work = Work::find($work_id);
            $imgs = [];
            foreach ($work->photos as $img) {
                $imgs[] = [
                    'deleteType' => 'POST',
                    'deleteUrl' => 'null',
                    'name' => $img->path,
                    'size' => '',
                    'thumbnailUrl' => route('imagecache', ['work_thumbnails', $img->path]),
                    'url' => url('images/uploads/' . $img->path),
                ];
            }
            return ['files' => $imgs];

        }
        new UploadHandler(array(
            'accept_file_types' => '/\.(gif|jpe?g|png)$/i'
        ));
    }
}

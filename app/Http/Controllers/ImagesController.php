<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class ImagesController extends Controller
{
    public function upload(Request $request)
    {

        $file = $request->file('file');
        $fileName = time() . $file->getClientOriginalName();
        $path = $file->storeAs('public\images', $fileName);

        $path = asset("/storage/images/" . $fileName);

        echo json_encode(['location' => $path]);
    }
}
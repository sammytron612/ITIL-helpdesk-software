<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UploadController extends Controller
{
    public function image(Request $request)
    {

        $file = $request->file('upload');
        $fileName = time() . $file->getClientOriginalName();
        $path = $file->storeAs('public\images', $fileName);

        $path = asset("/storage/images/" . $fileName);

        return response()->json(['default' => $path]);
    }
}
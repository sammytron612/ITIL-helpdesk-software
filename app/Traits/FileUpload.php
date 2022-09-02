<?php
namespace App\Traits;
use Illuminate\Http\Request;

trait FileUpload
{

    public function upload(Request $request)
    {
        $uploadedFiles = array();

        $allowedfileExtension=['pdf','jpg','png','docx'];
        $files = $request->file('upload');

        foreach($files as $file)
        {

            $filename = $file->getClientOriginalName();

            $extension = $file->getClientOriginalExtension();

            $check = in_array($extension,$allowedfileExtension);

            if($check)
            {

                $fileName = time() . $file->getClientOriginalName();
                $path = $file->storeAs('public\images', $fileName);
                $url = asset("/storage/images/" . $fileName);
                array_push($uploadedFiles,
                    ['name' => $file->getClientOriginalName(),
                    'path' => $url]
                    );
            }

        }


        return $uploadedFiles;
    }
}

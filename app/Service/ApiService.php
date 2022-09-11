<?php
namespace App\Service;

use Illuminate\Support\Facades\Http;
use Auth;


class ApiService
{
    /**
     * Get all of the tasks for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function createArticle($formFields, $uploads = null)
    {
        if($uploads)
        {
            $uploads = json_encode($uploads);
        }

        if($formFields['status'] == 'Publish') {$formFields['status'] = 'Published';}

        $response = Http::withToken('testtoken')->post("http://localhost:9000/api/create/",
                        ['title' => $formFields['title'],
                        'solution' => $formFields['solution'],
                        'tags' => $formFields['tags'],
                        'section' => $formFields['section'],
                        'scope' => $formFields['scope'],
                        'status' => $formFields['status'],
                        'expiry' => $formFields['expiry'],
                        'author' => Auth::id(),
                        'author_name' => Auth::user()->name,
                        'uploads' => $uploads
                ]);

      return $response;


    }

    public function updateArticle($id, $formFields, $uploads = null)
    {
        if($uploads)
        {
            $uploads = json_encode($uploads);
        }

        if($formFields['status'] == 'Publish') {$formFields['status'] = 'Published';}

        $response = Http::withToken('testtoken')->post("http://localhost:9000/api/update/",
                        ['id' => $id,
                        'title' => $formFields['title'],
                        'solution' => $formFields['solution'],
                        'tags' => $formFields['tags'],
                        'section' => $formFields['section'],
                        'scope' => $formFields['scope'],
                        'expiry' => $formFields['expiry'],
                        'status' => $formFields['status'],
                        'uploads' => $uploads
                ]);

      return $response;
    }
/*
    public function getAll()
    {
        $response = Http::withToken('testtoken')->get("http://localhost:9000/api/all");

        return $response;

    }
*/
}

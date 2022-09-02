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


        $response = Http::withToken('testtoken')->post("http://localhost:9000/api/create/",
                        ['title' => $formFields['title'],
                        'solution' => $formFields['solution'],
                        'tags' => $formFields['title'],
                        'section' => $formFields['section'],
                        'scope' => $formFields['scope'],
                        'status' => $formFields['status'],
                        'author' => Auth::id(),
                        'uploads' => $uploads
                ]);

      return $response;
    }

}

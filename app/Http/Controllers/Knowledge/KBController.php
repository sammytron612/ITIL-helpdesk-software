<?php

namespace App\Http\Controllers\knowledge;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Traits\FileUpload;
use App\Service\ApiService;
Use Auth;


class KBController extends Controller
{
    use FileUpload;

    public function __construct()
    {
        $this->middleware('agent')->except('show');
    }

    public function index()
    {
        return view('knowledge.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = $this->getSections();

        return view('knowledge.create',['sections' => $sections]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ApiService $apiService)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'tags' => 'max:255',
            'section' => 'required',
            'status' => 'required',
            'scope' => 'required',
            'expiry' => 'nullable|after:today',
            'solution' => 'required',
            'upload.*' => 'mimes:csv,pdf,jpg,jpeg,png,txt,xlx,xls,xlsx,pdf,docx,doc,ppt|max:4096',
            'upload' => 'max:3'

        ]);

        $uploadedFiles = null;

        if($request->has('upload'))
            {
                $uploadedFiles = $this->upload($request);
            }



        $response = $apiService->createArticle($request->all(), $uploadedFiles);

        if($response->successful())
        {
            return redirect()->to('/kb/create')->with('message','Success');

        }
        else
        {
            return redirect()->to('/kb/create')->with('message','There was a problem!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Http::withToken('testtoken')->get("http://localhost:9000/api/show/" . $id);



        if($article->successful())
        {
            $article = json_decode($article->body(),true);


           if($article[0]['scope'] == 'Private' && Auth::user()->role == 'user')
            {
                abort(401);
            }

            $uploads = $article['uploads'];

            return view('knowledge.view-article',compact('article','uploads'));
        } else
        {
            abort($article->status());
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Http::withToken('testtoken')->get("http://localhost:9000/api/show/" . $id);

        if($article->successful())
        {

            $article = json_decode($article->body(),true);
            //dd($article);
            $uploads = $article['uploads'];

            $sections = $this->getSections();


            return view('knowledge.edit-article',compact('article','uploads','sections'));
        } else
        {
            abort($article->status());
        }
    }


    public function update(ApiService $apiService, Request $request, $id)
    {


        $validated = $request->validate([
            'title' => 'required|max:255',
            'tags' => 'max:255',
            'section' => 'required',
            'status' => 'required',
            'scope' => 'required',
            'expiry' => 'nullable|after:today',
            'solution' => 'required',
            'upload.*' => 'mimes:csv,pdf,jpg,jpeg,png,txt,xlx,xls,xlsx,pdf,docx,doc,ppt|max:4096',
            'upload' => 'max:3'

        ]);


        $uploadedFiles = null;

        if($request->has('upload'))
            {
                $uploadedFiles = $this->upload($request);
            }



        $response = $apiService->updateArticle($id, $request->all(), $uploadedFiles);


        if($response->successful())
        {
            return redirect()->to("/kb/{$id}/edit")->with('message','Success');

        }
        else
        {
            abort($response->status());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function getSections()
    {
        $sections = Http::withToken('testtoken')->get("http://localhost:9000/api/section");
        $sections = json_decode($sections->body(), true);

        return $sections;
    }
}

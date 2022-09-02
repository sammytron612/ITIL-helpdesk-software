<?php

namespace App\Http\Controllers\knowledge;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use App\Traits\FileUpload;
use App\Service\ApiService;


class KBController extends Controller
{
    use FileUpload;

    public $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('knowledge.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'tags' => 'max:255',
            'section' => 'required',
            'status' => 'required',
            'scope' => 'required',
            'solution' => 'required',
            'upload.*' => 'mimes:csv,pdf,jpg,jpeg,png,txt,xlx,xls,xlsx,pdf,docx,doc,ppt|max:4096',
            'upload' => 'max:3'

        ]);

        $uploadedFiles = null;

        if($request->has('upload'))
            {
                $uploadedFiles = $this->upload($request);
            }



        $response = $this->apiService->createArticle($validated, $uploadedFiles);

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
        $article = Http::withToken('token')->get("http://localhost:9000/api/show/" . $id);


        if($article->successful())
        {
            $article = json_decode($article->body(),true);

            $creator = User::find($article['author']);

            return view('knowledge.view-article',compact('article','creator'));
        } else
        {
            return view('knowledge.view-article')->with('error', 'The error message here!');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}

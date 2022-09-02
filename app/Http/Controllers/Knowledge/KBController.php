<?php

namespace App\Http\Controllers\knowledge;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use App\Traits\FileUpload;


class KBController extends Controller
{
    use FileUpload;


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
            'upload.*' => 'mimetypes:csv,pdf,jpg,jpeg,png,txt,xlx,xls,xlsx,pdf,docx,ppt|max:4096',
            'upload' => 'max:3'

        ]);

        if($request->has('upload'))
            {
                $uploadedFiles = $this->upload($request);
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
        $article = $response = Http::withToken('token')->get("http://localhost:9000/api/show/" . $id);


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

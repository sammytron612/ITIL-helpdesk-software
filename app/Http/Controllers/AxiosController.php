<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\agent_group;
use App\Models\updates;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class AxiosController extends Controller
{
    public function fetchData()
    {
        $array = [];
        $agents = User::select('id','name','email')->where('role','agent')->get();
        $agentGroups = agent_group::select('id','name','email')->get();

        foreach($agents as $agent)
        {
            $array[] = ['id' => '@' . $agent->name,
                        'userId' => $agent->id . '-' . 'agent',
                        'name' => $agent->name,
                        'email' => $agent->email,

                ];
        }

        foreach($agentGroups as $group)
        {

            $array[] = ['id' => '@' . $group->name,
                        'userId' => $group->id . '-' . 'group',
                        'name' => $group->name,
                        'email' => $group->email
                    ];

        }


        return response()->json(['agents' => $array]);
    }

    public function updateLock($id)
    {
        $comment = updates::find($id);

        $lock = $comment->public;
        $lock = ! $lock;

        $comment->public = $lock;
        $comment->save();

        return response()->json(['status' => 'success']);
    }

    function deleteKBAttachment($id, $name)
    {


        storage::delete('public/images/' . $name);

        $response = HTTP::withToken('testtoken')->delete("http://localhost:9000/api/delete-attachment/" . $id);
        $response = [
            'code' => $response->getStatusCode(),
            'successful' => $response->successful(),
        ];


        return response()->json($response);
    }

    public function fileDownload($path, $name)
    {
        //$path = url('storage/images/' . $path);

        //return Response::download($path);

        return storage::download('public/images/' . $path,$name);
    }
}

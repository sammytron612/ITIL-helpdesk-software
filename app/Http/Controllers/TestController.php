<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index()
    {

        $token = 'DQVJzU1hKcFlKVjFhVElMTnhEWVUyNU9GN05NNC1XQkY3WEhMVVdFMXZANVHI1djdBOTFDSENpMUhlUHJSYkdZAREN1SVNCcnk2RWl4M3I3VUhhVGV4bWtaTjZAfQXA1YlF1WDhySXc2M2Q1bDdNbU1tVnZAxRi1BUnFMQ0FINnB0MTI0RUpHdWVWRzh4VUhpVjFVTmlFNmdJQ2l3b3R5M29SWTV3TVkyYjJINC0xaXpyTjMydHdEVS04bTZAyLUJSaFEtb3c5UC1R';

        $url = "https://graph.facebook.com/company/members?limit=1500";

        $response = Http::withToken($token)->get($url);

        $ppl = $response->json();

        foreach ($ppl['data'] as $user) {

            $id = $user['id'];
            $name = $user['name'];
            echo $id . "-" . $name . "<br>";


            $url = "https://graph.facebook.com/" . $id;

            $response = Http::withToken($token)->post($url, [
                "active" => false,
            ]);

            echo $response->successful() . "<br>";

            $url = 'https://www.workplace.com/scim/v1/Users/' . $id;

            $response = Http::withToken($token)->DELETE($url);

            echo $response->successful() . "<br>";
        }
        die();

        /*


        $url = "https://graph.facebook.com/company/members?limit=1500";

        $response = Http::withToken($token)->get($url);

        $ppl = $response->json();

        foreach ($ppl['data'] as $user) {

            $id = $user['id'];
            $name = $user['name'];

            $url = "https://graph.facebook.com/" . $id;

            $response = Http::withToken($token)->post($url, [
                "active" => false,
            ]);

            echo $id;
        }

*/
        $url = "https://graph.facebook.com/company/members?limit=1500";

        $response = Http::withToken($token)->get($url);

        $ppl = $response->json();

        foreach ($ppl['data'] as $user) {

            $id = $user['id'];
            $name = $user['name'];

            $url = "https://www.workplace.com/scim/v1/Users/" . $id;

            $response = Http::withToken($token)->get($url);

            $url = 'https://www.workplace.com/scim/v1/Users/' . 100083807373595;

            $response = Http::withToken($token)->get($url);

            $a = $response->body();

            $user = json_decode($a);

            dd($user->{'urn:scim:schemas:extension:facebook:accountstatusdetails:1.0'});
        }
    }
}
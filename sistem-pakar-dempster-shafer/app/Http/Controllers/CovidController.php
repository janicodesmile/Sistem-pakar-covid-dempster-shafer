<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CovidController extends Controller
{
    public function suspect(){
        $url = file_get_contents('https://data.covid19.go.id/public/api/update.json');
        $data = json_decode($url, true);

        return view('home', compact('$data'));
    }
}

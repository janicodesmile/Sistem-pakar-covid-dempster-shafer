<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\Rule;
use App\Models\Konsultasi;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listpenyakit = Penyakit::all();
        $listgejala = Gejala::all();

        return view('konsultasi.index', compact('listpenyakit', 'listgejala'));
    }
}

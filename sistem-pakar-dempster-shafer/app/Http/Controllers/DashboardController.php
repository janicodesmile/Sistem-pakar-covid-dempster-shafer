<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyakit;
use App\Models\Gejala;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlah_penyakit = Penyakit::all()->count();
        $jumlah_gejala = Gejala::all()->count();

        return view('dashboard', compact('jumlah_penyakit', 'jumlah_gejala'));
    }
}

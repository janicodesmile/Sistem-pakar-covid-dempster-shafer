<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gejala;
use RealRashid\SweetAlert\Facades\Alert;

class GejalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listgejala = Gejala::paginate(10);

        return view('gejala.index', compact('listgejala'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'kode_gejala' => 'unique:gejala|max:5|min:2',            
            'gejala' => 'required'
        ]);

        $penyakit = Gejala::create([
            'kode_gejala' => $request['kode_gejala'],
            'gejala' => $request['gejala']
        ]);

        Alert::success('Success', 'Gejala Baru Berhasil Ditambahkan!');
           
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $gejala = Gejala::find($id);

        $gejala->kode_gejala = $request['kode_gejala'];
        $gejala->gejala = $request['gejala'];
        $gejala->save();

        Alert::success('Success', 'Data Gejala Berhasil Diperbarui!');
           
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gejala = Gejala::findorfail($id);
        $gejala->delete();

        Alert::success('Success', 'Gejala Berhasil Dihapus!');

        return redirect()->back();
    }
}

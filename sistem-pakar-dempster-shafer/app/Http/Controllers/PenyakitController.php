<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyakit;
use RealRashid\SweetAlert\Facades\Alert;

class PenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listpenyakit = Penyakit::all()->sortBy('kode_penyakit');

        return view('penyakit.index', compact('listpenyakit'));
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
            'kode_penyakit' => 'unique:penyakit|max:5|min:2',
            'nama_penyakit' => 'max:25',
            'definisi_penyakit' => 'required',
            'solusi_penyakit' => 'required'
        ]);

        $penyakit = Penyakit::create([
            'kode_penyakit' => $request['kode_penyakit'],
            'nama_penyakit' => $request['nama_penyakit'],
            'definisi_penyakit' => $request['definisi_penyakit'],
            'solusi_penyakit' => $request['solusi_penyakit']
        ]);

        Alert::success('Success', 'Penyakit Baru Berhasil Ditambahkan!');
           
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
        $penyakit = Penyakit::find($id);

        $penyakit->kode_penyakit = $request['kode_penyakit'];
        $penyakit->nama_penyakit = $request['nama_penyakit'];
        $penyakit->definisi_penyakit = $request['definisi_penyakit'];
        $penyakit->solusi_penyakit = $request['solusi_penyakit'];
        $penyakit->save();

        Alert::success('Success', 'Data Penyakit Berhasil Diperbarui!');
           
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
        $penyakit = Penyakit::findorfail($id);
        $penyakit->delete();

        Alert::success('Success', 'Penyakit Berhasil Dihapus!');

        return redirect()->back();
    }
}

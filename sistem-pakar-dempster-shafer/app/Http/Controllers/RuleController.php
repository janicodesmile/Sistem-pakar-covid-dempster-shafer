<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listpenyakit = Penyakit::all();
        $listgejala = Gejala::paginate(10);
        $listgejalarule = Gejala::all();
        $listrule = Rule::all();

        return view('rule.index', compact('listpenyakit', 'listgejala', 'listgejalarule', 'listrule'));
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
        if(!empty($request->input('gejala'))){
            $tampunggejala = [];
            foreach ($request->input('gejala') as $key => $value) {
                $tampunggejala=$value;
                $rule = Rule::create([
                    'id_penyakit' => $request['penyakit'],
                    'bobot' => $request['bobot'],
                    'id_gejala' =>$tampunggejala
                ]);
            }
        }


        Alert::success('Success', 'Rule Baru Berhasil Ditambahkan!');
           
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
        $rule = Rule::find($id);

        $rule->bobot = $request['bobot'];
        $rule->save();

        Alert::success('Success', 'Nilai Bobot Berhasil Diperbarui!');
           
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
        //
    }
}

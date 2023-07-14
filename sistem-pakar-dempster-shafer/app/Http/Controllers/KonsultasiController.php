<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\Rule;
use App\Models\Konsultasi;
use App\Models\Hasil;
use RealRashid\SweetAlert\Facades\Alert;
use DB;
use Auth;

class KonsultasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listpenyakit = Penyakit::all();
        $listgejala = Gejala::all();

        return view('konsultasi.index', compact('listpenyakit', 'listgejala'));
    }

    public function toHome()
    {
        $listpenyakit = Penyakit::all();
        $listgejala = Gejala::all();

        $urlstats = Http::get('https://dekontaminasi.com/api/id/covid19/stats');
        $datacovid = $urlstats->json();

        $urlhospitals = Http::get('https://dekontaminasi.com/api/id/covid19/hospitals');
        $datahospitals = $urlhospitals->json();

        $urlnews = Http::get('https://dekontaminasi.com/api/id/covid19/news');
        $datanews = $urlnews->json();

        $urlhoax = Http::get('https://dekontaminasi.com/api/id/covid19/hoaxes');
        $datahoax = $urlhoax->json();

        // dd($datahospitals);

        return view('home', compact('listpenyakit', 'listgejala', 'datacovid', 'datahospitals', 'datanews', 'datahoax'));
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
            'nama' => 'required|max:45',
            'kelamin' => 'required',
            'umur' => 'max:3',
            'alamat' => 'required',
            'orangtua' => 'required|max:45'
        ]);

        $pasien = Konsultasi::create([
            'nama' => $request['nama'],
            'kelamin' => $request['kelamin'],
            'umur' => $request['umur'],
            'alamat' => $request['alamat'],
            'tanggal' => Carbon\Carbon::now(),
            'orangtua' => $request['orangtua']
        ]);

        Alert::success('Success', 'Data Berhasil Disimpan!');
           
        return redirect('konsultasi/#contact');
    }

    
    public function konsultasi(Request $request)
    {

        $gejalaselected = $request['gejala'];
        $listgejala = Gejala::all();
        $listpenyakit = Penyakit::all();

        DB::statement("SET SQL_MODE=''");

        $data = DB::table('rule')
                ->select('id_gejala', DB::raw('GROUP_CONCAT(bobot) as bobot') , DB::raw('GROUP_CONCAT(kode_penyakit order by kode_penyakit asc) as kode_penyakit'))
                ->join('penyakit', 'id_penyakit', '=', 'penyakit.id')
                ->whereIn('id_gejala', $gejalaselected)
                ->groupBy('id_gejala')
                ->orderBy('id_gejala', 'ASC')
                ->get()->toArray();

        $data2 = DB::table('penyakit')
                ->select(DB::raw('GROUP_CONCAT(kode_penyakit) as kode_penyakit'))
                ->get();
        
                $tot_gejala = count($gejalaselected);

    
        
        $evidence=$data;

        $data3 = array_shift($evidence);

        
        $arraymulti = array();
        $awal = 0;

        foreach($data as $value){
            foreach($listgejala as $gejala){
            if($value->id_gejala == $gejala->id){
               
                  $array_bobot = explode(",",$value->bobot);
                  $arraymulti[$awal] = array($value->id_gejala, $gejala->gejala, $value->kode_penyakit, max($array_bobot), 1 - max($array_bobot) ) ;
                  $awal = $awal+1;
                }
            }
        }

        $kolom = array([ $arraymulti[0][2], $arraymulti[0][3] ], ["{θ}",$arraymulti[0][4]] );
        $tmpkolom = array();
        $total_gejala = $tot_gejala;

        $total_kolom = count($kolom);
        $m = 1;
        for($i=1;$i<$total_gejala;$i++){ 
            $baris = array([ $arraymulti[$i][2], $arraymulti[$i][3] ], ["{θ}",$arraymulti[$i][4]] );
            $total_baris = count($baris);


            for($j = 0; $j < $total_kolom; $j++) {  
                $k = 0;

                $baris_match = explode(",",$baris[0][0]) ;
                $kolom_match = explode(",",$kolom[$j][0]) ;
                if($kolom_match[0] == "{θ}"){
                  $hasil = $baris_match;
                }else{
                  $hasil = array_intersect($kolom_match,$baris_match);
                }

                $tmpkolom[] = array(implode(",",$hasil), $kolom[$j][$k+1] * $baris[0][1] );

                $baris_match = explode(",",$baris[1][0]) ;
                $kolom_match = explode(",",$kolom[$j][0]) ;
                if($kolom_match[0] != "{θ}"){
                    $hasil = $kolom_match;
                }else{
                    $hasil = array_intersect($kolom_match,$baris_match);
                }
                $tmpkolom[] = array(implode(",",$hasil), $kolom[$j][$k+1] * $baris[1][1] );
           
                $k+=1 ;
            }
        

        $temp_array = array(); 
          $x = 0; 
          $key_array = array(); 
          
          foreach($tmpkolom as $val) { 
              if (!in_array($val[0], $key_array)) { 
                  $key_array[$x] = $val[0]; 
                  $temp_array[$x] = $val;

              } 
              $x++; 
          } 
        
          $z=0;
          $temp_array=array_values($temp_array);
          foreach($temp_array as list($a,$b)){
            foreach($tmpkolom as list($c,$d)){
              if($a == $c && $b != $d){
                // dd($temp_array);
                $temp_array[$z][1] += $d;
              }
            }
            $z++;
          }

          $kolom = array_values($temp_array);
          $total_kolom = count($kolom);
          $temp_array = array();
          $tmpkolom = array();

          if($i==$total_gejala-1){
            $nilai = array();
            foreach($kolom as list($a,$b)){ 
              array_push($nilai,$b);
            }
            $maxnilai = max($nilai);

            foreach($kolom as list($a,$b)){
                if($b == $maxnilai){
                  $penyakit = $a;
                  $nilaikepercayaan = $b;
                }
              }
              $penyakit = explode(",",$penyakit);

              $penyakitt = array();
              foreach($penyakit as $hasilp){
                foreach($listpenyakit as $list){
                  if($list->kode_penyakit == $hasilp){
                    array_push($penyakitt,$list->nama_penyakit);
                  }
                }
              }
            $string=implode(",",$penyakitt);
            //Save penyakit

            $hasil = Hasil::create([
                'nama' => Auth::user()->name,
                'diagnosa' =>  $string,
                'persentase' => $nilaikepercayaan*100
            ]);

        }

        }//End Looping


                
        return view('hasil.index', compact('gejalaselected', 'listgejala', 'data', 'data2', 'data3' ,'evidence','tot_gejala','listpenyakit'));
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

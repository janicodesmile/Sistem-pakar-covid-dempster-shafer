@extends('layout/user')


@section('navbar')
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="index.html">Medister</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link" href="/">Beranda</a></li>
          <li><a class="nav-link" href="#departments">Berita</a></li>
          <li><a class="nav-link" href="#contact">Kontak</a></li>
          <li><a class="nav-link" href="#about">Tentang</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="/konsultasi" class="appointment-btn scrollto"><span class="d-none d-md-inline">Ayo Konsultasi!</span></a>

    </div>
@endsection

@section('content')
    <div class="container" style="margin-top: 150px">
        <div class="section-title">
          <h2>Hasil Konsultasi</h2>
        </div>
        {{-- <h2>Gejala yang <strong>{{ Auth::user()->name }}</strong> rasakan adalah sebagai berikut</h2>
          @foreach ($gejalaselected as $item)
          @foreach ($listgejala as $gejala)
          @if ($item == $gejala->id)
          <ul>
              <li class='align-middle'>{{ $gejala->gejala }}</li>
          </ul>
          @endif
            @endforeach
          @endforeach --}}
          <!-- <h3>Densitas m(Awal)</h3> -->
          <table  class="table table-bordered" hidden width="100%" cellspacing="0">
            <tr>
                <th>Kode Gejala</th>
                <th>Nama Gejala</th>
                <th>Penyakit</th>
                <th>Densitas</th>
                <th>Plausability</th>
            </tr>

          <?php

            $arraymulti = array();
            $awal = 0;
          ?>
            
            @foreach ($data as $value)
            @foreach ($listgejala as $gejala)
            @if ($value->id_gejala == $gejala->id)
                <tr>
                  
                  <?php 
                  $array_bobot = explode(",",$value->bobot);
                  $arraymulti[$awal] = array($value->id_gejala, $gejala->gejala, $value->kode_penyakit, max($array_bobot), 1 - max($array_bobot) ) ;
                  $awal = $awal+1;
                  ?>
                    <td class='align-middle'>G{{ $value->id_gejala }}</td>
                    <td class='align-middle'>{{ $gejala->gejala }}</td>
                    <td class='align-middle'>{{ $value->kode_penyakit }}</td>
                    <td class='align-middle'>{{ max($array_bobot) }}</td>
                    <td class='align-middle'>{{ 1 - max($array_bobot) }}</td>

                </tr>
            @endif
            @endforeach
            @endforeach
            <?php

            // dd($arraymulti);
            ?>
          </table>
          {{-- <h3>Menentukan Nilai Densitas (m) Baru</h3> --}}

          <?php
          // $array = array();
          // $array[] = array(1,2);
          // $array[] = array(3,4);
          
          // dd($array);
          $kolom = array([ $arraymulti[0][2], $arraymulti[0][3] ], ["{θ}",$arraymulti[0][4]] );
          
          // dd($arraymulti);
          $tmpkolom = array();
          $total_gejala = $tot_gejala;

          $total_kolom = count($kolom);
          // dd($baris[0][0],$kolom[0][0]);
          $m = 1;


          for($i=1;$i<$total_gejala;$i++){ 


            $baris = array([ $arraymulti[$i][2], $arraymulti[$i][3] ], ["{θ}",$arraymulti[$i][4]] );
            $total_baris = count($baris);
            ?>
             
            <div class="mx-auto col-md-8">
            <table  class='table table-borderless' hidden width='100%' cellspacing='0'>
            @if (!empty($evidence))
            <tr>
                <td colspan='3' class='bg-primary text-white text-center'>Aturan kombinasi untuk m<sub>{{$m+2}}</sub></td>
            </tr>
            <tr>
                <td width='33%' style='border-bottom:1px solid #e3e6f0;'></td>
                <?php for($j = 0; $j < $total_baris; $j++) {  
                  $k = 0;?>
                  <td width='33%' style='border-bottom:1px solid #e3e6f0;'>
                      <span class='Y1'>M<sub>{{$m+1}}</sub>{{$baris[$j][$k]}}<br>{{$baris[$j][$k+1]}}</span>
                  </td>
                <?php  } ?>
                
            </tr>

            <!-- kolom -->

            <?php for($j = 0; $j < $total_kolom; $j++) {  
                  $k = 0;
                  ?>


            <tr>
            <td width='33%' style='border-bottom:1px solid #e3e6f0;'>
                    <span class='Y1'>M<sub>{{$m}}</sub>{{$kolom[$j][$k]}}<br>{{$kolom[$j][$k+1]}} </span>

                    <!--  ($baris[0][0],$kolom[0][0]  ($baris[1][0],$kolom[0][0]
                     ($baris[0][0],$kolom[1][0]  ($baris[1][0],$kolom[1][0]
                     ($baris[0][0],$kolom[2][0]  ($baris[1][0],$kolom[2][0]
                     dd($baris[1][0],$kolom[1][0]); -->
            </td>


            <td width='33%' style='border-bottom:1px solid #e3e6f0;'>
                    <span class='Y1'>
                    <?php    
                    $baris_match = explode(",",$baris[0][0]) ;
                    $kolom_match = explode(",",$kolom[$j][0]) ;
                    if($kolom_match[0] == "{θ}"){
                      $hasil = $baris_match;
                    }else{
                      $hasil = array_intersect($kolom_match,$baris_match);
                    }
                    print_r(implode(",",$hasil));

                    $tmpkolom[] = array(implode(",",$hasil), $kolom[$j][$k+1] * $baris[0][1] );
                     ?>
                    <br>{{$kolom[$j][$k+1] * $baris[0][1] }}</span>
            </td>


            <td width='33%' style='border-bottom:1px solid #e3e6f0;'>

                    <span class='Y1'>
                    <?php    
                    $baris_match = explode(",",$baris[1][0]) ;
                    $kolom_match = explode(",",$kolom[$j][0]) ;
                    if($kolom_match[0] != "{θ}"){
                      $hasil = $kolom_match;
                    }else{
                      $hasil = array_intersect($kolom_match,$baris_match);
                    }
                    $tmpkolom[] = array(implode(",",$hasil), $kolom[$j][$k+1] * $baris[1][1] );
                    print_r(implode(",",$hasil)); ?>
                    <br>{{$kolom[$j][$k+1] * $baris[1][1] }}</span>
            </td>
            </tr>

            <?php  
            
            $k+=1 ;

          } // End Looping





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
          

            
            if($i==$total_gejala-1){?>
            <tr>
            <td colspan='3' >
              <?php 
              $nilai = array();
              foreach($kolom as list($a,$b)){ 
                array_push($nilai,$b);
                ?>
              M<sub>{{$m+2}}</sub> = {{$a}}&nbsp;&nbsp;&nbsp;&nbsp;{{$b}} <br>
              <?php } 
              $maxnilai = max($nilai);
              // dd($nilai,$maxnilai);
              ?>
            </td>
            </tr>

            <tr>
            <td colspan='3' >

            <!-- mencari nilai tertinggi untuk menarik kesimpulan -->
              <?php 
              
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

              
              
              
            $string=implode(", ",$penyakitt); ?>
              
             Terdeteksi penyakit : <b>{{$string}}</b> dengan nilai kepercayaan <b>{{$nilaikepercayaan*100}}%</b>
            </td>
            </tr>
                {{-- <p class="btn btn-primary btn-sm"><b>{{ Auth::user()->name }}</b> didiagnosa mengidap penyakit <b>{{$string}}</b> dengan nilai kepercayaan <b>{{$nilaikepercayaan*100}}%</b></p> --}}
                
              

            <?php 
          
          
          
          }else{
            ?>
            <tr>
            <td colspan='3' >
              <?php foreach($kolom as list($a,$b)){ ?>
              M<sub>{{$m+2}}</sub> = {{$a}}&nbsp;&nbsp;&nbsp;&nbsp;{{$b}} <br>
              <?php } ?>
            </td>
            </tr>

            <?php }
            ?>


            
            @endif
          </table>
          </div>

          <?php 
          $m+=2;
          }
          ?>

          <div class="row">
                <div class="card col-md-8 mx-auto mb-3 border-0 p-0" style="box-shadow: 0px 2px 12px rgba(44, 73, 100, 0.08);">
                  <div class="row g-0">
                    <div class="col-md">
                      <div class="card-body">
                        <h5 class="card-title"><strong>Gejala yang dialami</strong></h5>
                        <hr>
                        @foreach ($gejalaselected as $item)
                        @foreach ($listgejala as $gejala)
                        @if ($item == $gejala->id)
                        <ul>
                            <li class='align-middle'>{{ $gejala->gejala }}</li>
                        </ul>
                        @endif
                          @endforeach
                        @endforeach
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card col-md-8 mx-auto mb-3 border-0 p-0" style="box-shadow: 0px 2px 12px rgba(44, 73, 100, 0.08);">
                <div class="row g-0">
                  <div class="col-md">
                    <div class="card-body">
                      <h5 class="card-title"><strong>Kondisi yang memungkinkan</strong></h5>
                      <hr>
                      <p>
                        {{$string}}
                        <span class="badge bg-primary"><b>{{$nilaikepercayaan*100}}%</b></span>
                      </p>
                      <a class="d-flex justify-content-end align-items-center" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                        <p>Tampilkan detail <i class="fa-solid fa-angle-right"></i></p>
                      </a>
                      <hr>
                      <small>Daftar kemungkinan kondisi mungkin tidak lengkap, <strong>disediakan semata-mata untuk tujuan informasi,</strong> bukan merupakan opini medis yang memenuhi syarat dan <strong>tidak dapat menggantikan diagnosis medis.</strong></small>
                    </div>
                  </div>
                </div>
              </div>

              <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">

              <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasExampleLabel">Solusi</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <hr>
              @foreach($penyakit as $hasilp)
              @foreach($listpenyakit as $list)
              @if($list->kode_penyakit == $hasilp)
              <div class="offcanvas-body">
                <div>
                  <h1>{{$list->nama_penyakit}}</h1>
                  <p>{{$list->solusi_penyakit}}</p>
                </div>
              </div>
              @endif
              @endforeach
              @endforeach


              </div>
          
    </div>
@endsection
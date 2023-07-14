@extends('layout.admin')

@section('content-header')
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fa-solid fa-list"></i> Data Rule
        <button class="btn btn-primary fa-pull-right" data-toggle="modal" data-target="#modal_tambah_rule"><i class="fa-solid fa-plus"></i> Tambah Data</button>
    </h1>
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Basis Pengetahuan</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-primary text-light text-center">
              <tr>
                <th>Kode Gejala - Nama Gejala</th>
                @foreach ($listpenyakit as $item) 
                <th>{{ $item->nama_penyakit }}</th>                                            
                @endforeach
              </tr>
            </thead>
            <tbody>

              @forelse ($listgejala as $item)                                              
                <tr>
                  <td width="50%"><strong>{{ $item->kode_gejala }}</strong> - {{ $item->gejala }}</td>
                  
                  <?php $a=0; ?>
                  @foreach ($listrule as $item2)
                  @if ($item2->id_penyakit==6 )
                    @if("G" . $item2->id_gejala == $item->kode_gejala)
                      <td class="text-center">
                          <h5><a class='badge badge-primary' href="/rule/{{$item2->id}}/edit" data-toggle="modal" data-target="#modal_edit_rule{{$item2->id}}">{{ $item2->bobot }}</a></h5>
                      </td>
                      <?php $a = 1; ?>
                      @break
                    @endif                            
                  @endif
                  @endforeach

                  @if($a==0)
                      <td class="text-center">
                          
                      </td>
                  @endif


                  <?php $a=0; ?>
                  @foreach ($listrule as $item2)
                  @if ($item2->id_penyakit==9 )
                    @if("G" . $item2->id_gejala == $item->kode_gejala)
                      <td class="text-center">
                          <h5><a class='badge badge-primary' href="/rule/{{$item2->id}}/edit" data-toggle="modal" data-target="#modal_edit_rule{{$item2->id}}">{{ $item2->bobot }}</a></h5>
                      </td>
                      <?php $a = 1; ?>
                      @break
                    @endif                            
                  @endif
                  @endforeach

                  @if($a==0)
                      <td class="text-center">
                          
                      </td>
                  @endif

                  
                  {{-- Tifus --}}
                  <?php $a=0; ?>
                  @foreach ($listrule as $item2)
                  @if ($item2->id_penyakit==10 )
                    @if("G" . $item2->id_gejala == $item->kode_gejala)
                      <td class="text-center">
                          <h5><a class='badge badge-primary' href="/rule/{{$item2->id}}/edit" data-toggle="modal" data-target="#modal_edit_rule{{$item2->id}}">{{ $item2->bobot }}</a></h5>
                      </td>
                      <?php $a = 1; ?>
                      @break
                    @endif                            
                  @endif
                  @endforeach

                  @if($a==0)
                      <td class="text-center">
                          
                      </td>
                  @endif


                  {{-- DBD --}}
                  <?php $a=0; ?>
                  @foreach ($listrule as $item2)
                  @if ($item2->id_penyakit==11 )
                    @if("G" . $item2->id_gejala == $item->kode_gejala)
                      <td class="text-center">
                          <h5><a class='badge badge-primary' href="/rule/{{$item2->id}}/edit" data-toggle="modal" data-target="#modal_edit_rule{{$item2->id}}">{{ $item2->bobot }}</a></h5>
                      </td>
                      <?php $a = 1; ?>
                      @break
                    @endif                            
                  @endif
                  @endforeach

                  @if($a==0)
                      <td class="text-center">
                          
                      </td>
                  @endif



                  {{-- <td class="text-center">
                    <button class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#modal_edit_penyakit{{ $item->id }}">Edit</button>
                    <button class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#modal_hapus_penyakit{{ $item->id }}"><i class="fa-solid fa-trash"></i></button>
                  </td> --}}
                </tr>
              @empty
                                            
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
    {{ $listgejala->links() }}

{{-- Modal Tambah Rule --}}
<div class="modal fade" id="modal_tambah_rule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-plus"></i> Tambah Data Rule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('rule.store') }}" method="POST">
            @csrf
            <table class="table table-borderless" width="100%" cellspacing="0">
                <tr>
                  <th colspan="3">IF</th>
                </tr>
                @foreach ($listgejalarule as $item)
                <tr>
                  <td width='5%'>
                    <input type="checkbox" name="gejala[]" value="{{ $item->id }}">
                  </td>
                  <td>{{ $item->kode_gejala }} {{ $item->gejala }} <strong>AND</strong></td>
                </tr>
                @endforeach
                <tr>
                  <th colspan="3">THEN</th>
                </tr>
                <tr>
		          <td colspan="3">
		            <div class="form-row">
		              <select class="form-control col-6" required name="penyakit" id="penyakit">
		                <option value="NULL">--Pilih Penyakit--</option>
                        @foreach ($listpenyakit as $item)
                        @if ($item->id)
                          <option value="{{ $item->id }}" selected>{{ $item->kode_penyakit }} &nbsp;|&nbsp; {{ $item->nama_penyakit }}</option>
                        @else
                          <option value="{{ $item->id }}">{{ $item->nama_penyakit }}</option>
                        @endif
                        @endforeach
            		  </select>
		              <div class="input-group col-6">
                        <div class="input-group-prepend">
                          <span class="input-group-text font-weight-bold" id="bobot">Nilai Bobot</span>
                        </div>
                        <input autocomplete="off" required type="text" name="bobot" class="form-control">
			          </div>
		            </div>
		          </td>
                </tr>
              </table>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="reset" class="btn btn-info"><i class="fa fa-sync-alt"></i> Reset</button>  
              <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- Akhir Modal Tambah Rule --}}

{{-- Modal Edit Rule --}}
@foreach ($listrule as $item2)
<div class="modal fade" id="modal_edit_rule{{$item2->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-plus"></i> Edit Nilai Bobot</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/rule/{{ $item2->id }}" method="POST">
            @csrf
            @method('PUT')
            <table class="table table-borderless text-center" width="100%" cellspacing="0">
                <tr>
                  <th>Kode Gejala</th>
                  <th>Nama Gejala</th>
                  <th>Nilai Bobot</th>
                </tr>
                @foreach ($listgejalarule as $item)
                <tr>
                  @if ("G" . $item2->id_gejala == $item->kode_gejala)
                  <td>{{ $item->kode_gejala }}</td>
                  <td>{{ $item->gejala }}</td>
                  <td>
                    <div class="container">
                      <div class="row justify-content-center">
                        <div class="form-group col-3 align-center ">
                            <input class="form-control text-center" value="{{ $item2->bobot }}" type="text" name="bobot">
                        </div>
                      </div> 
                      </div>
                  </td>                      
                  @endif
                </tr>
                @endforeach
              </table>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <a class="btn btn-danger" href="/rule/{{$item2->id}}" data-toggle="modal" data-target="#modal_hapus_rule{{$item2->id}}">Hapus</a>
              <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
{{-- Akhir Modal Edit Rule --}}

{{-- Modal Hapus Rule --}}
@foreach ($listrule as $item2)
<div class="modal fade" id="modal_hapus_rule{{$item2->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-plus"></i>Hapus Rule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/rule/{{ $item2->id }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="form-group">
              <h4 class="text-center">Apakah anda yakin ingin menghapus rule ini?</h4>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <form action="/rule/{{$item2->id}}" method="POST">
                @csrf
                @method('DELETE')        
                <input type="submit" name="delete" id="delete" value='Hapus' class="btn btn-danger btn-sm">
              </form>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
{{-- Akhir Modal Hapus Rule --}}


@endsection
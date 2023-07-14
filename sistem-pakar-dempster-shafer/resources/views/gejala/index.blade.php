@extends('layout.admin')

@section('content-header')
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fa-solid fa-list"></i> Data Gejala
        <button class="btn btn-primary fa-pull-right" data-toggle="modal" data-target="#modal_tambah_gejala"><i class="fa-solid fa-plus"></i> Tambah Data</button>
    </h1>
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Gejala</h6>
      </div>
      <div class="card-body">
        
        <div class="table-responsive">
          <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-primary text-light">
              <tr>
                <th>Kode Gejala</th>
                <th>Gejala</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($listgejala as $item)                                              
                <tr>
                  <td width="10%">{{ $item->kode_gejala }}</td>
                  <td width="80%">{{ $item->gejala }}</td>
                  <td>
                    <button class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#modal_edit_gejala{{ $item->id }}">Edit</button>
                    <button class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#modal_hapus_gejala{{ $item->id }}"><i class="fa-solid fa-trash"></i></button>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="3" align="center">Belum ada data</td>    
                </tr>                      
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
    {{ $listgejala->links() }}

    {{-- Modal Tambah Gejala --}}
<div class="modal fade" id="modal_tambah_gejala" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-plus"></i> Tambah Data Gejala</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('gejala.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Kode Gejala</label>
                <input type="text" class="form-control" id="kode_gejala" name="kode_gejala" maxlength="5" minlength="2" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label>Gejala</label>
                <textarea class="form-control" id="gejala" name="gejala" required></textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
{{-- Akhir Modal Tambah Gejala --}}

{{-- Modal Edit Gejala --}}
@foreach ($listgejala as $item)
<div class="modal fade" id="modal_edit_gejala{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-pen-to-square"></i> Edit Data Gejala</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/gejala/{{$item->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Kode Gejala</label>
                <input type="text" class="form-control" id="kode_gejala" name="kode_gejala" maxlength="5" minlength="2" autocomplete="off" value="{{ old('kode_gejala', $item->kode_gejala ) }}" required>
            </div>
            <div class="form-group">
                <label>Gejala</label>
                <textarea class="form-control" id="gejala" name="gejala" required>{{ old('gejala', $item->gejala ) }}</textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
{{-- Akhir Modal Edit Gejala --}}

{{-- Modal Hapus gejala --}}
@foreach ($listgejala as $item)
<div class="modal fade" id="modal_hapus_gejala{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Gejala</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <h5 class="text-center">Anda yakin ingin menghapus gejala ini?</h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <form action="/gejala/{{$item->id}}" method="POST">
              @csrf
              @method('DELETE')        
              <input type="submit" name="delete" id="delete" value='Hapus' class="btn btn-danger btn-sm">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endforeach
{{-- Akhir Modal Hapus Gejala --}}
@endsection
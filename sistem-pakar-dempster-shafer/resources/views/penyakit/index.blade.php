@extends('layout.admin')

@section('content-header')
    <h1 class="h3 mb-4 text-gray-800">
        <i class="fa-solid fa-list"></i> Data Penyakit & Solusi
        <button class="btn btn-primary fa-pull-right" data-toggle="modal" data-target="#modal_tambah_penyakit"><i class="fa-solid fa-plus"></i> Tambah Data</button>
    </h1>
@endsection

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Penyakit</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-primary text-light">
              <tr>
                <th>Kode Penyakit</th>
                <th>Nama Penyakit</th>
                <th>Definisi Penyakit</th>
                <th>Solusi Penyakit</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($listpenyakit as $item)                                              
                <tr>
                  <td>{{ $item->kode_penyakit }}</td>
                  <td>{{ $item->nama_penyakit }}</td>
                  <td>{{ $item->definisi_penyakit }}</td>
                  <td>{{ $item->solusi_penyakit }}</td>
                  <td>
                    <button class="btn btn-success btn-sm mr-2" data-toggle="modal" data-target="#modal_edit_penyakit{{ $item->id }}">Edit</button>
                    <button class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#modal_hapus_penyakit{{ $item->id }}"><i class="fa-solid fa-trash"></i></button>
                  </td>
                </tr>
              @empty
                                            
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

{{-- Modal Tambah Penyakit --}}
<div class="modal fade" id="modal_tambah_penyakit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-plus"></i> Tambah Data Penyakit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('penyakit.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Kode Penyakit</label>
                <input type="text" class="form-control" id="kode_penyakit" name="kode_penyakit" maxlength="5" minlength="2" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label>Nama Penyakit</label>
                <input type="text" class="form-control" id="nama_penyakit" name="nama_penyakit" autocomplete="off" required>
            </div>
            <div class="form-group">
                <label>Definisi Penyakit</label>
                <textarea class="form-control" id="definisi_penyakit" name="definisi_penyakit" required></textarea>
            </div>
            <div class="form-group">
                <label>Solusi Penyakit</label>
                <textarea class="form-control" id="solusi_penyakit" name="solusi_penyakit" required></textarea>
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
{{-- Akhir Modal Tambah Penyakit --}}

{{-- Modal Edit Penyakit --}}
@foreach ($listpenyakit as $item)
<div class="modal fade" id="modal_edit_penyakit{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-pen-to-square"></i> Edit Data Penyakit - {{ $item->nama_penyakit }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/penyakit/{{$item->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Kode Penyakit</label>
                <input type="text" class="form-control" id="kode_penyakit" name="kode_penyakit" maxlength="5" minlength="2" autocomplete="off" value="{{ old('kode_penyakit', $item->kode_penyakit ) }}" required>
            </div>
            <div class="form-group">
                <label>Nama Penyakit</label>
                <input type="text" class="form-control" id="nama_penyakit" name="nama_penyakit" autocomplete="off" value="{{ old('nama_penyakit', $item->nama_penyakit ) }}" required>
            </div>
            <div class="form-group">
                <label>Definisi Penyakit</label>
                <textarea class="form-control" id="definisi_penyakit" name="definisi_penyakit" required>{{ old('definisi_penyakit', $item->definisi_penyakit ) }}</textarea>
            </div>
            <div class="form-group">
                <label>Solusi Penyakit</label>
                <textarea class="form-control" id="solusi_penyakit" name="solusi_penyakit" required>{{ old('solusi_penyakit', $item->solusi_penyakit ) }}</textarea>
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
{{-- Akhir Modal Edit Penyakit --}}

{{-- Modal Hapus Penyakit --}}
@foreach ($listpenyakit as $item)
<div class="modal fade" id="modal_hapus_penyakit{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Hapus Penyakit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <h5 class="text-center">Anda yakin ingin menghapus penyakit ini?</h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
            <form action="/penyakit/{{$item->id}}" method="POST">
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
{{-- Akhir Modal Hapus Penyakit --}}
@endsection
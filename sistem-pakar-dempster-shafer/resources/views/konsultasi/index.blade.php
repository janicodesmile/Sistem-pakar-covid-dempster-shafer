@extends('layout/user')

@section('navbar')
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto">
        <a href="index.html">Medister</a>
      </h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <li><a class="nav-link" href="/">Beranda</a></li>
          <li><a class="nav-link" href="#about">Tentang</a></li>
          <li><a class="nav-link" href="#departments">Berita</a></li>
          <li><a class="nav-link" href="#contact">Kontak</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="/konsultasi" class="appointment-btn scrollto">
        <span class="d-none d-md-inline">Ayo Konsultasi!</span>
      </a>

    </div>
@endsection

@section('content')
<main id="main" style="margin-top: 115px">

<!-- ======= Contact Section ======= -->
  @guest
    <section id="contact" class="contact">
      <div class="container">
        <div class="section-title">
          <h2>Daftarkan diri anda terlebih dahulu!</h2>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-lg mt-5 mt-lg-0">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('Daftar') }}</div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nama') }}</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="umur" class="col-md-4 col-form-label text-md-end">{{ __('Umur') }}</label>
                                        <div class="col-md-6">
                                            <input id="umur" type="text" class="form-control @error('umur') is-invalid @enderror" name="umur" value="{{ old('umur') }}" required autocomplete="umur">
                                            @error('umur')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="jeniskelamin" class="col-md-4 col-form-label text-md-end">{{ __('Jenis Kelamin') }}</label>
                                        <div class="col-md-6">
                                            <select class="form-select" id="jeniskelamin" name="jeniskelamin">
                                              <option selected hidden>Belum Dipilih</option>
                                              <option value="Pria">Pria</option>
                                              <option value="Wanita">Wanita</option>
                                            </select>
                                            @error('jeniskelamin')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="alamat" class="col-md-4 col-form-label text-md-end">{{ __('Alamat') }}</label>
                                        <div class="col-md-6">
                                            <input id="alamat" type="text" class="form-control" name="alamat" required>
                                            @error('alamat')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="orangtua" class="col-md-4 col-form-label text-md-end">{{ __('Nama Orang Tua') }}</label>
                                        <div class="col-md-6">
                                            <input id="orangtua" type="text" class="form-control" name="orangtua" required>
                                            @error('orangtua')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Daftar') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<!-- End Contact Section -->
  
  @if (Route::has('register'))
  
  @endif
  @else
  <!-- ======= Departments Section ======= -->
    <section id="departments" class="departments">
      <div class="container">
        <div class="section-title">
          <h2>Pilih gejala yang dirasakan</h2>
        </div>
        <div class="row gy-4">
          <div class="col-lg">
            <form method="POST" action="/konsultasi">
              @csrf
              <table class="table table-borderless" width="100%">
                @foreach ($listgejala as $item)
                  <tr>
                    <td class='align-middle' width="2%">
                      <input type='checkbox' name='gejala[]' value='{{ $item->id }}'>                      
                    </td>
                    <td class='align-middle'>
                      {{ $item->gejala }}
                    </td>
                  </tr>             
                @endforeach
                </table>
              <div class="text-center">
                <button type="submit" class="btn btn-success">
                  <i class="fa fa-check"></i> Proses
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  <!-- End Departments Section -->
  @endguest
  
 
</main><!-- End #main -->
@endsection

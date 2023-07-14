@extends('layout/user')

@section('hero')
    <section id="hero-img" class="d-flex align-items-center">
    <div class="container">
      <h1>Selamat datang di Medister</h1>
      <h6>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Id deleniti quaerat autem vel aliquid, molestias laboriosam numquam adipisci nisi voluptate architecto nam qui aspernatur veniam recusandae ipsa possimus voluptates porro.</h6>
      <a href="#about" class="btn-get-started scrollto">Selengkapnya</a>
    </div>
</section><!-- End Hero -->
@endsection

@section('content')
<main id="main">
    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container">

          <div class="col-lg d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                @foreach ($listpenyakit as $item)                                   
                <div class="col-xl-3 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="fa-solid fa-virus-covid"></i>
                    <h4>{{ $item->nama_penyakit }}</h4>
                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ex, placeat facere. Maiores ea iure nobis, id aspernatur quia animi inventore tempora perspiciatis, magnam rem dolorum laborum non amet sequi saepe!</p>
                  </div>
                </div>
                @endforeach
                </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

  <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">
        <div class="section-title mb-3">
          <h2>Sebaran Covid</h2>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6 text-light">
            <div class="count-box bg-danger">
              <i class="fas fa-user-md bg-danger"></i>
              <span data-purecounter-start="0"  data-purecounter-end="{{ $datacovid['numbers']['infected'] }}" data-purecounter-duration="1" class="text-light purecounter"></span>
              <p>Kasus Positif</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 text-light">
            <div class="count-box bg-success">
              <i class="fas fa-user-md bg-success"></i>
              <span data-purecounter-start="0" data-purecounter-end="{{ $datacovid['numbers']['recovered'] }}" data-purecounter-duration="1" class="text-light purecounter"></span>
              <p>Pasien Sembuh</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 text-light">
            <div class="count-box bg-warning">
              <i class="fas fa-user-md bg-warning"></i>
              <span data-purecounter-start="0" data-purecounter-end="{{ $datacovid['numbers']['fatal'] }}" data-purecounter-duration="1" class="text-light purecounter"></span>
              <p>Kasus Meninggal</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  <!-- End Counts Section -->

  <!-- ======= Berita Section ======= -->
    <section id="berita" class="testimonials">
      <div class="container">
        <div class="section-title">
          <h2>Informasi Terkini</h2>
        </div>
        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
            @foreach ($datanews as $item)        
            <div class="swiper-slide">
              <div class="testimonial-wrap">
                <div class="testimonial-item">
                  <h2>{{ Str::limit($item['title'], 75) }}</h2>
                  <h4>{{ date('D m/d H:i:s', $item['timestamp']) }}</h4>
                  <p>
                    <a href="{{ $item['url'] }}">Cek berita selengkapnya disini!</a>
                  </p>
                </div>
              </div>
            </div><!-- End testimonial item -->
            @endforeach
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section>
  <!-- End Berita Section -->

  <!-- ======= Periksa Fakta Section ======= -->
    <section id="periksafakta" class="gallery">
      <div class="container">

        <div class="section-title">
          <h2>Berita Hoax</h2>
        </div>
      </div>

      <div class="container">
        <div class="row g-0">

          @foreach ($datahoax as $item)
              
          <div class="col-lg-3 col-md-4">
            <div class="card-body">
              <a href="{{ $item['url'] }}">
                {{ $item['title'] }}
              </a>
            </div>
          </div>

          @endforeach

        </div>

      </div>
    </section>
  <!-- End Periksa Fakta Section -->


    <!-- ======= Rujukan Section ======= -->
    <section id="rujukan" class="doctors">
      <div class="container">

        <div class="section-title">
          <h2>Rumah Sakit Rujukan</h2>
          <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="row">
          @foreach ($datahospitals as $item)
          <div class="col-lg-6 mb-3">
            <div class="member d-flex align-items-start">
              <div class="member-info">
                <h4>{{ $item['name'] }}</h4>
                <span>{{ $item['region'] }}</span>
                <p>{{ $item['address'] }} <strong>{{ $item['phone'] }}</strong></p>
              </div>
            </div>
          </div>
          @endforeach
        </div>

      </div>
    </section>
    <!-- End Rujukan Section -->
</main><!-- End #main -->
@endsection
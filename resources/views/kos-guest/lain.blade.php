<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-Kos</title>

    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="description" content="Tempat Cari Kos" />
    <meta name="keywords" content="E-Kos" />
    <meta name="author" content="SobatWeb" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1"
    />

    <link rel="stylesheet" href="{{ URL::asset('/assets/guest/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/guest/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/guest/css/aos.css')}}" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/guest/css/owl.carousel.min.css')}}" />
    <link rel="stylesheet" href="{{ URL::asset('/assets/guest/css/owl.theme.default.min.css')}}" />

    <!-- CSS -->
    <link rel="stylesheet" href="{{ URL::asset('/assets/guest/css/custom.css')}}" />
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="index.html">
          <i class="fa fa-home"></i>
          E-Kos
        </a>

        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="#about" class="nav-link smoothScroll">About Us</a>
            </li>
            <li class="nav-item">
              <a href="#gallery" class="nav-link smoothScroll">Gallery</a>
            </li>
            <li class="nav-item">
              <a href="#testimony" class="nav-link">Testimony</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link contact">
                <i class="fa fa-whatsapp"></i> &nbsp; Whatsapp
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Banner -->
    <section
      class="hero hero-bg d-flex justify-content-center align-items-center"
    >
      <div class="container">
        <div class="row">
          <div
            class="col-lg-6 col-md-10 col-12 d-flex flex-column justify-content-center align-items-center"
          >
            <div class="hero-text">
              <h1 class="text-white" data-aos="fade-up">
                Cari kos-kosan bisa lebih mudah dengan E-kos
              </h1>

              <a
                href="#"
                class="custom-btn btn-bg btn mt-3"
                data-aos="fade-up"
                data-aos-delay="100"
                >Hubungi Kami!</a
              >
            </div>
          </div>

          <div class="col-lg-6 col-12">
            <div class="hero-image" data-aos="fade-up" data-aos-delay="300">
              <img
                src="{{ URL::asset('/assets/guest/images/boarding-house.png')}}"
                class="img-fluid"
                alt="working girl"
              />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About -->
    <section class="about section-padding pb-0" id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-7 mx-auto col-md-10 col-12">
            <div class="about-info">
              <h2 class="mb-4" data-aos="fade-up">E <strong>Kos</strong></h2>

              <p class="mb-0" data-aos="fade-up">
                Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard dummy
                text ever since the 1500s, when an unknown printer took a galley
                of type and scrambled it to make a type specimen book. It has
                survived not only five centuries, but also the leap into
                electronic typesetting, remaining essentially unchanged. It was
                popularised in the 1960s with the release of Letraset sheets
                containing Lorem Ipsum passages, and more recently with desktop
                publishing software like Aldus PageMaker including versions of
                Lorem Ipsum.
              </p>
            </div>

            <div class="about-image" data-aos="fade-up" data-aos-delay="200">
              <img src="{{ URL::asset('/assets/guest/images/office.png')}}" class="img-fluid" alt="office" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Gallery -->
    <section class="gallery section-padding" id="gallery">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12 col-12">
            <h2 class="mb-5 text-center" data-aos="fade-up">
              Gallery <br />
              <strong>Select your best place</strong>
            </h2>

            <div class="owl-carousel owl-theme" id="gallery-slide">
              <div
                class="item gallery-wrapper"
                data-aos="fade-up"
                data-aos-delay="100"
              >
                <img
                  src="{{ URL::asset('/assets/guest/images/gallery/gallery-1.png')}}"
                  alt="gallery image"
                  height="500px"
                />

                <div class="gallery-info">
                  <small>Tipe Rafelia</small>

                  <h3>
                    <span>Rp 650.000 / Bulan</span>
                  </h3>
                </div>
              </div>

              <div class="item gallery-wrapper" data-aos="fade-up">
                <img
                  src="{{ URL::asset('/assets/guest/images/gallery/gallery-2.png')}}"
                  alt="gallery image"
                  height="500px"
                />

                <div class="gallery-info">
                  <small>Tipe Azalea</small>

                  <h3>
                    <span>Rp 800.000 / Bulan</span>
                  </h3>
                </div>
              </div>

              <div class="item gallery-wrapper" data-aos="fade-up">
                <img
                  src="{{ URL::asset('/assets/guest/images/gallery/gallery-3.png')}}"
                  alt="gallery image"
                  height="500px"
                />

                <div class="gallery-info">
                  <small>Tipe Raspberry</small>

                  <h3>
                    <span>Rp 750.000 / Bulan</span>
                  </h3>
                </div>
              </div>

              <div class="item gallery-wrapper" data-aos="fade-up">
                <img
                  src="{{ URL::asset('/assets/guest/images/gallery/gallery-4.png')}}"
                  alt="gallery image"
                  height="500px"
                />

                <div class="gallery-info">
                  <small>Tipe Blueberry</small>

                  <h3>
                    <span>Rp 1.500.000 / Bulan</span>
                  </h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimony -->
    <section class="testimonial section-padding" id="testimony">
      <h2 class="mb-5 text-center" data-aos="fade-up">
        Testimonial <br />
        <strong>Check this out</strong>
      </h2>
      <div class="owl-carousel owl-theme" id="testimony-slide">
        <div
          class="item testimony-wrapper"
          data-aos="fade-up"
          data-aos-delay="100"
        >
          <div class="quote" data-aos="fade-up" data-aos-delay="200"></div>

          <h2 class="mb-4" data-aos="fade-up" data-aos-delay="300">
            Lorem ipsum Sed eiusmod esse aliqua sed incididunt aliqua incididunt
            mollit id et sit proident dolor nulla sed commodo.
          </h2>

          <p data-aos="fade-up" data-aos-delay="400">
            <strong>Mary Zoe</strong>
          </p>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 mx-lg-auto col-md-8 col-10">
            <h1 class="text-white" data-aos="fade-up" data-aos-delay="100">
              E <strong>Kos</strong>
            </h1>
          </div>

          <div
            class="col-lg-3 col-md-6 col-12"
            data-aos="fade-up"
            data-aos-delay="200"
          >
            <h4 class="my-4">Contact Info</h4>

            <p class="mb-1">
              <i class="fa fa-phone mr-2 footer-icon"></i>
              +62 812 3465 6564
            </p>

            <p>
              <a href="#">
                <i class="fa fa-envelope mr-2 footer-icon"></i>
                admin@kos.com
              </a>
            </p>
          </div>

          <div
            class="col-lg-3 col-md-6 col-12"
            data-aos="fade-up"
            data-aos-delay="300"
          >
            <h4 class="my-4">Our Place</h4>

            <p class="mb-1">
              <i class="fa fa-home mr-2 footer-icon"></i>
              Jalan yang di ridhoi ALlah
            </p>
          </div>

          <div
            class="col-lg-3 mx-lg-auto col-md-6 col-12"
            data-aos="fade-up"
            data-aos-delay="600"
          >
            <ul class="social-icon">
              <li><a href="#" class="fa fa-instagram"></a></li>
              <li><a href="#" class="fa fa-twitter"></a></li>
              <li><a href="#" class="fa fa-whatsapp"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ URL::asset('/assets/guest/js/jquery.min.js')}}"></script>
    <script src="{{ URL::asset('/assets/guest/js/bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('/assets/guest/js/aos.js')}}"></script>
    <script src="{{ URL::asset('/assets/guest/js/owl.carousel.min.js')}}"></script>
    <script src="{{ URL::asset('/assets/guest/js/smoothscroll.js')}}"></script>
    <script src="{{ URL::asset('/assets/guest/js/custom.js')}}"></script>
  </body>
</html>

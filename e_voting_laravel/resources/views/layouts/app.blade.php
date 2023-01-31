<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Dashboard - {{ config('app.name') }} </title>
    <!-- CSS files -->
    <link href="{{url('/')}}/dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="{{url('/')}}/dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="{{url('/')}}/dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="{{url('/')}}/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="{{url('/')}}/dist/css/demo.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css" integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script src="{{url('/')}}/dist/js/tabler.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

  </head>
  <body >
    <div class="page">
      <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-xl">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
          </button>
          @auth
          <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="/home">
              <img src="https://res.cloudinary.com/simaya/image/upload/v1659407848/zyro-image_2_haq7yz.png" style="width: 35px">
            </a>
          </h1>
          @else
          <h1 class="navbar-brand p-0 m-0 navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
            <a href="/home">
              <img src="{{config('app.logo')}}" style="width: 220px">
            </a>
          </h1>
          @endauth
          <div class="navbar-nav flex-row order-md-last">
            <div class="nav-item d-none d-md-flex me-3">
              
            </div>
            <div class="d-none d-md-flex">
              
            </div>
            
            @auth
              <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                  @if(Auth::user()->role == 'bupati' or Auth::user()->role == 'wakil_bupati')
                    <span class="avatar avatar-sm" style="background-image: url('{{url('img/calon' . '/' . Auth::user()->foto_calon_bupati_wakil)}}')"></span>
                  @else
                    <span class="avatar avatar-sm" style="background-image: url('https://res.cloudinary.com/simaya/image/upload/v1659408400/60111_ca128t.jpg')"></span>
                  @endif
                  <div class="d-none d-xl-block ps-2">
                    <div>
                      {{ Auth::user()->name }}
                    </div>
                    <div class="mt-1 small text-muted">
                      {{ ucwords(Auth::user()->role) }}
                    </div>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  @if (Auth::user()->role == 'bupati' or Auth::user()->role == 'wakil_bupati')
                    <a href="{{url('calon/profil')}}" class="dropdown-item">Profile</a>
                    <div class="dropdown-divider"></div>
                  @endif

                  <a href="{{route('logout')}}" class="dropdown-item">Logout</a>
                </div>
              </div>
            @endauth
          </div>
        </div>
      </header>
      <div class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
          <div class="navbar navbar-light">
            <div class="container-xl">
              <ul class="navbar-nav">
                
                <li class="nav-item">
                  <a class="nav-link" href="/" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Beranda
                    </span>
                  </a>
                </li>

                @guest
                <li class="nav-item">
                    <a class="nav-link" href="/login">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-login" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                              <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                              <path d="M20 12h-13l3 -3m0 6l-3 -3"></path>
                           </svg>
                        </span>
                        <span class="nav-link-title">
                            Login
                        </span>
                    </a>
                </li>
                @endguest
                
                @auth
                  {{-- Navigasi untuk admin --}}
                  @if (Auth::user()->role == 'admin')
                  <li class="nav-item">
                      <a class="nav-link" href="{{route('users.index')}}">
                          <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user"
                                  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                  fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                  <circle cx="12" cy="7" r="4"></circle>
                                  <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                              </svg>
                          </span>
                          User
                          <span class="nav-link-title">
                      </a>
                      </span>
                  <li class="nav-item">
                  </li>

                  <li class="nav-item">
                      <a class="nav-link" href="{{url('calon/bupati')}}">
                          <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                                  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                  fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                  <circle cx="9" cy="7" r="4"></circle>
                                  <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                  <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                  <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                              </svg>
                          </span>
                          Calon Bupati
                          <span class="nav-link-title">
                      </a>
                      </span>
                    <li class="nav-item"></li>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link" href="{{url('calon/wakil_bupati')}}">
                          <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                                  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                  fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                  <circle cx="9" cy="7" r="4"></circle>
                                  <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                  <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                  <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                              </svg>
                          </span>
                          Calon Wakil Bupati
                          <span class="nav-link-title">
                      </a>
                      </span>
                    <li class="nav-item"></li>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link" href="{{url('calon/pasangan')}}">
                          <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users"
                                  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                  fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                  <circle cx="9" cy="7" r="4"></circle>
                                  <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                  <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                  <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                              </svg>
                          </span>
                          Pasangan Calon
                          <span class="nav-link-title">
                      </a>
                      </span>
                    <li class="nav-item"></li>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link" href="{{url('/hasil-voting')}}">
                          <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-bar"
                                  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                  fill="none" stroke-linecap="round" stroke-linejoin="round">
                                  <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                  <rect x="3" y="12" width="6" height="8" rx="1"></rect>
                                  <rect x="9" y="8" width="6" height="12" rx="1"></rect>
                                  <rect x="15" y="4" width="6" height="16" rx="1"></rect>
                                  <line x1="4" y1="20" x2="18" y2="20"></line>
                              </svg>
                          </span>
                          Hasil Voting
                          <span class="nav-link-title">
                      </a>
                      </span>
                    <li class="nav-item"></li>
                  </li>

                  {{-- Navigasi untuk calon --}}  
                  @elseif (Auth::user()->role == 'bupati' or Auth::user()->role == 'wakil_bupati')                  {{-- Navigasi untuk user --}}

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('calon/profil')}}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                   <circle cx="12" cy="12" r="9"></circle>
                                   <circle cx="12" cy="10" r="3"></circle>
                                   <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
                                </svg>
                            </span>
                            Profil
                            <span class="nav-link-title">
                        </a>
                        </span>
                      <li class="nav-item"></li>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/hasil-voting')}}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-bar"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <rect x="3" y="12" width="6" height="8" rx="1"></rect>
                                    <rect x="9" y="8" width="6" height="12" rx="1"></rect>
                                    <rect x="15" y="4" width="6" height="16" rx="1"></rect>
                                    <line x1="4" y1="20" x2="18" y2="20"></line>
                                </svg>
                            </span>
                            Hasil Voting
                            <span class="nav-link-title">
                        </a>
                        </span>
                      <li class="nav-item"></li>
                    </li>

                  {{-- Navigasi untuk user --}}
                  @else 
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/hasil-voting')}}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chart-bar"
                                    width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <rect x="3" y="12" width="6" height="8" rx="1"></rect>
                                    <rect x="9" y="8" width="6" height="12" rx="1"></rect>
                                    <rect x="15" y="4" width="6" height="16" rx="1"></rect>
                                    <line x1="4" y1="20" x2="18" y2="20"></line>
                                </svg>
                            </span>
                            Hasil Voting
                            <span class="nav-link-title">
                        </a>
                        </span>
                      <li class="nav-item"></li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('bukti_pemilihan' . '/' . base64_encode(Auth::user()->id) )}}">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <!-- Download SVG icon from http://tabler-icons.io/i/checkbox -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-article" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                   <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                   <rect x="3" y="4" width="18" height="16" rx="2"></rect>
                                   <path d="M7 8h10"></path>
                                   <path d="M7 12h10"></path>
                                   <path d="M7 16h10"></path>
                                </svg>
                            </span>
                            Cetak Bukti Pemilihan
                            <span class="nav-link-title">
                        </a>
                        </span>
                      <li class="nav-item"></li>
                    </li>
                  @endif

                  <li class="nav-item">
                      <a class="nav-link" href="/logout">
                          <span class="nav-link-icon d-md-none d-lg-inline-block">
                              <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-login" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                                <path d="M20 12h-13l3 -3m0 6l-3 -3"></path>
                             </svg>
                          </span>
                          <span class="nav-link-title">
                              Keluar
                          </span>
                      </a>
                  </li>

                @endauth

                
                {{-- <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
                    <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/lifebuoy -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="4" /><circle cx="12" cy="12" r="9" /><line x1="15" y1="15" x2="18.35" y2="18.35" /><line x1="9" y1="15" x2="5.65" y2="18.35" /><line x1="5.65" y1="5.65" x2="9" y2="9" /><line x1="18.35" y1="5.65" x2="15" y2="9" /></svg>
                    </span>
                    <span class="nav-link-title">
                      Help
                    </span>
                  </a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="./docs/index.html">
                      Documentation
                    </a>
                    <a class="dropdown-item" href="./changelog.html">
                      Changelog
                    </a>
                    <a class="dropdown-item" href="https://github.com/tabler/tabler" target="_blank" rel="noopener">
                      Source code
                    </a>
                    <a class="dropdown-item text-pink" href="https://github.com/sponsors/codecalm" target="_blank" rel="noopener">
                      <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 13.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
                      Sponsor project!
                    </a>
                  </div>
                </li> --}}
              </ul>
              <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="page-wrapper">
        <div class="container-xl">
        </div>
        <div class="page-body" id="pageBodyKonten">   
            
          <div class="container-xl d-flex flex-column justify-content-center">

            @if (session()->has('success'))
                <div onclick="$(this).slideUp()" style="cursor: pointer" class="alert alert-success">
                    <b>Berhasil!</b> {{ session()->get('success') }}
                </div>
            @endif

            @if (session()->has('info'))
                <div onclick="$(this).slideUp()" style="cursor: pointer" class="alert alert-info">
                    <b>Informasi!</b> {{ session()->get('info') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div onclick="$(this).slideUp()" style="cursor: pointer" class="alert alert-error">
                  <b>Peringatan!</b> {{ session()->get('error') }}
                </div>
            @endif

            @if (session()->has('warning'))
                <div onclick="$(this).slideUp()" style="cursor: pointer" class="alert alert-warning">
                  <b>Peringatan!</b> {{ session()->get('warning') }}
                </div>
            @endif

            @if ($title ?? $title = "Dashboard")
              <h2>
                {{ $title }}
              </h2>
            @endif

            @if (isset($contentStyle) and $contentStyle != "card")
              @yield('content')
            @else
              <div class="card">
                <div class="card-body">
                  @yield('content')
                </div>
              </div>
            @endif

          </div>
        </div>
        <footer class="footer footer-transparent d-print-none">
          <div class="container-xl">
            <div class="row text-center align-items-center flex-row-reverse">
              <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item"><a href="/" class="link-secondary">Beranda</a></li>
                  <li class="list-inline-item"><a href="{{route('logout')}}" class="link-secondary">Keluar</a></li>
                </ul>
              </div>
              <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                  <li class="list-inline-item">
                    Copyright &copy; {{ date("Y") }}
                    
                    {{config('app.name')}}
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>

    <script>
      $('#pageBodyKonten table').DataTable();
    </script>
  </body>
</html>
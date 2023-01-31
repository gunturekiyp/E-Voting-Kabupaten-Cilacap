<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Forgot password - {{config('app.name')}} </title>
    <!-- CSS files -->
    <link href="{{url('/')}}/dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="{{url('/')}}/dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="{{url('/')}}/dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="{{url('/')}}/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="{{url('/')}}/dist/css/demo.min.css" rel="stylesheet"/>
  </head>
  <body  class=" border-top-wide border-primary d-flex flex-column">
    <div class="page page-center">
      <div class="container-tight py-4">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form class="card card-md" action="" method="post">
            @csrf
          <div class="card-body">
            <h2 class="card-title text-center mb-4">Lupa Password</h2>
            <div class="mb-3">
              <label class="form-label">Email/NIK/Username</label>
              <input type="text" required name="login" class="form-control" placeholder="Enter email">
            </div>
            <div class="mb-3">
              <label class="form-label">Buat password baru</label>
              <input type="password" required name="password" class="form-control" placeholder="Enter password">
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">
                Reset password
              </button>
            </div>
          </div>
        </form>
        <div class="text-center text-muted mt-3">
          Saya sudah ingat, <a href="{{url('login')}}">kembali</a> ke halaman login
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="{{url('/')}}/dist/js/tabler.min.js" defer></script>
    <script src="{{url('/')}}/dist/js/demo.min.js" defer></script>
  </body>
</html>
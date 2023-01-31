@extends('layouts.app', ['contentStyle' => 'no-card', 'title' => "Pendaftaran Calon"])

@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name">Nama</label>
                            <input type="text" required class="form-control" name="name" id="name" placeholder="Nama">
                        </div>
            
                        <div class="form-group mb-3">
                            <label for="username">Username</label>
                            <input type="text" required class="form-control" name="username" id="username" placeholder="Username">
                        </div>
            
                        <div class="form-group mb-3">
                            <label for="nik">NIK</label>
                            <input type="text" required class="form-control" name="nik" id="nik" placeholder="NIK">
                        </div>
            
                        <div class="form-group mb-3">
                            <label for="nohp">Nomor HP</label>
                            <input type="text" required class="form-control" name="nohp" id="nohp" placeholder="Nomor HP">
                        </div>
            
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" required class="form-control" name="email" id="email" placeholder="Email">
                        </div>
            
                        <div class="form-group mb-3">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-select" required>
                                <option selected disabled value="">Pilih Role</option>
                                <option value="bupati">Bupati</option>
                                <option value="wakil_bupati">Wakil Bupati</option>
                            </select>
                        </div>
            
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" required class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                    </div>
                </div>    
            </div>
            <div class="col-lg-4 col-sm-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="visi">Visi</label>
                            <input type="text" required class="form-control" name="visi" id="visi" placeholder="Visi">
                        </div>
                        <div class="form-group mb-3">
                            <label for="misi">Misi</label>
                            <input type="text" required class="form-control" name="misi" id="misi" placeholder="Misi">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_tambahan_calon">Deskripsi Calon</label>
                            <textarea name="deskripsi_tambahan_calon" required class="form-control" placeholder="Ceritakan sedikit tentang dirimu" id="deskripsi_tambahan_calon" rows="4"></textarea>
                        </div>
                    </div>
                </div>    
                <div class="card">
                    <div class="card-body">
                        <img src="" id="preview" alt="" class="w-100" srcset="">
                        <div class="form-group mt-3">
                            <label for="foto_calon_bupati_wakil">Foto Calon</label>
                            <input accept=".jpg, .jpeg, .png" type="file" class="form-control" name="foto_calon_bupati_wakil" required id="foto_calon_bupati_wakil">
                        </div>
                    </div>
                </div>    
            </div>
        </div>

        <br>

        <button class="btn btn-primary" type="submit"> 
            Simpan
        </button>
    </form>

    <script>
        foto_calon_bupati_wakil.onchange = evt => {
          const [file] = foto_calon_bupati_wakil.files
          if (file) {
            preview.src = URL.createObjectURL(file)
          }
        }
    </script>
@endsection
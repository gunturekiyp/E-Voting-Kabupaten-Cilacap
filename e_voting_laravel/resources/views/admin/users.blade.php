@extends('layouts.app')

@section('content')
<!-- Button to Open the Modal -->
<div class="d-flex justify-content-end align-content-end">
    <button type="button" class="btn btn-success" onclick="$('#addUser').modal('show')">
        Tambah
    </button>
</div>

<br><br>

<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>No HP</th>
            <th>NIK</th>
            <th>Role</th>
            <th>Sudah memilih</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->nohp }}</td>
            <td>{{ $user->nik }}</td>
            <td>{{ $user->role }}</td>
            <td>
                @if ($user->role == 'user')
                    @if (\App\Models\jumlahPemilih::where('id_pemilih', $user->id) -> first())
                        <span class="badge badge-success bg-success">Sudah memilih</span>
                    @else
                        <span class="badge badge-warning bg-warning">Belum memilih</span>
                    @endif
                @endif
            </td>
            <td>
                <form action="{{route('users.destroy', $user->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="editUser('{{$user->id}}')" class="btn btn-sm btn-primary">
                        Edit
                    </button>
                    <button type="submit" class="btn btn-sm btn-danger">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>No HP</th>
            <th>NIK</th>
            <th>Role</th>
            <th>Sudah memilih</th>
            <th>Aksi</th>
        </tr>
    </tfoot>
</table>

<!-- The Modal -->
<div class="modal fade" id="addUser">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah User</h4>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          <form action="{{route('users.store')}}" method="post">
            @csrf

            <div class="form-group mb-2">
                <label for="name">Nama</label>
                <input type="text" required class="form-control" name="name" id="name" placeholder="Nama">
            </div>

            <div class="form-group mb-2">
                <label for="username">Username</label>
                <input type="text" required class="form-control" name="username" id="username" placeholder="Username">
            </div>

            <div class="form-group mb-2">
                <label for="nik">NIK</label>
                <input type="text" required class="form-control" name="nik" id="nik" placeholder="NIK">
            </div>

            <div class="form-group mb-2">
                <label for="nohp">Nomor HP</label>
                <input type="text" required class="form-control" name="nohp" id="nohp" placeholder="Nomor HP">
            </div>

            <div class="form-group mb-2">
                <label for="email">Email</label>
                <input type="email" required class="form-control" name="email" id="email" placeholder="Email">
            </div>

            <div class="form-group mb-2">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-select" required>
                    <option selected disabled value="">Pilih Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="password">Password</label>
                <input type="password" required class="form-control" name="password" id="password" placeholder="Password">
            </div>
          </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button onclick="$('#addUser form').submit()" type="button" class="btn btn-primary" >Simpan</button>
        </div>
  
      </div>
    </div>
  </div>

<div class="modal fade" id="editUser">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit User</h4>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
          <form action="" method="post">
            @csrf
            @method('put')
            <div class="form-group mb-2">
                <label for="name">Nama</label>
                <input type="text" required class="form-control" name="name" id="name" placeholder="Nama">
            </div>

            <div class="form-group mb-2">
                <label for="username">Username</label>
                <input type="text" required class="form-control" name="username" id="username" placeholder="Username">
            </div>

            <div class="form-group mb-2">
                <label for="nik">NIK</label>
                <input type="text" required class="form-control" name="nik" id="nik" placeholder="NIK">
            </div>

            <div class="form-group mb-2">
                <label for="nohp">Nomor HP</label>
                <input type="text" required class="form-control" name="nohp" id="nohp" placeholder="Nomor HP">
            </div>

            <div class="form-group mb-2">
                <label for="email">Email</label>
                <input type="email" required class="form-control" name="email" id="email" placeholder="Email">
            </div>

            <div class="form-group mb-2">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-select" required>
                    <option selected disabled value="">Pilih Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="password">Password (Isi Jika ingin ganti password) </label>
                <input type="password" required class="form-control" name="password" id="password" placeholder="Password">
            </div>
          </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button onclick="$('#editUser form').submit()" type="button" class="btn btn-primary" >Simpan</button>
        </div>
  
      </div>
    </div>
  </div>

  <script>
    function editUser(id) {
        var urlEditUser = "{{url('users')}}/" + id + "/edit";

        $.ajax({
            url: urlEditUser,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $('#editUser form').attr('action', "{{url('users')}}/" + id);
                $('#editUser form input[name="name"]').val(data.name);
                $('#editUser form input[name="username"]').val(data.username);
                $('#editUser form input[name="nik"]').val(data.nik);
                $('#editUser form input[name="nohp"]').val(data.nohp);
                $('#editUser form input[name="email"]').val(data.email);
                $('#editUser form select[name="role"]').val(data.role);
                $('#editUser').modal('show');
            }
        });
    }
  </script>

@endsection
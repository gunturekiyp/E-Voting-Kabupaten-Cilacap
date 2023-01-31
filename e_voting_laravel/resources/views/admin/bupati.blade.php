@extends('layouts.app', ['title' => "Calon Bupati"])

@section('content')

<!-- Button to Open the Modal -->
<div class="d-flex justify-content-end align-content-end">
    <a target="_blank" href="/calon/pendaftaran" type="button" class="btn btn-success">
        Tambah
    </a>
</div>

<br><br>

<table>
    <thead>
        <tr>
            <th>Foto</th>
            <th>Nama</th>
            <th>Email</th>
            <th>No HP</th>
            <th>NIK</th>
            <th>Deskripsi</th>
            <th></th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>
                <img src="/img/calon/{{$user->foto_calon_bupati_wakil}}" width="80px" alt="" srcset="">
            </td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->nohp }}</td>
            <td>{{ $user->nik }}</td>
            <td>
                <ul>
                    <li>
                        <small><b>Visi :</b> {{ Str::limit($user->visi, 70, '...') }}</small>
                    </li>
                    <li>
                        <small>
                            <b>Misi :</b> {{ Str::limit($user->misi, 70, '...') }}
                        </small>
                    </li>
                    <li>
                        <small>
                            <b>Deskripsi :</b> {{ Str::limit($user->deskripsi_tambahan_calon, 70, '...') }}
                        </small>
                    </li>
                </ul>
            </td>
            <td>
                <form action="{{url('calon/bupati/toggle-pemilihan' . '/' . $user->id)}}" method="get">
                    <label class="form-check form-switch">
                        <input onchange="this.form.submit()" class="form-check-input" type="checkbox" @if($user->muncul_dalam_pemilihan) checked @endif>
                        <span class="form-check-label">
                            <small>Tampil dalam pemilihan</small>
                        </span>
                    </label>
                </form>
            </td>
            <td>
                <a href="{{url('calon/bupati/hapus' . '/' . $user->id)}}" type="submit" class="btn w-100 btn-sm btn-danger">
                    Hapus
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td>Foto</td>
            <th>Nama</th>
            <th>Email</th>
            <th>No HP</th>
            <th>NIK</th>
            <th>Deskripsi</th>
            <th></th>
            <th>Aksi</th>
        </tr>
    </tfoot>
</table>

@endsection
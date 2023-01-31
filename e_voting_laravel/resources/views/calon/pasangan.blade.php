@extends('layouts.app', ['title' => "Pasangan Calon"])

@section('content')
<!-- Button to Open the Modal -->
<div class="d-flex justify-content-end align-content-end">
    <button type="button" class="btn btn-success" onclick="$('#addPasangan').modal('show')">
        Tambah
    </button>
</div>

<br><br>

<table>
    <thead>
        <tr>
            <td>
                Nomor Urut Pasangan
            </td>
            <td>Nama Calon Bupati</td>
            <td>Foto Calon Bupati</td>

            <td>Nama Calon Wakil Bupati</td>
            <td>Foto Calon Wakil Bupati</td>
            <td>

            </td>
        </tr>
    </thead>

    <tbody>
        @foreach ($data as $d)
        @php
            $bupati = \App\Models\User::where('id', $d->id_calon_bupati)->first();
            $wakil_bupati = \App\Models\User::where('id', $d->id_calon_wakil_bupati)->first();
        @endphp
            <tr>
                <td>Nomor urut {{ $d->no_urut }}</td>
                <td>
                    {{$bupati->name}}
                </td>
                <td>
                    <img src="{{ url('/img/calon') . '/' . $bupati->foto_calon_bupati_wakil}}" style="width: 80px" alt="" srcset="">
                </td>
                <td>
                    {{$wakil_bupati->name}}
                </td>
                <td>
                    <img src="{{ url('/img/calon') . '/' . $wakil_bupati->foto_calon_bupati_wakil}}" style="width: 80px" alt="" srcset="">
                </td>
                <td>
                    <a href="{{url('calon/pasangan-hapus' . '/' . $d->id)}}" class="btn btn-danger btn-sm">
                        Hapus
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td>
                Nomor Urut Pasangan
            </td>
            <td>Nama Calon Bupati</td>
            <td>Foto Calon Bupati</td>

            <td>Nama Calon Wakil Bupati</td>
            <td>Foto Calon Wakil Bupati</td>
            <td>

            </td>
        </tr>
    </tfoot>
</table>

{{-- Create modal with two select box --}}
<div class="modal fade" id="addPasangan">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Pasangan Calon</h4>
        </div>
        <div class="modal-body">
            <form action="{{url('/calon/pasangan-store')}}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="id_calon_bupati">Calon Bupati</label>
                    <select class="form-control" name="id_calon_bupati" id="id_calon_bupati">
                        <option value="" selected disabled>Pilih</option>
                        @foreach ($bupati_users as $b)
                            <option value="{{$b->id}}">{{$b->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="id_calon_wakil_bupati">Calon Wakil Bupati</label>
                    <select class="form-control" name="id_calon_wakil_bupati" id="id_calon_wakil_bupati">
                        <option value="" selected disabled>Pilih</option>
                        @foreach ($wakil_users as $w)
                            <option value="{{$w->id}}">{{$w->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Tambah
                    </button>
                </div>
            </form>
        </div>
      </div>
    </div>
@endsection
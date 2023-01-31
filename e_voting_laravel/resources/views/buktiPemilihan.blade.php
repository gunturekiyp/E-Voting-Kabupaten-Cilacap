@extends('layouts.app', ['contentStyle' => 'no-card', 'title' => ""])

@section('content')

<div class="card" id="buktiSection">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <img class="w-100" src="https://chart.googleapis.com/chart?cht=qr&chs=500x500&chl={{ urlencode( url('bukti_pemilihan' . '/' . base64_encode(Auth::user()->id) )) }}" alt="" srcset="">
            </div>
            <div class="col py-3">
                <h1>
                    Bukti Pemilihan
                </h1>
                <table class="w-100">
                    <tr>
                        <td>
                            Nama
                        </td>
                        <td style="width: 10px; text-align:center">:</td>
                        <td>
                            {{$user->name}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Nomor Ponsel
                        </td>
                        <td style="width: 10px; text-align:center">:</td>
                        <td>
                            {{$user->nohp}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Status 
                        </td>
                        <td style="width: 10px; text-align:center">:</td>
                        <td>
                            Telah melakukan pemilihan pada tanggal {{$data->created_at}}
                        </td>
                    </tr>
                </table>

                <br>

                <p>
                    Demikian bukti pemilihan ini kami buat, untuk dapat digunakan sebagai bukti pemilihan.
                </p>
            </div>
        </div>        
    </div>
</div>

<br>

<div class="row">
    <div class="col-lg-3">
        <a class="btn btn-primary" href="/bukti_pemilihan/{{base64_encode($id)}}/print">
            Download PDF
        </a>
    </div>
</div>

@endsection
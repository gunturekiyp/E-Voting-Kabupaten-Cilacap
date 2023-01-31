@extends('layouts.app', ['contentStyle' => 'no-card', 'title' => ""])

@section('content')
   <div class="row">
        @foreach ($data as $d)
        @php
            // Get users detail
            $bupati = App\Models\User::find($d->id_calon_bupati);
            $wakil = App\Models\User::find($d->id_calon_wakil_bupati);
        @endphp

            <div class="col-lg-6">
                <div class="card mb-3">
                    <div class="card-header justify-content-center d-flex">
                        <a onclick="$('#infoBup{{$d->id}}, #infoWakil{{$d->id}}').slideToggle()" href="#" style="width: 2rem; height: 2rem" class="bg-primary text-white badge badge-pill justify-content-center d-flex align-items-center">
                            {{$d->no_urut}}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <center>
                                    <img onclick="$('#infoBup{{$d->id}}, #infoWakil{{$d->id}}').slideToggle()" style="cursor: pointer" src="/img/calon/{{$bupati->foto_calon_bupati_wakil}}" class="w-100" alt="" srcset="">
                                    <div class="mt-2">
                                        <b>{{$bupati->name}}</b>
                                    </div>
                                    Bupati
                                </center>
                                
                                <div id="infoBup{{$d->id}}" class="py-3 mt-3 border-top informasi_bupati_dan_wakil">

                                    <center><b>Visi</b></center>
                                    <ul>
                                        <ul>
                                            <li>{{$bupati->visi}}</li>
                                        </ul>
                                    </ul>

                                    <center><b>Misi</b></center>
                                    <ul>
                                        <ul>
                                            <li>{{$bupati->misi}}</li>
                                        </ul>
                                    </ul>

                                    <center><b>Deskripsi Tambahan</b></center>
                                    <ul>
                                        <ul>
                                            <li>{{$bupati->deskripsi_tambahan_calon}}</li>
                                        </ul>
                                    </ul>

                                </div>

                            </div>
                            <div class="col">
                                <center>
                                    <img onclick="$('#infoBup{{$d->id}}, #infoWakil{{$d->id}}').slideToggle()" style="cursor: pointer" src="/img/calon/{{$wakil->foto_calon_bupati_wakil}}" class="w-100" alt="" srcset="">
                                    <div class="mt-2">
                                        <b>{{$wakil->name}}</b>
                                    </div>
                                    Wakil Bupati
                                </center>

                                <div id="infoWakil{{$d->id}}" class="py-3 mt-3 border-top informasi_bupati_dan_wakil">

                                    <center><b>Visi</b></center>
                                    <ul>
                                        <ul>
                                            <li>{{$wakil->visi}}</li>
                                        </ul>
                                    </ul>

                                    <center><b>Misi</b></center>
                                    <ul>
                                        <ul>
                                            <li>{{$wakil->misi}}</li>
                                        </ul>
                                    </ul>

                                    <center><b>Deskripsi Tambahan</b></center>
                                    <ul>
                                        <ul>
                                            <li>{{$wakil->deskripsi_tambahan_calon}}</li>
                                        </ul>
                                    </ul>

                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">

                        @if (Auth::check() and Auth::user()->role == 'user')
                            @if ($apakah_sudah_memilih)
                            <button class="btn btn-primary w-100" disabled>Sudah memilih Terima kasih!</button>    
                            @else
                            <a onclick="if(!confirm('Kamu ingin memilih pasangan nomor urut {{$d->no_urut}}?')){return false}" href="{{url('vote' . '/' . $d->id)}}" class="btn btn-primary w-100">Vote Nomor Urut {{$d->no_urut}}</a>
                            @endif
                        @else
                            <button disabled  class="btn btn-primary w-100">Vote Nomor Urut {{$d->no_urut}} (Perlu login)</button>
                        @endif

                    </div>
                </div>
            </div>
        @endforeach
   </div>

   <script>
        $('.informasi_bupati_dan_wakil').hide();
   </script>
@endsection
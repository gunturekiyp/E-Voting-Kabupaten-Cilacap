@extends('layouts.app', ['contentStyle' => 'no-card', 'title' => ""])

@section('content')
<div class="row">
    <div class="col-lg-4 mb-3">
        <div class="card mb-3">
            <div class="card-header">
                <h2>Hasil Voting</h2>
            </div>
            <div class="card-body">
                Berikut kami tampilkan hasil voting secara realtime untuk Bupati dan Wakil Bupati dalam bentuk diagram. Silahkan refresh laman ini untuk menampilkan hasil voting terbaru.
            </div>
        </div>

        @if (Auth::check() and Auth::user()->role == 'admin')
            <a href="{{url('hasil-voting/cetak')}}" class="btn btn-primary my-1 w-100">
                Cetak Hasil Voting
            </a>

            <a href="{{url('/hasil-voting/hapus')}}" class="btn btn-danger w-100 my-1" onclick="if(!confirm('Yakin ingin menghapus seluruh data pemilihan? Jika iya maka user bisa memilih lagi')){return false}">
                Hapus
            </a>
        @endif
    </div>
    <div class="col">
        <div class="card mb-3">
            <div class="card-body">
                <canvas id="myChart"></canvas>
            </div>
        </div>

        <button onclick="downloadDiagram()" class="btn btn-primary">
            Download gambar
        </button>
    </div>
</div>

<script>
    function downloadDiagram(){
      var link = document.createElement('a');
      link.download = 'hasil_voting.jpg';
      link.href = getURI()
      link.click();
    }

    function getURI() {
        let canvas = document.getElementById('myChart');
        var newCanvas = canvas.cloneNode(true);
        var ctx = newCanvas.getContext('2d');
        ctx.fillStyle = "#FFF";
        ctx.fillRect(0, 0, newCanvas.width, newCanvas.height);
        ctx.drawImage(canvas, 0, 0);
        return newCanvas.toDataURL("image/jpeg");
    }

    const labels = [
        @for($i = 0; $i < count($data); $i++)
            '{{$data[$i]["name"]}}',
        @endfor
    ];

    const data = {
      labels: labels,
      datasets: [{
        label: 'Hasil Voting',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [
            @for($i = 0; $i < count($data); $i++)
                {{$data[$i]["vote_results"]}},
            @endfor
        ],
      }]
    };

    const config = {
      type: 'line',
      data: data,
      options: {}
    };

    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
  </script>
@endsection
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
</head>

<body onload="window.print()">
    <div class="container-fluid">

        <table class="w-100">
            <tr>
                <td>
                    <img class="w-100" src="https://chart.googleapis.com/chart?cht=qr&chs=500x500&chl={{ urlencode( url('bukti_pemilihan' . '/' . base64_encode(Auth::user()->id) )) }}"
                            alt="" srcset="">
                </td>
                <td>
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
                </td>
            </tr>
        </table>

    </div>
</body>

</html>
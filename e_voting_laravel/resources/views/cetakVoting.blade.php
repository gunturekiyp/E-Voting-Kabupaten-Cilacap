<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<body onload="window.print()">
    <div class="container py-5">
        <center>
            <h1>Hasil Voting</h1>
        </center>

        <br>
    
        <table class="table">
            <tr>
                <td>
                    No
                </td>
                <td>
                    Nomor Urut
                </td>
                <td>
                    Hasil
                </td>
            </tr>
            
            @for ($i = 0; $i < count($data); $i++)
                <tr>
                    <td>
                        {{ $i+1 }}
                    </td>
                    <td>
                        {{ $data[$i]['name'] }}
                    </td>
                    <td>
                        {{ $data[$i]['vote_results'] }} orang
                    </td>
                </tr>
                
            @endfor
            
        </table>
    </div>
</body>
</html>
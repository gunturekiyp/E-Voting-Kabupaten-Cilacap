<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\{jumlahPemilih, pasanganCalon};
use Auth;
use Session;

class indexController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $apakah_sudah_memilih = (bool) jumlahPemilih::where('id_pemilih', Auth::user()->id) -> count();
        } else {
            $apakah_sudah_memilih = false;
        }

        if (Auth::check() and in_array(Auth::user()->role, ['bupati', 'wakil_bupati'])) {
            // Get Nomor Urut from pasanganCalon table
            $pasangan = pasanganCalon::where('id_calon_bupati', Auth::user()->id) 
            -> orWhere('id_calon_wakil_bupati', Auth::user()->id) 
            -> first();

            if ($pasangan) {
                // Give a information to users using session flash
                Session::flash('info', 'Anda pasangan calon dengan nomor urut ' . $pasangan->no_urut);
            }
        }

        // Get pasangan calon
        $data = pasanganCalon::all();

        // Return to welcome page
        return view('welcome')
            ->with('data', $data)
            ->with('apakah_sudah_memilih', $apakah_sudah_memilih);

    }

    public function vote($idPasangan)
    {
        // Check if user already voted
        $apakah_sudah_memilih = (bool) jumlahPemilih::where('id_pemilih', Auth::user()->id) -> count();

        if ($apakah_sudah_memilih) {
            return redirect()->back()->with('error', 'Anda sudah memilih. Terima kasih!');
        } else {
            $pemilih = new jumlahPemilih();
            $pemilih->id_pemilih = Auth::user()->id;
            $pemilih->id_pasangan = $idPasangan;
            $pemilih->save();

            return redirect()->back()->with('success', 'Terima kasih telah memilih!');
        }
    }

    public function hasil_voting()
    {
        if (Auth::check() and in_array(Auth::user()->role, ['bupati', 'wakil_bupati'])) {
            // Get Nomor Urut from pasanganCalon table
            $pasangan = pasanganCalon::where('id_calon_bupati', Auth::user()->id) 
            -> orWhere('id_calon_wakil_bupati', Auth::user()->id) 
            -> first();

            if ($pasangan) {
                // Give a information to users using session flash
                Session::flash('info', 'Anda pasangan calon dengan nomor urut ' . $pasangan->no_urut);
            }
        }

        if (Auth::user()->role == "user") {
            // Check if user already voted
            $apakah_sudah_memilih = (bool) jumlahPemilih::where('id_pemilih', Auth::user()->id) -> count();

            if(!$apakah_sudah_memilih) {
                return redirect()->back()->with('error', 'Anda belum memilih. Silahkan memilih terlebih dahulu!');
            }
        }

        $data = [];

        // Get all pasangan
        $pasangan = pasanganCalon::all();

        $i = 0;

        foreach ($pasangan as $value) {
            $data[$i]['name'] = "No Urut " . $value->no_urut;
            $data[$i]['vote_results'] = jumlahPemilih::where('id_pasangan', $value->id) -> count();
            $i++;
        }

        return view('hasilVoting')
            -> with('data', $data)
        ;
    }

    public function hapus_voting()
    {
        // Remove all data in jumlahPemilih table
        jumlahPemilih::truncate();

        return redirect()->back()->with('success', 'Data voting berhasil dihapus!');
    }

    public function cetak_voting()
    {
        $data = [];

        // Get all pasangan
        $pasangan = pasanganCalon::all();

        $i = 0;

        foreach ($pasangan as $value) {
            $data[$i]['name'] = "No Urut " . $value->no_urut;
            $data[$i]['vote_results'] = jumlahPemilih::where('id_pasangan', $value->id) -> count();
            $i++;
        }


        return view('cetakVoting')
            -> with('data', $data)
        ;
    }

    public function bukti_pemilihan($id = null)
    {
        $id = base64_decode($id);

        $data = jumlahPemilih::where('id_pemilih', $id) -> first();

        // Cek if id exists in jumlahPemilih table
        if(!$data) {
            return redirect('/')->with('error', 'Data pemilihan tidak ditemukan! Anda belum memilih!');
        }

        return view('buktiPemilihan')
            ->with('id', $id)
            -> with('data', $data)
            -> with('user', User::find($id))
        ;
    }

    public function bukti_pemilihan_print($id = null)
    {
        $id = base64_decode($id);

        $data = jumlahPemilih::where('id_pemilih', $id) -> first();

        // Cek if id exists in jumlahPemilih table
        if(!$data) {
            return redirect('/')->with('error', 'Data pemilihan tidak ditemukan! Anda belum memilih!');
        }

        return view('printBuktiPemilihan')
            -> with('data', $data)
            -> with('user', User::find($id))
        ;
    }
}

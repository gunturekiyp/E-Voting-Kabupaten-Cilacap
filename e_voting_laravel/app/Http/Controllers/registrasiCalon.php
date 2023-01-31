<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, pasanganCalon};
use Auth, Session;

class registrasiCalon extends Controller
{
    public function registrasi()
    {
        return view('calon.register');
    }

    public function profil()
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

        return view('calon.profil');
    }

    public function profil_update(Request $request)
    {
        $id = Auth::user()->id;
        $name = $request->name;
        $password = $request->password;
        $role = $request->role;
        $nik = $request->nik;
        $nohp = $request->nohp;
        $visi = $request->visi;
        $misi = $request->misi;
        $deskripsi_tambahan_calon = $request->deskripsi_tambahan_calon;
        $allowed_extension = ['jpg', 'jpeg', 'png'];

        // Cek apakah nohp sudah ada atau belum
        if(User::where('nohp', $nohp) -> where('id', '!=', $id) -> first()) {
            return redirect() -> back() -> with('error', 'Nomor HP sudah ada');
        }

        // Cek apakah nik sudah ada atau belum
        if(User::where('nik', $nik)-> where('id', '!=', $id)  -> first()) {
            return redirect() -> back() -> with('error', 'NIK sudah ada');
        }

        $user = User::find($id);
        $user->name = $name;
        $user->nik = $nik;
        $user->role = $role;
        $user->nohp = $nohp;
        $user->visi = $visi;
        $user->misi = $misi;
        $user->deskripsi_tambahan_calon = $deskripsi_tambahan_calon;

        if ($request->has('password')) {
            $user->password = bcrypt($password);
        }

        // Foto calon
        if($request->hasFile('foto_calon_bupati_wakil')) {
            $tujuan_upload = public_path('/img/calon');
            if (!is_dir($tujuan_upload)) {
                mkdir($tujuan_upload, 0777, true);
            }

            $foto = $request->file('foto_calon_bupati_wakil');

            // Check extension
            if(!in_array($foto->getClientOriginalExtension(), $allowed_extension)) {
                return redirect() -> back() -> with('error', 'Format foto tidak didukung');
            }

            $extension = $foto->getClientOriginalExtension();
            $filename = $nik . '.' . $extension;
            $foto->move($tujuan_upload, $filename);

            $user->foto_calon_bupati_wakil = $filename;
        } else {
            $user->foto_calon_bupati_wakil = $user->foto_calon_bupati_wakil;
        }

        $user->save();
        return redirect() -> back() -> with('success', 'Berhasil mengubah profil');
    }

    public function registrasi_save(Request $request)
    {
        $name = $request->name;
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $role = $request->role;
        $nik = $request->nik;
        $nohp = $request->nohp;
        $visi = $request->visi;
        $misi = $request->misi;
        $deskripsi_tambahan_calon = $request->deskripsi_tambahan_calon;
        $allowed_extension = ['jpg', 'jpeg', 'png'];

        // Cek apakah username sudah ada atau belum
        if(User::where('username', $username) -> first()) {
            return redirect() -> back() -> with('error', 'Username sudah ada');
        }

        // Cek apakah email sudah ada atau belum
        if(User::where('email', $email) -> first()) {
            return redirect() -> back() -> with('error', 'Email sudah ada');
        }

        // Cek apakah nohp sudah ada atau belum
        if(User::where('nohp', $nohp) -> first()) {
            return redirect() -> back() -> with('error', 'Nomor HP sudah ada');
        }

        // Cek apakah nik sudah ada atau belum
        if(User::where('nik', $nik) -> first()) {
            return redirect() -> back() -> with('error', 'NIK sudah ada');
        }

        $user = new User;
        $user->name = $name;
        $user->username = $username;
        $user->email = $email;
        $user->nik = $nik;
        $user->password = bcrypt($password);
        $user->role = $role;
        $user->nohp = $nohp;
        $user->visi = $visi;
        $user->misi = $misi;
        $user->deskripsi_tambahan_calon = $deskripsi_tambahan_calon;

        // Foto calon
        if($request->hasFile('foto_calon_bupati_wakil')) {
            $tujuan_upload = public_path('/img/calon');
            if (!is_dir($tujuan_upload)) {
                mkdir($tujuan_upload, 0777, true);
            }

            $foto = $request->file('foto_calon_bupati_wakil');
            $extension = $foto->getClientOriginalExtension();

            // Check extension
            if(!in_array($extension, $allowed_extension)) {
                return redirect() -> back() -> with('error', 'Format foto tidak didukung');
            }

            $filename = $nik . '.' . $extension;
            $foto->move($tujuan_upload, $filename);

            $user->foto_calon_bupati_wakil = $filename;
        } 

        $user->save();

        return redirect()->route('alluser.home')
            ->with('success', 'Selamat datang di dashboard Calon Bupati/Wakil');
    }

    public function pasangan()
    {
        // Get Bupati users with role bupati, muncul_dalam_pemilihan true and not exists in pasangan table
        $bupatis = User::where('role', 'bupati') -> where('muncul_dalam_pemilihan', true) -> whereNotExists(function ($query) {
            $query->select(\DB::raw(1))
                ->from('pasangan_calons')
                ->whereRaw('pasangan_calons.id_calon_bupati = users.id');
        }) -> get();
        
        // Get Wakil users with role wakil, muncul_dalam_pemilihan true and not exists in pasangan table
        $wakils = User::where('role', 'wakil_bupati') -> where('muncul_dalam_pemilihan', true) -> whereNotExists(function ($query) {
            $query->select(\DB::raw(1))
                ->from('pasangan_calons')
                ->whereRaw('pasangan_calons.id_calon_wakil_bupati = users.id');
        }) -> get();

        return view('calon.pasangan')
            -> with('data', pasanganCalon::all())
            ->with('bupati_users', $bupatis)
            ->with('wakil_users', $wakils);
            ;
        ;
    }

    public function pasangan_store(Request $request)
    {
        // Cek if bupati id is exist in database
        if(pasanganCalon::where('id_calon_bupati', $request->id_calon_bupati) -> first()) {
            return redirect() -> back() -> with('error', 'Calon Bupati sudah terdaftar');
        }

        // Cek if wakil id is exist in database
        if(pasanganCalon::where('id_calon_wakil_bupati', $request->id_calon_wakil_bupati) -> first()) {
            return redirect() -> back() -> with('error', 'Calon Wakil sudah terdaftar');
        }

        $no_urut = 1;

        // Get last no_urut
        $last_no_urut = pasanganCalon::orderBy('no_urut', 'desc') -> first();
        $hitung_data = pasanganCalon::count();

        if($last_no_urut and $hitung_data > 1) {
            $no_urut = $last_no_urut->no_urut + 1;
        } else {
            // Update last data no_urut to 1
            $last_data = pasanganCalon::first();
            $last_data->no_urut = 1;
            $last_data->save();

            $no_urut = 2;
        }

        $pasangan = new pasanganCalon;
        $pasangan->no_urut = $no_urut;
        $pasangan->id_calon_bupati = $request->id_calon_bupati;
        $pasangan->id_calon_wakil_bupati = $request->id_calon_wakil_bupati;
        $pasangan->save();

        return redirect() -> back() -> with('success', 'Berhasil menambahkan pasangan calon');
    }

    public function pasangan_hapus($id)
    {
        // Can't delete data when only one data in database
        if(pasanganCalon::count() == 1) {
            return redirect() -> back() -> with('error', 'Tidak dapat menghapus data');
        }

        pasanganCalon::destroy($id);
        return redirect() -> back() -> with('success', 'Berhasil menghapus pasangan calon');
    }

    public function bupati()
    {
        return view('admin.bupati')
            -> with('users', User::where('role', 'bupati') -> get());
    }

    public function calon_wakil()
    {
        return view('admin.calon_wakil')
            -> with('users', User::where('role', 'wakil_bupati') -> get());
    }

    public function toggle_pemilihan($id)
    {
        // Check if user is exist in pasangan table
        if(pasanganCalon::where('id_calon_bupati', $id) -> orWhere('id_calon_wakil_bupati', $id) -> first()) {
            return redirect() -> back() -> with('error', 'Calon Bupati sudah terdaftar');
        }

        $user = User::find($id);
        $user->muncul_dalam_pemilihan = !$user->muncul_dalam_pemilihan;
        $user->save();
        return redirect() -> back() -> with('success', 'Berhasil mengubah status pemilihan');
    }

    public function bupati_hapus($id)
    {
        // Can't delete data when only one data in database
        if(User::count() == 1) {
            return redirect() -> back() -> with('error', 'Tidak dapat menghapus data');
        }

        // Check if user is exist in pasangan table
        if(pasanganCalon::where('id_calon_bupati', $id) -> orWhere('id_calon_wakil_bupati', $id) -> first()) {
            return redirect() -> back() -> with('error', 'Calon Bupati sudah terdaftar');
        }

        User::destroy($id);
        return redirect() -> back() -> with('success', 'Berhasil menghapus calon');
    }
}

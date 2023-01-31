<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class manajemenUser extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users')
            ->with('users', User::whereIn('role', ['user', 'admin']) -> where('id', '!=', Auth::id()) -> get())
            -> with('title', 'Manajemen User');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $role = $request->role;
        $nik = $request->nik;
        $nohp = $request->nohp;

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
        $user->save();

        return redirect()->back()
            ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Get users detail and return as json
        $user = User::find($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->name;
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $role = $request->role;
        $nik = $request->nik;
        $nohp = $request->nohp;

        // Cek apakah username sudah ada atau belum
        if(User::where('username', $username) -> where('id', '!=', $id) -> first()) {
            return redirect() -> back() -> with('error', 'Username sudah ada');
        }

        // Cek apakah email sudah ada atau belum
        if(User::where('email', $email) -> where('id', '!=', $id) -> first()) {
            return redirect() -> back() -> with('error', 'Email sudah ada');
        }

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
        $user->username = $username;
        $user->email = $email;
        $user->nik = $nik;
        $user->password = bcrypt($password);
        $user->role = $role;
        $user->nohp = $nohp;
        $user->save();

        return redirect()->back()
            ->with('success', 'User berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Hapus user berdasarkan id
        $user = User::find($id);
        $user->delete();

        return redirect()->back()
            ->with('success', 'User berhasil dihapus');
    }
}

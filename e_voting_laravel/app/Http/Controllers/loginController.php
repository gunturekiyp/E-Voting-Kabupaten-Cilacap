<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth, Session;

class loginController extends Controller
{
    // Fungsi untuk mengarahkan ke halaman home berdasarkan role
    public function home()
    {
        // Redirect to home page by role
        return redirect("/");
    }

    public function lupa_password()
    {
        // Redirect to lupa password page
        return view('auth.lupa_pass');
    }

    // Fungsi logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // Fungsi untuk menampilkan halaman login
    public function login_page()
    {
        if (Auth::check()) {
            return redirect() -> route('alluser.home');
        }

        return view('auth.login');
    }

    // Fungsi login
    public function login(Request $request)
    {
        // Login using email or username
        $login = $request->input('login');
        $password = $request->input('password');

        // Search user in database
        $user = User::where('email', $login)
                ->orWhere('username', $login)
                ->orWhere('nik', $login)
                ->first();
        
        // If user exists and password is correct
        if ($user && \Hash::check($password, $user->password)) {
            // Login by id
            \Auth::loginUsingId($user->id, true);

            // Give success message if user is logged in
            Session::flash('success', 'You are logged in');
            return redirect() -> route('alluser.home');

        } else {
            return redirect()->back()->with('error', 'Invalid login or password');
        }
    }

    // To save new password
    public function lupa_password_save(Request $request)
    {
        $login = $request->input('login');
        $password = $request->input('password');

        // Search user in database
        $user = User::where('email', $login)
                ->orWhere('username', $login)
                ->orWhere('nik', $login)
                ->whereIn('role', ['bupati', 'wakil_bupati', 'user'])
                ->first();

        // If user doesn't exist
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan');
        }

        // If user exists 
        else {
            // Update password
            $user->password = \Hash::make($password);
            $user->save();

            // Give success message if user is logged in
            Session::flash('success', 'Password berhasil diubah');
            return redirect('/');
        }
    }
}

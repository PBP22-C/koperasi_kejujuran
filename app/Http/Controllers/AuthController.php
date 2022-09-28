<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAuthRequest;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        } else {
            return view('auth.register');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register_action(StoreAuthRequest $request)
    {
        // validateId
        $firstTwoDigits = substr($request->id_siswa, 0, 2);
        $secondTwoDigits = substr($request->id_siswa, 2, 2);
        $result = (int)$firstTwoDigits * (int)$secondTwoDigits % 100;
        $lastTwoDigits = substr($request->id_siswa, 4, 2);
        if ($result != $lastTwoDigits) {
            return redirect()->back()->with('errorId', 'ID tidak valid');
        }

        $request->validate([
            'nama_siswa' => 'required',
            'id_siswa' => 'required',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        //save data to siswa
        Siswa::create([
            'nama_siswa' => $request->nama_siswa,
            'id_siswa' => $request->id_siswa,
            'password' => Hash::make($request->password),
        ]);

        if (Auth::attempt(['id_siswa' => $request->id_siswa, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        } else {
            return view('auth.login');
        }
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'id_siswa' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['id_siswa' => $request->id_siswa, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'error' => 'Wrong username or password',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->intended('/');   
    }
}

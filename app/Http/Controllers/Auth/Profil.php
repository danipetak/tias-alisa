<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Profil extends Controller
{
    public function index()
    {
        return view('auth.profil');
    }

    public function update(Request $request)
    {
        if ($request->password) {
            $request->validate([
                'nama_lengkap'  => 'required|string|max:255',
                'email'         => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id . ',id',
                'password'      => 'required|string|min:8|confirmed',
            ]);
        } else {
            $request->validate([
                'nama_lengkap'  => 'required|string|max:255',
                'email'         => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id . ',id',
            ]);
        }

        $user           =   User::find(Auth::user()->id) ;
        $user->name     =   $request->nama_lengkap ;
        $user->email    =   $request->email ;
        if ($request->password) {
        $user->password =   Hash::make($request->passsword) ;
        }
        $user->save() ;

        return back()->with('status', 'Ubah profil berhasil') ;
    }
}

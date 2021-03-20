<?php

namespace App\Http\Controllers\Master\Data;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataPengguna extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        return view('page.master.data.data_pengguna.index');
    }

    public function show()
    {
        $data   =   User::where('role', 1)
                    ->orderBy('name', 'ASC')
                    ->get();

        return view('page.master.data.data_pengguna.show', compact('data'));
    }

    public function detail(Request $request)
    {
        return User::where('id', $request->row_id)->first();
    }

    public function store(Request $request)
    {
        if ($request->x_code == NULL) {
            $this->validate($request, [
                'nama_lengkap'  =>  'required|string|max:255',
                'email'         =>  'required|string|email|max:255|unique:users',
                'password'      =>  'required|string|min:8|confirmed',
            ]);

            $user               =   new User;
            $user->name         =   $request->nama_lengkap;
            $user->email        =   $request->email;
            $user->password     =   Hash::make($request->password);
            $user->role         =   1;
            $user->save();

        } else {

            if ($request->password) {
                $this->validate($request, [
                    'nama_lengkap'  => 'required|string|max:255',
                    'email'         => 'required|string|email|max:255|unique:users,email,' . $request->x_code . ',id',
                    'password'      => 'required|string|min:8|confirmed',
                ]);
            } else {
                $this->validate($request, [
                    'nama_lengkap'  => 'required|string|max:255',
                    'email'         => 'required|string|email|max:255|unique:users,email,' . $request->x_code . ',id',
                ]);
            }

            $user               =   User::find($request->x_code);
            $user->name         =   $request->nama_lengkap;
            $user->email        =   $request->email;
            if ($request->password) {
            $user->password     =   Hash::make($request->password);
            }
            $user->save();
        }
    }

    public function destroy(Request $request)
    {
        return User::find($request->row_id)->delete();
    }
}

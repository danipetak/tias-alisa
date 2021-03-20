<?php

namespace App\Http\Controllers\Master\Account;

use App\Http\Controllers\Controller;
use App\Models\Setting\Setup;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PenghubungRekening extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('page.master.account.penghubung_rekening.index');
    }

    public function show()
    {
        $data   =   Setup::where('slug', 'link')
                    ->get();

        return view('page.master.account.penghubung_rekening.show', compact('data'));
    }

    public function detail(Request $request)
    {
        return  Setup::where('slug', 'link')
                ->where('id', $request->row_id)
                ->first();
    }

    public function store(Request $request)
    {
        $data   =   Setup::select('id')
                    ->where('slug', 'link')
                    ->where('id', $request->x_code)
                    ->first();
        if ($data) {
            $this->validate($request, [
                'nama_penghubung'   =>  'required|string|max:100|unique:setups,values, ' . $data->id . ',id'
            ]);

            $links          =   Setup::find($data->id) ;
            $links->values  =   $request->nama_penghubung ;
            $links->save() ;
        } else {
            $this->validate($request, [
                'nama_penghubung'   =>  'required|string|max:100|unique:setups,values'
            ]);

            $links          =   new Setup ;
            $links->slug    =   'link' ;
            $links->values  =   $request->nama_penghubung ;
            $links->save() ;
        }
    }

    public function destroy(Request $request)
    {
        $this->validate($request, [
            'row_id'    =>  ['required', Rule::exists('setups', 'id')->where('slug', 'link')]
        ]);

        return  Setup::where('id', $request->row_id)
                ->where('slug', 'link')
                ->delete();
    }
}

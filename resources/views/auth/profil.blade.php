@extends('layouts.main')

@section('title', 'Profil')

@section('content')
<form action="{{ route('profil.update') }}" method="POST">
    @csrf @method('patch')

    <div class="form-group">
        Nama Lengkap
        <input type="text" name="nama_lengkap" class="form-control" value="{{ Auth::user()->name }}" id="nama_lengkap" placeholder="Tuliskan Nama Lengkap" autocomplete="off">
        @error('nama_lengkap') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="form-group">
        E-Mail
        <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" id="email" placeholder="Tuliskan E-Mail" autocomplete="off">
        @error('email') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="border p-1 mb-2">
        <div class="mb-2 text-primary">Tuliskan password apabila ingin diganti</div>
        <div class="form-group">
            Password
            <input type="password" name="password" class="form-control" id="password" placeholder="Tuliskan Password" autocomplete="off">
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            Konfirmasi Password
            <input id="password-confirm" type="password" class="form-control" placeholder="Tuliskan Konfirmasi Password" name="password_confirmation" autocomplete="new-password">
        </div>
    </div>

    <div class="form-group text-right">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>
@endsection

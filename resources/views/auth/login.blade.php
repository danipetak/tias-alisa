@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col text-justify pr-2">
            <h2 style="font-size: 50px">Memangkas<br>Administrasi<br>Lebih<br>Efisien &<br>Singkat</h2>
        </div>

        <div class="col-4 pl-2">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    E-Mail
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="email" placeholder="Tuliskan E-Mail" autofocus autocomplete="off">
                    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    Password
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}" id="password" placeholder="Tuliskan Password" autocomplete="off">
                    @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Ingat Saya</label>
                        </div>

                        <div class="col text-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col text-justify pr-2">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed mattis nulla sit amet eros semper, eget dapibus odio mollis. Sed quis mauris accumsan, fermentum nunc eu, molestie ante. Praesent a nunc eu velit mattis semper in vel nulla. Etiam eu neque vel augue aliquet sollicitudin gravida lobortis dolor. Aliquam quam urna, consectetur consequat tellus et, gravida feugiat odio. Mauris sodales convallis tellus eget vehicula. Nullam hendrerit id est in accumsan. Maecenas massa nisi, varius vitae libero et, cursus imperdiet arcu. Morbi eget tortor tristique, porta metus at, placerat justo.</p>
            <p>Pellentesque ex eros, congue id aliquam ac, tempor a nulla. Pellentesque ornare urna a elit venenatis consequat eget non arcu. Proin molestie mauris quam, interdum aliquam turpis pretium ut. Aenean facilisis tincidunt enim in bibendum. Aenean eu leo ex. Nunc ullamcorper tempor lobortis. Integer sagittis nisl in nibh malesuada vulputate. Nam malesuada scelerisque dolor, a iaculis velit. Nam lobortis fermentum metus id facilisis. Morbi sit amet pharetra magna, a ultrices justo. Etiam nec sapien eget ex laoreet hendrerit id at mauris. Vivamus nisl odio, elementum sed turpis ac, vulputate sagittis diam. Cras luctus tristique felis, id sagittis magna congue et.</p>
            <p>Phasellus porttitor lorem eu nisi pretium sodales. Morbi congue vehicula nisi non ullamcorper. Donec eleifend feugiat diam, a commodo eros sollicitudin ut. Nulla sagittis velit eget erat pharetra lobortis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. In egestas tortor at turpis volutpat, sit amet egestas est tristique. Donec luctus tellus et tellus semper ullamcorper. Sed purus justo, pellentesque ut turpis a, porttitor semper dui. Nunc blandit faucibus tellus eu consectetur. Maecenas sit amet tristique nunc, nec condimentum ante. Suspendisse sollicitudin lobortis fermentum. Aliquam porta rhoncus metus eu sodales.</p>
        </div>

        <div class="col-4 pl-2">
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    E-Mail
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="email" placeholder="Tuliskan E-Mail" autocomplete="off">
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

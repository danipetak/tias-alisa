@extends('layouts.main')

@section('title', 'Profil Perusahaan')

@section('content')
<form action="{{ route('profil_perusahaan.store') }}" method="POST">
    @csrf

    <div class="row mb-2">
        <div class="col pr-1">
            <div class="form-group">
                Nama Perusahaan
                <input type="text" name="nama_perusahaan" class="form-control" value="{{ $row->nama_perusahaan ??old('nama_perusahaan') }}" id="nama_perusahaan" placeholder="Tuliskan Nama Perusahaan" autocomplete="off">
                @error('nama_perusahaan') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                Nomor Telepon
                <input type="number" name="nomor_telepon" class="form-control" value="{{ $row->nomor_telepon ?? old('nomor_telepon') }}" id="nomor_telepon" placeholder="Tuliskan Nomor Telepon" autocomplete="off">
                @error('nomor_telepon') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                Fax
                <input type="number" name="fax" class="form-control" value="{{ $row->fax ?? old('fax') }}" id="fax" placeholder="Tuliskan Fax" autocomplete="off">
                @error('fax') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                E-Mail
                <input type="email" name="email" class="form-control" value="{{ $row->email ?? old('email') }}" id="email" placeholder="Tuliskan E-Mail" autocomplete="off">
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="col pl-1">
            <div class="form-group">
                NPWP
                <input type="text" name="npwp" class="form-control" value="{{ $row->npwp ?? old('npwp') }}" id="npwp" placeholder="Tuliskan NPWP" autocomplete="off">
                @error('npwp') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                Alamat Perusahaan
                <textarea name="alamat" id="alamat" class="form-control" placeholder="Tuliskan Alamat Perusahaan" rows="3">{{ $row->alamat ?? old('alamat') }}</textarea>
                @error('alamat') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                Nama Pemilik Perusahaan
                <input type="text" name="pemilik_perusahaan" class="form-control" value="{{ $row->pemilik_perusahaan ?? old('pemilik_perusahaan') }}" id="pemilik_perusahaan" placeholder="Tuliskan Nama Pemilik Perusahaan" autocomplete="off">
                @error('pemilik_perusahaan') <div class="text-danger">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                Nama Akuntan Perusahaan
                <input type="text" name="akuntan_perusahaan" class="form-control" value="{{ $row->akuntan_perusahaan ?? old('akuntan_perusahaan') }}" id="akuntan_perusahaan" placeholder="Tuliskan Nama Akuntan Perusahaan" autocomplete="off">
                @error('akuntan_perusahaan') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    <div class="form-group text-right">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

</form>
@endsection

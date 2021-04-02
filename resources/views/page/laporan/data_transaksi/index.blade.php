@extends('layouts.main')

@section('title', 'Laporan Data Transaksi')

@section('header')
<link href="{{ asset('vendor/select2/css/select2.css') }}" rel="stylesheet" />
<link href="{{ asset('vendor/politespace/politespace.css') }}" rel="stylesheet" />
@endsection

@section('footer')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
@endsection

@section('content')
<form action="{{ route('datatransaksi.index') }}" method="get">
    <div class="row">
        <div class="col pr-1">
            <div class="border mb-3 p-1">
                <div class="row">
                    <div class="col-10 pr-1">
                        <div class="form-group">
                            Pilih Periode
                            <select name="periode" id="periode" class="form-control select2" data-width='100%' data-placeholder='Pilih Periode Akuntansi'>
                                <option value=""></option>
                                @foreach ($period as $row)
                                <option value="{{ $row->id }}" {{ ($periode == $row->id) ? 'selected' : '' }}>{{ $row->mulai }} - {{ $row->selesai }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col pl-1">
                        &nbsp;
                        <button type="submit" class="btn btn-primary btn-block">Cari</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col pl-1">
            <div class="border mb-3 p-1">
                <div class="row">
                    <div class="col-10 pr-1">
                        <div class="form-group">
                            Pencarian
                            <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Cari..." autocomplete="off">
                        </div>
                    </div>
                    <div class="col pl-1">
                        &nbsp;
                        <button type="submit" class="btn btn-primary btn-block">Cari</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@if (COUNT($trans) > 0)
<table class="table">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Nomor</th>
            <th>Deskripsi</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($trans as $row)
        <tr>
            <td>{{ Tanggal::date($row->tanggal_transaksi) }}</td>
            <td class="text-bold"><a href="{{ route('kwitansi', $row->id) }}">{{ $row->nomor_transaksi }}</a></td>
            <td>{{ $row->uraian }}</td>
            <td class="text-right">{{ number_format(abs($row->total_transaksi), 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $trans->appends(compact('periode', 'q'))->onEachSide(1)->links('layouts.paginate') }}
@else
<div class="alert alert-warning">
    <div class="text-bold">INFO!</div>
    Tidak ditemukan daftar transaksi pada periode dipilih
</div>
@endif
@endsection

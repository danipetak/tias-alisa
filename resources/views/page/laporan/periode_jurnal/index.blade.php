@extends('layouts.main')

@section('title', 'Laporan Periode Jurnal')

@section('header')
<link href="{{ asset('vendor/select2/css/select2.css') }}" rel="stylesheet" />
<link href="{{ asset('vendor/politespace/politespace.css') }}" rel="stylesheet" />
@endsection

@section('footer')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
@endsection

@section('content')
<div class="border mb-3 p-1">
    <form action="{{ route('periodejurnal.index') }}" method="get">
        <div class="row">
            <div class="col-10 mr-1">
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
            <div class="col ml-1">
                &nbsp;
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
        </div>
    </form>
</div>

@if (COUNT($trans) > 0)
@foreach ($trans as $row)
<table class="table mb-2">
    <thead>
        <tr>
            <td colspan="3"><b>Tanggal Transaksi : </b> {{ Tanggal::date($row->tanggal_transaksi) }}</td>
        </tr>
        <tr>
            <td colspan="3"><b>Uraian : </b> <a href="{{ route('kwitansi', $row->id) }}" target="_blank">{{ $row->nomor_transaksi }}</a> - {{ $row->uraian }}</td>
        </tr>
        <tr>
            <th>Rekening</th>
            <th>Debit</th>
            <th>Kredit</th>
        </tr>
    </thead>
    <tbody>
        @foreach (ListTrans::daftarTransaksi($row->id) as $item)
        <tr>
            <td>{{ $item->akun->kode_akun . ' - ' . $item->akun->nama_akun }}</td>
            <td class="text-right" style="width: 140px">{{ number_format($item->debit, 2) }}</td>
            <td class="text-right" style="width: 140px">{{ number_format($item->kredit, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endforeach
@else
<div class="alert alert-warning">
    <div class="text-bold">INFO!</div>
    Tidak ditemukan daftar transaksi pada periode dipilih
</div>
@endif
@endsection

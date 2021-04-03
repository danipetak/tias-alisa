@extends('layouts.main')

@section('title', 'Laporan Detail Posisi Keuangan')

@section('header')
<link href="{{ asset('vendor/select2/css/select2.css') }}" rel="stylesheet" />
@endsection

@section('footer')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
@endsection

@section('content')
<div class="float-right">
    <a href="{{ route('posisikeuangan.index', ['periode' => $periode]) }}"><< Kembali</a>
</div>

<div class="row py-2">
    <div class="col-2">
        <div class="text-primary">S.N.</div>
        {{ $data->saldo_normal }}
    </div>
    <div class="col">
        <div class="text-primary">Rekening Header</div>
        {{ $data->kode_akun }} - {{ $data->nama_akun }}
    </div>
</div>

<form action="{{ route('posisikeuangan.show', $data->id) }}" method="get">
    <div class="border p-1 mb-2">
        <div class="row">
            <div class="col-10 pr-1">
                <div class="form-group">
                    Periode
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
</form>

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Kode</th>
            <th>Nama Rekening</th>
            <th>Nominal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($akun as $i => $row)
        <tr>
            <td>{{ ++$i }}</td>
            <td>
                <a href="{{ route('bukubesar.index', ['trans' => $row->id, 'periode' => $periode]) }}" target="_blank">{{ $row->kode_akun }}</a>
            </td>
            <td>
                <a href="{{ route('bukubesar.index', ['trans' => $row->id, 'periode' => $periode]) }}" target="_blank">{{ $row->nama_akun }}</a>
            </td>
            <td class="text-right">
                {{ Akun::saldo_akhir($periode, $row->id, (($data->sn != $row->sn) ? (-$row->begining_balance) : $row->begining_balance)) }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

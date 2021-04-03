@extends('layouts.main')

@section('title', 'Laporan Detail Arus Kas')

@section('content')
<div class="float-right">
    <a href="{{ route('aruskas.index', ['periode' => $periode]) }}"><< Kembali</a>
</div>
<div class="text-primary">Periode Arus Kas</div>
{{ $periode->mulai }} - {{ $periode->selesai }}

<div class="row my-2">
    <div class="col-7">
        <div class="text-primary">Nama Arus Kas</div>
        {{ $data->nama }}
    </div>

    <div class="col">
        <div class="text-primary">Aktivitas Arus Kas</div>
        <div class="text-capitalize">{{ $data->aliran }} {{ $data->kategori }}</div>
    </div>
</div>

<form action="{{ route('aruskas.show', [ $data->id, 'periode' => $periode->id]) }}" method="get">
    <div class="border mb-3 p-1">
        <div class="row">
            <div class="col-10 pr-1">
                <div class="form-group">
                    Pencarian
                    <input type="hidden" name="periode" value="{{ $periode->id }}">
                    <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Cari..." autocomplete="off">
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
            <th>Nomor</th>
            <th>Uraian</th>
            <th>Nominal</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total  =   0;
        @endphp
        @foreach ($trans as $i => $row)
        @php
            $total  +=  $row->deleted_at == NULL ? $row->total_transaksi : 0;
        @endphp
        <tr class='{{ $row->deleted_at ? ($row->correct ? "bg-correct" : "bg-deleted") : "" }}'>
            <td>{{ ++$i }}</td>
            <td><a href="{{ route('kwitansi', $row->id) }}" target="_blank">{{ $row->nomor_transaksi }}</a></td>
            <td>{{ $row->uraian }}</td>
            <td class="text-right">{{ $row->report_total }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Total Transaksi</th>
            <th class="text-right">{{ $total < 0 ? "(". number_format(abs($total), 2) .")" : number_format($total, 2)  }}</th>
        </tr>
    </tfoot>
</table>
@endsection

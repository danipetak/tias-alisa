@extends('layouts.main')

@section('title', 'Laporan Detail Arus Kas')

@section('header')
<link href="{{ asset('vendor/select2/css/select2.css') }}" rel="stylesheet" />
@endsection

@section('footer')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
@endsection

@section('content')
<div class="float-right">
    <a href="{{ route('aruskas.index', ['periode' => $periode]) }}"><< Kembali</a>
</div>

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
    <div class="row py-2">
        <div class="col pr-1">
            <div class="border p-1">
                <div class="row">
                    <div class="col-10 pr-1">
                        <div class="form-group">
                            Periode
                            <select name="periode" id="periode" class="form-control select2" data-width='100%' data-placeholder='Pilih Periode Akuntansi'>
                                <option value=""></option>
                                @foreach ($period as $row)
                                <option value="{{ $row->id }}" {{ ($periode->id == $row->id) ? 'selected' : '' }}>{{ $row->mulai }} - {{ $row->selesai }}</option>
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
            <div class="border p-1">
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
        @foreach ($trans as $i => $row)
        <tr class='{{ $row->deleted_at ? ($row->correct ? "bg-correct" : "bg-deleted") : "" }}'>
            <td>{{ ++$i }}</td>
            <td><a href="{{ route('kwitansi', $row->id) }}" target="_blank">{{ $row->nomor_transaksi }}</a></td>
            <td>{{ $row->uraian }}</td>
            <td class="text-right">{{ $row->report_total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $trans->appends(compact('periode', 'q'))->onEachSide(1)->links('layouts.paginate') }}
@endsection

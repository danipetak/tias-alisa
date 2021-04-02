@extends('layouts.main')

@section('title', 'Laporan Buku Besar')

@section('header')
<link href="{{ asset('vendor/select2/css/select2.css') }}" rel="stylesheet" />
@endsection

@section('footer')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
@endsection

@section('content')
<div class="border mb-3 p-1">
    <form action="{{ route('bukubesar.index') }}" method="get">
        <div class="row">
            <div class="col-10 mr-1">
                <div class="form-group">
                    Pilih Rekening Transaksi
                    <select class="form-control rek select2" name="trans" required data-width="100%" data-placeholder='Pilih Rekening'>
                        <option value=""></option>
                        {!! Akun::daftar_akun($trans->id ?? FALSE) !!}
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

@if ($trans)
    <form action="{{ route('bukubesar.index') }}" method="get">
        <div class="border mb-3 p-1">
            <div class="row">
                <div class="col-10 pr-1">
                    <div class="form-group">
                        Pencarian
                        <input type="hidden" name="trans" value="{{ $trans->id }}">
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

    <div class="row mb-2">
        <div class="col-1">
            <div class="text-primary">S.N.</div>
            {{ $trans->saldo_normal }}
        </div>
        <div class="col-3">
            <div class="text-primary">Laporan</div>
            {{ ($trans->tipe_akun) ? "Laba Rugi" : "Posisi Keuangan (Neraca)" }}
        </div>
        <div class="col">
            <div class="text-success text-right">Saldo Awal</div>
            <div class="text-right">{{ $trans->saldo_awal }}</div>
        </div>
        <div class="col">
            <div class="text-primary text-right">Mutasi</div>
            <div class="text-right">{{ $trans->total_mutasi }}</div>
        </div>
        <div class="col">
            <div class="text-danger text-right">Saldo Akhir</div>
            <div class="text-right">{{ $trans->saldo_akhir }}</div>
        </div>
    </div>

    @if (COUNT($list))
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor</th>
                    <th>Uraian</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($list as $i => $row)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td><a href="{{ route('kwitansi', $row->id) }}" target="_blank">{{ $row->nomor_transaksi }}</a></td>
                    <td>{{ $row->uraian }}</td>
                    <td class="text-right">{{ $row->report_total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $list->appends(compact('trans'))->onEachSide(1)->links('layouts.paginate') }}
    @endif
@endif
@endsection

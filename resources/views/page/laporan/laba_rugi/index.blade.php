@extends('layouts.main')

@section('title', 'Laporan Laba Rugi')

@section('header')
<link href="{{ asset('vendor/select2/css/select2.css') }}" rel="stylesheet" />
@endsection

@section('footer')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
@endsection

@section('content')
<div class="border mb-3 p-1">
    <form action="{{ route('labarugi.index') }}" method="get">
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

<table class="table">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama Rekening</th>
            @if ($before)
            <th style="width: 130px" class="text-center">{{ $before->mulai }}<br>{{ $before->selesai }}</th>
            @endif
            <th style="width: 130px" class="text-center">{{ Periode::find($periode)->mulai }}<br>{{ Periode::find($periode)->selesai }}</th>
        </tr>
    </thead>
    <tbody>
        @php
            $total_penerimaan   =   0;
            $total_biaya        =   0;
            if ($before) {
                $before_penerimaan  =   0;
                $before_biaya       =   0;
            }
        @endphp
        @foreach ($penerimaan as $row)
        @php
            $total_penerimaan       +=  Akun::hitung_kas($row->id, $periode, TRUE);
            if ($before) {
                $before_penerimaan  +=  Akun::hitung_kas($row->id, $before->id, TRUE);
            }
        @endphp
        <tr class="{{ (Akun::hitung_kas($row->id, $periode) OR Akun::hitung_kas($row->id, $before->id ?? $periode)) ? '' : 'bg-active' }}">
            <td>{{ $row->kode_akun }}</td>
            <td>{{ $row->nama_akun }}</td>
            @if ($before)
            <td class="text-right">{{ Akun::hitung_kas($row->id, $before->id) }}</td>
            @endif
            <td class="text-right">{{ Akun::hitung_kas($row->id, $periode) }}</td>
        </tr>
        @endforeach

        @foreach ($biaya as $row)
        @php
            $total_biaya        +=  Akun::hitung_kas($row->id, $periode, TRUE);
            if ($before) {
                $before_biaya   +=  Akun::hitung_kas($row->id, $before->id, TRUE);
            }
        @endphp
        <tr class="{{ (Akun::hitung_kas($row->id, $periode) OR Akun::hitung_kas($row->id, $before->id ?? $periode)) ? '' : 'bg-active' }}">
            <td>{{ $row->kode_akun }}</td>
            <td>{{ $row->nama_akun }}</td>
            @if ($before)
            <td class="text-right">{{ Akun::hitung_kas($row->id, $before->id) }}</td>
            @endif
            <td class="text-right">{{ Akun::hitung_kas($row->id, $periode) }}</td>
        </tr>
        @endforeach

        @php
            $today_bruto        =   ($total_penerimaan - $total_biaya);
            if ($before) {
                $before_bruto   =   ($before_penerimaan - $before_biaya);
            }
        @endphp
        <tr>
            <th colspan="2">Laba (Rugi) Bruto</th>
            @if ($before)
            <td class="text-right">{{ ($before_bruto < 0) ? "(" . number_format(abs($before_bruto), 2) . ")" : number_format($before_bruto, 2) }}</td>
            @endif
            <td class="text-right">{{ ($today_bruto < 0) ? "(" . number_format(abs($today_bruto), 2) . ")" : number_format($today_bruto, 2) }}</td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>


        @php
            $total_beban        =   0;
            $total_kos          =   0;
            if ($before) {
                $before_beban   =   0;
                $before_kos     =   0;
            }
        @endphp
        @foreach ($beban as $row)
        @php
            $total_beban       +=  Akun::hitung_kas($row->id, $periode, TRUE);
            if ($before) {
                $before_beban  +=  Akun::hitung_kas($row->id, $before->id, TRUE);
            }
        @endphp
        <tr class="{{ (Akun::hitung_kas($row->id, $periode) OR Akun::hitung_kas($row->id, $before->id ?? $periode)) ? '' : 'bg-active' }}">
            <td>{{ $row->kode_akun }}</td>
            <td>{{ $row->nama_akun }}</td>
            @if ($before)
            <td class="text-right">{{ Akun::hitung_kas($row->id, $before->id) }}</td>
            @endif
            <td class="text-right">{{ Akun::hitung_kas($row->id, $periode) }}</td>
        </tr>
        @endforeach

        @foreach ($kos as $row)
        @php
            $total_kos        +=  Akun::hitung_kas($row->id, $periode, TRUE);
            if ($before) {
                $before_kos   +=  Akun::hitung_kas($row->id, $before->id, TRUE);
            }
        @endphp
        <tr class="{{ (Akun::hitung_kas($row->id, $periode) OR Akun::hitung_kas($row->id, $before->id ?? $periode)) ? '' : 'bg-active' }}">
            <td>{{ $row->kode_akun }}</td>
            <td>{{ $row->nama_akun }}</td>
            @if ($before)
            <td class="text-right">{{ Akun::hitung_kas($row->id, $before->id) }}</td>
            @endif
            <td class="text-right">{{ Akun::hitung_kas($row->id, $periode) }}</td>
        </tr>
        @endforeach

        @php
            $today_keluar       =   ($total_beban + $total_kos);
            if ($before) {
                $before_keluar  =   ($before_beban + $before_kos);
            }
        @endphp
        <tr>
            <th colspan="2">Total Biaya dan Beban</th>
            @if ($before)
            <td class="text-right">{{ ($before_keluar < 0) ? "(" . number_format(abs($before_keluar), 2) . ")" : number_format($before_keluar, 2) }}</td>
            @endif
            <td class="text-right">{{ ($today_keluar < 0) ? "(" . number_format(abs($today_keluar), 2) . ")" : number_format($today_keluar, 2) }}</td>
        </tr>

        @php
            $today_ops          =   ($today_bruto - $today_keluar);
            if ($before) {
                $before_ops     =   ($before_bruto - $before_keluar);
            }
        @endphp
        <tr>
            <th colspan="2">Laba (Rugi) Operasi</th>
            @if ($before)
            <td class="text-right">{{ ($before_ops < 0) ? "(" . number_format(abs($before_ops), 2) . ")" : number_format($before_ops, 2) }}</td>
            @endif
            <td class="text-right">{{ ($today_ops < 0) ? "(" . number_format(abs($today_ops), 2) . ")" : number_format($today_ops, 2) }}</td>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>


        @php
            $total_cash_other   =   0;
            $total_cost_other        =   0;
            if ($before) {
                $before_cash_other  =   0;
                $before_cost_other       =   0;
            }
        @endphp
        @foreach ($cash_other as $row)
        @php
            $total_cash_other       +=  Akun::hitung_kas($row->id, $periode, TRUE);
            if ($before) {
                $before_cash_other  +=  Akun::hitung_kas($row->id, $before->id, TRUE);
            }
        @endphp
        <tr class="{{ (Akun::hitung_kas($row->id, $periode) OR Akun::hitung_kas($row->id, $before->id ?? $periode)) ? '' : 'bg-active' }}">
            <td>{{ $row->kode_akun }}</td>
            <td>{{ $row->nama_akun }}</td>
            @if ($before)
            <td class="text-right">{{ Akun::hitung_kas($row->id, $before->id) }}</td>
            @endif
            <td class="text-right">{{ Akun::hitung_kas($row->id, $periode) }}</td>
        </tr>
        @endforeach

        @foreach ($cost_other as $row)
        @php
            $total_cost_other        +=  Akun::hitung_kas($row->id, $periode, TRUE);
            if ($before) {
                $before_cost_other   +=  Akun::hitung_kas($row->id, $before->id, TRUE);
            }
        @endphp
        <tr class="{{ (Akun::hitung_kas($row->id, $periode) OR Akun::hitung_kas($row->id, $before->id ?? $periode)) ? '' : 'bg-active' }}">
            <td>{{ $row->kode_akun }}</td>
            <td>{{ $row->nama_akun }}</td>
            @if ($before)
            <td class="text-right">{{ Akun::hitung_kas($row->id, $before->id) }}</td>
            @endif
            <td class="text-right">{{ Akun::hitung_kas($row->id, $periode) }}</td>
        </tr>
        @endforeach

        @php
            $today_bruto_other        =   ($total_cash_other - $total_cost_other);
            if ($before) {
                $before_bruto_other   =   ($before_cash_other - $before_cost_other);
            }
        @endphp
        <tr>
            <th colspan="2">Laba (Rugi) Lainnya</th>
            @if ($before)
            <td class="text-right">{{ ($before_bruto_other < 0) ? "(" . number_format(abs($before_bruto_other), 2) . ")" : number_format($before_bruto_other, 2) }}</td>
            @endif
            <td class="text-right">{{ ($today_bruto_other < 0) ? "(" . number_format(abs($today_bruto_other), 2) . ")" : number_format($today_bruto_other, 2) }}</td>
        </tr>

        @php
            $today_bersih       =   ($today_bruto_other + ($today_ops));
            if ($before) {
                $before_bersih  =   ($before_bruto_other + ($before_ops));
            }
        @endphp
        <tr>
            <th colspan="2">Laba (Rugi) Bersih</th>
            @if ($before)
            <td class="text-right">{{ ($before_bersih < 0) ? "(" . number_format(abs($before_bersih), 2) . ")" : number_format($before_bersih, 2) }}</td>
            @endif
            <td class="text-right">{{ ($today_bersih < 0) ? "(" . number_format(abs($today_bersih), 2) . ")" : number_format($today_bersih, 2) }}</td>
        </tr>
    </tbody>
</table>
@endsection

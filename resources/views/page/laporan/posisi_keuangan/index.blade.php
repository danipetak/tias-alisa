@extends('layouts.main')

@section('title', 'Laporan Posisi Keuangan')

@section('header')
<link href="{{ asset('vendor/select2/css/select2.css') }}" rel="stylesheet" />
@endsection

@section('footer')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
@endsection

@section('content')
<div class="border mb-3 p-1">
    <form action="{{ route('posisikeuangan.index') }}" method="get">
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
        @php $total_aset =   0; @endphp
        @if ($before)
        @php $before_aset =   0; @endphp
        @endif
        @foreach ($aset as $row)
        @php $total_aset +=  Akun::hitung_kas($row->id, $periode, TRUE); @endphp
        @if ($before)
        @php $before_aset +=  Akun::hitung_kas($row->id, $before->id, TRUE); @endphp
        @endif
        <tr class="{{ (Akun::hitung_kas($row->id, $periode) OR Akun::hitung_kas($row->id, $before->id ?? $periode)) ? '' : 'bg-active' }}">
            <td><a href="{{ route('posisikeuangan.show', [$row->id, 'periode' => $periode]) }}">{{ $row->kode_akun }}</a></td>
            <td><a href="{{ route('posisikeuangan.show', [$row->id, 'periode' => $periode]) }}">{{ $row->nama_akun }}</a></td>
            @if ($before)
            <td class="text-right">{{ Akun::hitung_kas($row->id, $before->id) }}</td>
            @endif
            <td class="text-right">{{ Akun::hitung_kas($row->id, $periode) }}</td>
        </tr>
        @endforeach
        <tr>
            <th colspan="2">Total Aset</th>
            @if ($before)
            <th class="text-right">{{ $total_aset < 0 ? "(". number_format(abs($before_aset), 2) .")" : number_format($before_aset, 2) }}</th>
            @endif
            <th class="text-right">{{ $total_aset < 0 ? "(". number_format(abs($total_aset), 2) .")" : number_format($total_aset, 2) }}</th>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>

        @php $total_kewajiban   =   0; @endphp
        @if ($before)
        @php $before_kewajiban   =   0; @endphp
        @endif
        @foreach ($kewajiban as $row)
        @php $total_kewajiban   +=  Akun::hitung_kas($row->id, $periode, TRUE); @endphp
        @if ($before)
        @php $before_kewajiban   +=  Akun::hitung_kas($row->id, $before->id, TRUE); @endphp
        @endif
        <tr class="{{ (Akun::hitung_kas($row->id, $periode) OR Akun::hitung_kas($row->id, $before->id ?? $periode)) ? '' : 'bg-active' }}">
            <td><a href="{{ route('posisikeuangan.show', [$row->id, 'periode' => $periode]) }}">{{ $row->kode_akun }}</a></td>
            <td><a href="{{ route('posisikeuangan.show', [$row->id, 'periode' => $periode]) }}">{{ $row->nama_akun }}</a></td>
            @if ($before)
            <td class="text-right">{{ Akun::hitung_kas($row->id, $before->id) }}</td>
            @endif
            <td class="text-right">{{ Akun::hitung_kas($row->id, $periode) }}</td>
        </tr>
        @endforeach
        <tr>
            <th colspan="2">Total Kewajiban</th>
            @if ($before)
            <th class="text-right">{{ $total_kewajiban < 0 ? "(". number_format(abs($before_kewajiban), 2) .")" : number_format($before_kewajiban, 2) }}</th>
            @endif
            <th class="text-right">{{ $total_kewajiban < 0 ? "(". number_format(abs($total_kewajiban), 2) .")" : number_format($total_kewajiban, 2) }}</th>
        </tr>
        <tr>
            <td colspan="4">&nbsp;</td>
        </tr>

        @php $total_modal   =   0; @endphp
        @if ($before)
        @php $before_modal   =   0; @endphp
        @endif
        @foreach ($modal as $row)
        @php $total_modal   +=  Akun::hitung_kas($row->id, $periode, TRUE); @endphp
        @if ($before)
        @php $before_modal   +=  Akun::hitung_kas($row->id, $before->id, TRUE); @endphp
        @endif
        <tr class="{{ (Akun::hitung_kas($row->id, $periode) OR Akun::hitung_kas($row->id, $before->id ?? $periode)) ? '' : 'bg-active' }}">
            <td><a href="{{ route('posisikeuangan.show', [$row->id, 'periode' => $periode]) }}">{{ $row->kode_akun }}</a></td>
            <td><a href="{{ route('posisikeuangan.show', [$row->id, 'periode' => $periode]) }}">{{ $row->nama_akun }}</a></td>
            @if ($before)
            <td class="text-right">{{ Akun::hitung_kas($row->id, $before->id) }}</td>
            @endif
            <td class="text-right">{{ Akun::hitung_kas($row->id, $periode) }}</td>
        </tr>
        @endforeach
        <tr>
            <th colspan="2">Total Ekuitas</th>
            @if ($before)
            <th class="text-right">{{ $total_modal < 0 ? "(". number_format(abs($before_modal), 2) .")" : number_format($before_modal, 2) }}</th>
            @endif
            <th class="text-right">{{ $total_modal < 0 ? "(". number_format(abs($total_modal), 2) .")" : number_format($total_modal, 2) }}</th>
        </tr>
    </tbody>
</table>
@endsection

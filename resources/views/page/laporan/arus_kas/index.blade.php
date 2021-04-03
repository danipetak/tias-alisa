@extends('layouts.main')

@section('title', 'Laporan Arus Kas')

@section('header')
<link href="{{ asset('vendor/select2/css/select2.css') }}" rel="stylesheet" />
@endsection

@section('footer')
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
@endsection

@section('content')
<div class="border mb-3 p-1">
    <form action="{{ route('aruskas.index') }}" method="get">
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
            <th>Nama Arus Kas</th>
            @if ($before)
            <th style="width: 130px" class="text-center">{{ $before->mulai }}<br>{{ $before->selesai }}</th>
            @endif
            <th style="width: 130px" class="text-center">{{ $around->mulai }}<br>{{ $around->selesai }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach (Kas::report_akun('penerimaan', 'operasional', $periode) as $row)
        <tr>
            <td>
                <a href="{{ route('aruskas.show', [ $row->idcash, 'periode' => $periode]) }}">
                    {{ $row->nama }}
                </a>
            </td>
            @if ($before)
            <td class="text-right">{{ number_format(abs(Kas::hasil_report('operasional', $before->id, 'penerimaan', $row->idcash)), 2) }}</td>
            @endif
            <td class="text-right">{{ number_format(abs(Kas::hasil_report('operasional', $periode, 'penerimaan', $row->idcash)), 2) }}</td>
        </tr>
        @endforeach

        @foreach (Kas::report_akun('pengeluaran', 'operasional', $periode) as $row)
        <tr>
            <td>
                <a href="{{ route('aruskas.show', [ $row->idcash, 'periode' => $periode]) }}">
                    {{ $row->nama }}
                </a>
            </td>
            @if ($before)
            <td class="text-right">{{ number_format(abs(Kas::hasil_report('operasional', $before->id, 'pengeluaran', $row->id)), 2) }}</td>
            @endif
            <td class="text-right">{{ number_format(abs(Kas::hasil_report('operasional', $periode, 'pengeluaran', $row->id)), 2) }}</td>
        </tr>
        @endforeach
        <tr class="bg-active">
            <th>Arus Kas dari Aktivitas Operasional</th>
            @if ($before)
            <th class="text-right">
                {{ Kas::hasil_report('operasional', $before->id) < 0 ? "(" . number_format(abs(Kas::hasil_report('operasional', $before->id)), 2) . ")" : number_format(Kas::hasil_report('operasional', $before->id), 2) }}
            </th>
            @endif
            <th class="text-right">
                {{ Kas::hasil_report('operasional', $periode) < 0 ? "(" . number_format(abs(Kas::hasil_report('operasional', $periode)), 2) . ")" : number_format(Kas::hasil_report('operasional', $periode), 2) }}
            </th>
        </tr>

        @foreach (Kas::report_akun('penerimaan', 'pendanaan', $periode) as $row)
        <tr>
            <td>
                <a href="{{ route('aruskas.show', [ $row->idcash, 'periode' => $periode]) }}">
                    {{ $row->nama }}
                </a>
            </td>
            @if ($before)
            <td class="text-right">{{ number_format(abs(Kas::hasil_report('pendanaan', $before->id, 'penerimaan', $row->id)), 2) }}</td>
            @endif
            <td class="text-right">{{ number_format(abs(Kas::hasil_report('pendanaan', $periode, 'penerimaan', $row->id)), 2) }}</td>
        </tr>
        @endforeach

        @foreach (Kas::report_akun('pengeluaran', 'pendanaan', $periode) as $row)
        <tr>
            <td>
                <a href="{{ route('aruskas.show', [ $row->idcash, 'periode' => $periode]) }}">
                    {{ $row->nama }}
                </a>
            </td>
            @if ($before)
            <td class="text-right">{{ number_format(abs(Kas::hasil_report('pendanaan', $before->id, 'pengeluaran', $row->id)), 2) }}</td>
            @endif
            <td class="text-right">{{ number_format(abs(Kas::hasil_report('pendanaan', $periode, 'pengeluaran', $row->id)), 2) }}</td>
        </tr>
        @endforeach

        <tr class="bg-active">
            <th>Arus Kas dari Aktivitas Pendanaan</th>
            @if ($before)
            <th class="text-right">
                {{ Kas::hasil_report('pendanaan', $before->id) < 0 ? "(" . number_format(abs(Kas::hasil_report('pendanaan', $before->id)), 2) . ")" : number_format(Kas::hasil_report('pendanaan', $before->id), 2) }}
            </th>
            @endif
            <th class="text-right">
                {{ Kas::hasil_report('pendanaan', $periode) < 0 ? "(" . number_format(abs(Kas::hasil_report('pendanaan', $periode)), 2) . ")" : number_format(Kas::hasil_report('pendanaan', $periode), 2) }}
            </th>
        </tr>

        @foreach (Kas::report_akun('penerimaan', 'investasi', $periode) as $row)
        <tr>
            <td>
                <a href="{{ route('aruskas.show', [ $row->idcash, 'periode' => $periode]) }}">
                    {{ $row->nama }}
                </a>
            </td>
            @if ($before)
            <td class="text-right">{{ number_format(abs(Kas::hasil_report('penerimaan', $before->id, 'investasi', $row->id)), 2) }}</td>
            @endif
            <td class="text-right">{{ number_format(abs(Kas::hasil_report('penerimaan', $periode, 'investasi', $row->id)), 2) }}</td>
        </tr>
        @endforeach

        @foreach (Kas::report_akun('pengeluaran', 'investasi', $periode) as $row)
        <tr>
            <td>
                <a href="{{ route('aruskas.show', [ $row->idcash, 'periode' => $periode]) }}">
                    {{ $row->nama }}
                </a>
            </td>
            @if ($before)
            <td class="text-right">{{ number_format(abs(Kas::hasil_report('pengeluaran', $before->id, 'investasi', $row->id)), 2) }}</td>
            @endif
            <td class="text-right">{{ number_format(abs(Kas::hasil_report('pengeluaran', $periode, 'investasi', $row->id)), 2) }}</td>
        </tr>
        @endforeach

        <tr class="bg-active">
            <th>Arus Kas dari Aktivitas Investasi</th>
            @if ($before)
            <th class="text-right">
                {{ Kas::hasil_report('investasi', $before->id) < 0 ? "(" . number_format(abs(Kas::hasil_report('investasi', $before->id)), 2) . ")" : number_format(Kas::hasil_report('investasi', $before->id), 2) }}
            </th>
            @endif
            <th class="text-right">
                {{ Kas::hasil_report('investasi', $periode) < 0 ? "(" . number_format(abs(Kas::hasil_report('investasi', $periode)), 2) . ")" : number_format(Kas::hasil_report('investasi', $periode), 2) }}
            </th>
        </tr>

    </tbody>
    <tfoot>
        <tr>
            <th>Arus Kas Periode Berjalan</th>
            @if ($before)
            <th class="text-right">
                @php
                    $hasil  =    Kas::hasil_report('operasional', $before->id) + Kas::hasil_report('pendanaan', $before->id) + Kas::hasil_report('investasi', $before->id);
                @endphp
                {{ $hasil < 0 ? "(" . number_format(abs($hasil), 2) . ")" : number_format($hasil, 2) }}
            </th>
            @endif
            <th class="text-right">
                @php
                    $hasil2 =    Kas::hasil_report('operasional', $periode) + Kas::hasil_report('pendanaan', $periode) + Kas::hasil_report('investasi', $periode);
                @endphp
                {{ $hasil2 < 0 ? "(" . number_format(abs($hasil2), 2) . ")" : number_format($hasil2, 2) }}
            </th>
        </tr>
        <tr>
            <th>Arus Kas Awal Periode</th>
            @if ($before)
            <th class="text-right">
                {{ Kas::awal_periode($before->id) < 0 ? "(" . number_format(abs(Kas::awal_periode($before->id)), 2) . ")" : number_format(Kas::awal_periode($before->id), 2) }}
            </th>
            @endif
            <th class="text-right">
                {{ Kas::awal_periode($periode) < 0 ? "(" . number_format(abs(Kas::awal_periode($periode)), 2) . ")" : number_format(Kas::awal_periode($periode), 2) }}
            </th>
        </tr>
        <tr>
            <th>Arus Kas Akhir Periode</th>
            @if ($before)
            <th class="text-right">
                @php
                    $akhir  =   $hasil + Kas::awal_periode($before->id);
                @endphp
                {{ $akhir < 0 ? "(" . number_format(abs($akhir), 2) . ")" : number_format($akhir, 2) }}
            </th>
            @endif
            <th class="text-right">
                @php
                    $akhir2 =   $hasil2 + Kas::awal_periode($periode);
                @endphp
                {{ $akhir2 < 0 ? "(" . number_format(abs($akhir2), 2) . ")" : number_format($akhir2, 2) }}
            </th>
        </tr>
    </tfoot>
</table>
@endsection

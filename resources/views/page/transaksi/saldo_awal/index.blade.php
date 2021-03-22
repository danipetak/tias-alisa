@extends('layouts.main')

@section('title', 'Saldo Awal')

@section('header')
<link href="{{ asset('vendor/politespace/politespace.css') }}" rel="stylesheet" />
<link href="{{ asset('vendor/politespace/libs/libs.css') }}" rel="stylesheet" />
@endsection

@section('footer')
<script src="{{ asset('js/accounting.js') }}"></script>
<script src="{{ asset('vendor/politespace/libs/libs.js') }}"></script>
<script src="{{ asset('vendor/politespace/politespace.js') }}"></script>
<script src="{{ asset('vendor/politespace/politespace-init.js') }}"></script>

<script type="text/javascript">
function hitung() {
    // Calculate Debit
    var totalDB     =   0;
    var DB_nom      =   document.getElementsByClassName("db_nom");
    var valuesDB    =   [];
    for(var i = 0; i < DB_nom.length; ++i) {
        var dbt     =   DB_nom[i].value;
        if (dbt === '') {
            var angka_db    =   0;
        } else {
            var angka_db    =   dbt.replace(/,/g, '');
        }
        valuesDB.push(parseFloat(angka_db));
    }
    totalDB         =   (Math.round(valuesDB.reduce(function(previousDB, currentDB, index, array){
                            return previousDB + currentDB;
                        }) * 100) / 100).toFixed(2);

    // Calculate Credit
    var totalCR     =   0;
    var CR_nom      =   document.getElementsByClassName("cr_nom");
    var valuesCR    =   [];
    for(var i = 0; i < CR_nom.length; ++i) {
        var kdt     =   CR_nom[i].value;
        if (kdt === '') {
            var angka_cr    =   0;
        } else {
            var angka_cr    =   kdt.replace(/,/g, '');
        }
        valuesCR.push(parseFloat(angka_cr));
    }
    totalCR         =   (Math.round(valuesCR.reduce(function(previousCR, currentCR, index, array){
                            return previousCR + currentCR;
                        }) * 100) / 100).toFixed(2);

    var result      =   parseFloat(totalDB) - parseFloat(totalCR);

    var debit       =   document.getElementById('hasil_DB');
    var kredit      =   document.getElementById('hasil_CR');
    var submit      =   document.getElementById('submit');
    var message     =   document.getElementById('message');

    debit.innerHTML         =   accounting.formatMoney(totalDB, '');
    kredit.innerHTML        =   accounting.formatMoney(totalCR, '');
    message.innerHTML       =   (result == 0) ? 'BALANCE' : 'NOT BALANCE';
    debit.style             =   (result == 0) ? 'background-color: #81f542; width: 120px' : 'background-color: #f54242; color: #fff; width: 120px' ;
    kredit.style            =   (result == 0) ? 'background-color: #81f542; width: 120px' : 'background-color: #f54242; color: #fff; width: 120px' ;
    message.style           =   (result == 0) ? 'background-color: #81f542; width: 415px' : 'background-color: #f54242; color: #fff; width: 415px' ;
    submit.style            =   (result == 0) ? 'display:block' : 'display:none' ;
}
</script>
@endsection

@section('content')
<div class="float-right" style="position: sticky; top: 50px; z-index: 999">
    <div style="background-color: {{ $debit == $kredit ? '#81f542' : '#f54242; color: #fff' }}; width: 120px;" class="px-1 py-2 text-right float-right" id="hasil_CR">{{ number_format($kredit, 2) }}</div>
    <div style="background-color: {{ $debit == $kredit ? '#81f542' : '#f54242; color: #fff' }}; width: 120px;" class="px-1 py-2 text-right float-right" id="hasil_DB">{{ number_format($debit, 2) }}</div>
    <div style="background-color: {{ $debit == $kredit ? '#81f542' : '#f54242; color: #fff' }}; width: 415px" id="message" class="px-1 py-2 float-right text-center">{{ $debit == $kredit ? 'BALANCE' : 'NOT BALANCE' }}</div>
</div>

<form action="{{ route('saldoawal.store') }}" method="POST">
    @csrf
    <table class="table">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama Rekening</th>
                <th style="width: 120px;">Debit</th>
                <th style="width: 120px;">Kredit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $row)
            <tr>
                <td>{{ $row->kode_akun }}</td>
                <td>
                    {{ $row->nama_akun }}
                    <div>
                        <small>{{ $row->link_akun }}</small>
                    </div>
                </td>
                @if ($row->level == 4) <input type="hidden" value="{{ $row->id }}" name="x_code[]"> @endif
                <td style="width: 120px; {{ ($row->level != 4) ? 'background-color: #ccc' : ($row->sn == 'cr' ? 'background-color: #ccc' : '' ) }}">
                    @if ($row->sn == 'db' AND $row->level == 4) <input type="number" class="text-right db_nom form-text w-100" name="nom[]" onkeyup='hitung(); return false;' value="{{ $row->begining_balance ?? '0.00' }}" data-politespace data-politespace-grouplength="3" data-politespace-delimiter="," data-politespace-decimal-mark="." step="0.01" data-politespace-reverse> @endif
                </td>
                <td style="width: 120px; {{ ($row->level != 4) ? 'background-color: #ccc' : ($row->sn == 'db' ? 'background-color: #ccc' : '' ) }}">
                    @if ($row->sn == 'cr' AND $row->level == 4) <input type="number" class="text-right cr_nom form-text w-100" name="nom[]" onkeyup='hitung(); return false;' value="{{ $row->begining_balance ?? '0.00' }}" data-politespace data-politespace-grouplength="3" data-politespace-delimiter="," data-politespace-decimal-mark="." step="0.01" data-politespace-reverse> @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="form-group my-3 float-right">
        <button class="btn btn-primary" id="submit" style="display:{{ $debit == $kredit ? 'block' : 'none' }}">Submit</button>
    </div>
</form>
@endsection

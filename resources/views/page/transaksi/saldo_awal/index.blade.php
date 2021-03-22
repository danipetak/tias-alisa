@extends('layouts.main')

@section('title', 'Saldo Awal')

@section('footer')
<script type="text/javascript">
function hitung() {
    // Calculate Debit
    var totalDB     =   0;
    var DB_nom      =   document.getElementsByClassName("db_nom");
    var valuesDB    =   [];
    for(var i = 0; i < DB_nom.length; ++i) {
        valuesDB.push(parseFloat(DB_nom[i].value.replace(/,/g, '')));
    }
    totalDB = valuesDB.reduce(function(previousDB, currentDB, index, array){
        return previousDB + currentDB;
    });

    // Calculate Credit
    var totalCR     =   0;
    var CR_nom      =   document.getElementsByClassName("cr_nom");
    var valuesCR    =   [];
    for(var i = 0; i < CR_nom.length; ++i) {
        valuesCR.push(parseFloat(CR_nom[i].value.replace(/,/g, '')));
    }
    totalCR = valuesCR.reduce(function(previousCR, currentCR, index, array){
        return previousCR + currentCR;
    });

    var result  =   parseFloat(totalDB) - parseFloat(totalCR);

    var debit   =   document.getElementById('hasil_DB');
    var kredit  =   document.getElementById('hasil_CR');
    var submit  =   document.getElementById('submit');
    var message =   document.getElementById('message');

    debit.innerHTML         =   totalDB;
    kredit.innerHTML        =   totalCR;
    message.innerHTML       =   (result == 0) ? 'BALANCE' : 'NOT BALANCE';
    debit.style             =   (result == 0) ? 'background-color: #81f542; width: 120px' : 'background-color: #f54242; color: #fff; width: 120px' ;
    kredit.style            =   (result == 0) ? 'background-color: #81f542; width: 120px' : 'background-color: #f54242; color: #fff; width: 120px' ;
    message.style           =   (result == 0) ? 'background-color: #81f542; width: 415px' : 'background-color: #f54242; color: #fff; width: 415px' ;
    submit.style            =   (result == 0) ? 'display:block' : 'display:none' ;
}
</script>
@endsection

@section('content')
<div class="float-right" style="position: sticky; top: 50px">
    <div style="background-color: {{ $debit == $kredit ? '#81f542' : '#f54242; color: #fff' }}; width: 120px;" class="px-1 py-2 text-right float-right" id="hasil_CR">{{ number_format($kredit, 2) }}</div>
    <div style="background-color: {{ $debit == $kredit ? '#81f542' : '#f54242; color: #fff' }}; width: 120px;" class="px-1 py-2 text-right float-right" id="hasil_DB">{{ number_format($debit, 2) }}</div>
    <div style="background-color: {{ $debit == $kredit ? '#81f542' : '#f54242; color: #fff' }}; width: 415px" id="message" class="px-1 py-2 float-right text-center">{{ $debit == $kredit ? 'BALANCE' : 'NOT BALANCE' }}</div>
</div>

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
            <td style="width: 120px; {{ ($row->level != 4) ? 'background-color: #ccc' : ($row->sn == 'cr' ? 'background-color: #ccc' : '' ) }}">
                @if ($row->sn == 'db' AND $row->level == 4) <input type="number" class="text-right db_nom form-text w-100" name="db[]" onkeyup='hitung(); return false;' value="{{ $row->begining_balance ?? '0.00' }}"> @endif
            </td>
            <td style="width: 120px; {{ ($row->level != 4) ? 'background-color: #ccc' : ($row->sn == 'db' ? 'background-color: #ccc' : '' ) }}">
                @if ($row->sn == 'cr' AND $row->level == 4) <input type="number" class="text-right cr_nom form-text w-100" name="cr[]" onkeyup='hitung(); return false;' value="{{ $row->begining_balance ?? '0.00' }}"> @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<div class="form-group my-3 float-right">
    <button class="btn btn-primary" id="submit" style="display:{{ $debit == $kredit ? 'block' : 'none' }}">Submit</button>
</div>
@endsection

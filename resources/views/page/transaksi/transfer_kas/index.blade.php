@extends('layouts.main')

@section('title', 'Transaksi Jurnal Transfer Kas')

@section('header')
<link href="{{ asset('vendor/select2/css/select2.css') }}" rel="stylesheet" />
<link href="{{ asset('vendor/politespace/politespace.css') }}" rel="stylesheet" />
@endsection

@section('footer')
<script src="{{ asset('js/accounting.js') }}"></script>
<script src="{{ asset('vendor/politespace/libs/libs.js') }}"></script>
<script src="{{ asset('vendor/politespace/politespace.js') }}"></script>
<script src="{{ asset('vendor/politespace/politespace-init.js') }}"></script>
<script src="{{ asset('js/calculate_gj.js') }}"></script>
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>

<script>
var x = 1;
function addRow() {
    var row = '';
    row += '<div class="row mb-1 add-column column-' + (x) + '">';
    row += '    <div class="col-6 mr-1">';
    row += "        <select name='rek[]' class='rek select2 items form-control' required data-placeholder='Pilih Rekening'>";
    row += "        <option value=''></option>";
    row += "        {!! Akun::daftar_akun(FALSE, 'kas') !!}";
    row += "        </select>";
    row += '    </div>';
    row += '    <div class="col mx-1">';
    row += '        <input type="text" name="db[]" class="db form-control text-right" autocomplete="off" onkeyup="hitung(); return false;" value="0.00" data-politespace data-politespace-grouplength="3" data-politespace-delimiter="," data-politespace-decimal-mark="." step="0.01" data-politespace-reverse>';
    row += '    </div>';
    row += '    <div class="col mx-1">';
    row += '        <input type="text" name="cr[]" class="cr form-control text-right" autocomplete="off" onkeyup="hitung(); return false;" value="0.00" data-politespace data-politespace-grouplength="3" data-politespace-delimiter="," data-politespace-decimal-mark="." step="0.01" data-politespace-reverse>';
    row += '    </div>';
    row += '    <div class="col-1 text-center" onclick="deleteRow(' + (x) + ')"><button type="button" class="btn btn-danger">x</button></div>';
    row += '</div>';
    $('.rek-loop').append(row);

    $(document).ready(function () {
        $('.select2').select2();
    });

    jQuery(function () {
        jQuery(document).trigger("enhance");
    });
    x++;
}

function deleteRow(rowid) {
    $('.column-' + rowid).remove();
    var totalDB     =   0;
    var DB_nom      =   document.getElementsByClassName("db");
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
    var CR_nom      =   document.getElementsByClassName("cr");
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

    var result      =   totalDB - totalCR;
    var alert       =   document.getElementById('info-alert');
    var info        =   document.getElementById('info-balance');

    document.getElementById('data_DB').innerHTML = accounting.formatMoney(totalDB, '');
    document.getElementById('data_CR').innerHTML = accounting.formatMoney(totalCR, '');

    if (result == 0) {
        if ((totalDB > 0) || (totalCR > 0)) {
            info.innerHTML  = "BALANCE";
            alert.style     = "background-color:#157347;color:#fff";
        } else {
            info.innerHTML  = "TIDAK ADA TRANSAKSI";
            alert.style     = "";
        }
    } else {
        info.innerHTML  = "NOT BALANCE";
        alert.style     = "background-color:#bb2d3b;color:#fff";
    }
}

$(document).ready(function() {
    $('#btnSubmit').click(function(e){
        e.preventDefault();
        $(document).find("span.text-danger").remove();

        var rekening    =   document.getElementsByClassName("rek");
        var valRekening =   [];
        for(var i = 0; i < rekening.length; ++i) {
            valRekening.push(rekening[i].value);
        }

        var totalDB     =   0;
        var DB_nom      =   document.getElementsByClassName("db");
        var valuesDB    =   [];
        var data_db     =   [];
        for(var i = 0; i < DB_nom.length; ++i) {
            var dbt     =   DB_nom[i].value;
            if (dbt === '') {
                var angka_db    =   0;
            } else {
                var angka_db    =   dbt.replace(/,/g, '');
            }
            valuesDB.push(parseFloat(angka_db));
            data_db.push(angka_db);
        }

        totalDB         =   (Math.round(valuesDB.reduce(function(previousDB, currentDB, index, array){
                                return previousDB + currentDB;
                            }) * 100) / 100).toFixed(2);

        // Calculate Credit
        var totalCR     =   0;
        var CR_nom      =   document.getElementsByClassName("cr");
        var valuesCR    =   [];
        var data_cr     =   [];
        for(var i = 0; i < CR_nom.length; ++i) {
            var kdt     =   CR_nom[i].value;
            if (kdt === '') {
                var angka_cr    =   0;
            } else {
                var angka_cr    =   kdt.replace(/,/g, '');
            }
            valuesCR.push(parseFloat(angka_cr));
            data_cr.push(angka_cr);
        }
        totalCR         =   (Math.round(valuesCR.reduce(function(previousCR, currentCR, index, array){
                                return previousCR + currentCR;
                            }) * 100) / 100).toFixed(2);

        var result      =   totalDB - totalCR;

        if (result == 0) {
            if ((totalDB != 0) || (totalCR != 0)) {

                var tanggal_transaksi   =   $("#tanggal_transaksi").val();
                var jenis_transaksi     =   $("input[name=jenis_transaksi]:checked").val();
                var uraian              =   $("#uraian").val();

                $.ajax({
                    url: "{{ route('jurnaltransfer.store') }}",
                    type:"POST",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        valRekening         : valRekening ,
                        data_db             : data_db ,
                        data_cr             : data_cr ,
                        tanggal_transaksi   : tanggal_transaksi,
                        uraian              : uraian,
                        jenis_transaksi     : jenis_transaksi,
                    },

                    success:function(response){
                        $("#tanggal_transaksi").val("{{ date('Y-m-d') }}");
                        $("#uraian").val('');
                        $(".rek").select2().val(null).trigger("change");
                        $('.politespace-proxy-val').html('0.00');
                        $('#data_DB').html('0.00');
                        $('#data_CR').html('0.00');
                        $('.db').val('0.00');
                        $('.cr').val('0.00');
                        $('.add-column').remove();
                        document.getElementById('notif-success').innerHTML  =   'Transaksi jurnal transfer kas berhasil ditambahkan';
                        document.getElementById('notif-success').style      =   '';
                        $('#topbar-notification').fadeIn();
                        setTimeout(function() {
                            $('#topbar-notification').fadeOut();
                            document.getElementById('notif-error').style    =   'display: none';
                            document.getElementById('notif-success').style  =   'display: none';
                        }, 2000) ;
                    },

                    error: function(response) {
                        $.each(response.responseJSON.errors,function(field_name,error){
                            $(document).find('[name='+ field_name +']').after('<span class="text-danger">' + error + '</span>')
                        });
                    }

                });

            } else {
                document.getElementById('notif-error').innerHTML  =   'Tidak ada transaksi. Isikan daftar rekening beserta nominalnya';
                document.getElementById('notif-error').style      =   '';
                $('#topbar-notification').fadeIn();
                setTimeout(function() {
                    $('#topbar-notification').fadeOut();
                    document.getElementById('notif-error').style    =   'display: none';
                    document.getElementById('notif-success').style  =   'display: none';
                }, 2000) ;
            }

        } else {
            document.getElementById('notif-error').innerHTML  =   'Debit dan kredit tidak seimbang';
            document.getElementById('notif-error').style      =   '';
            $('#topbar-notification').fadeIn();
            setTimeout(function() {
                $('#topbar-notification').fadeOut();
                document.getElementById('notif-error').style    =   'display: none';
                document.getElementById('notif-success').style  =   'display: none';
            }, 2000) ;
        }
    });
});
</script>
@endsection

@section('content')
<div class="row pb-2 mb-3 border-bottom">
    <div class="col-3 mr-1">
        <div class="form-group">
            Tanggal Transaksi
            <input type="date" name="tanggal_transaksi" class="form-control" value="{{ old('tanggal_transaksi') ?? date('Y-m-d') }}" id="tanggal_transaksi" autocomplete="off">
        </div>
    </div>

    <div class="col ml-1">
        <div class="form-group">
            Uraian
            <input type="text" name="uraian" class="form-control" value="{{ old('uraian') }}" id="uraian" placeholder="Tuliskan Uraian" autocomplete="off">
        </div>
    </div>
</div>

<div class="border p-1 mb-3">

    <div class="row mb-1">
        <div class="text-center font-bold col-6 mr-1">Rekening</div>
        <div class="text-center font-bold col mx-1">Debit</div>
        <div class="text-center font-bold col mx-1">Kredit</div>
        <div class="col-1"></div>
    </div>

    <div class="rek-loop">
        <div class="row mb-1">
            <div class="col-6 mr-1">
                <select class="form-control rek select2" name="rek[]" required data-width="100%" data-placeholder='Pilih Rekening'>
                    <option value=""></option>
                    {!! Akun::daftar_akun(FALSE, 'kas') !!}
                </select>
            </div>

            <div class="col mx-1">
                <input type="number" name="db[]" class="form-control db text-right" value="0.00" autocomplete="off" onkeyup="hitung(); return false;" data-politespace data-politespace-grouplength="3" data-politespace-delimiter="," data-politespace-decimal-mark="." step="0.01" data-politespace-reverse>
            </div>

            <div class="col mx-1">
                <input type="number" name="cr[]" class="form-control cr text-right" value="0.00" autocomplete="off" onkeyup="hitung(); return false;" data-politespace data-politespace-grouplength="3" data-politespace-delimiter="," data-politespace-decimal-mark="." step="0.01" data-politespace-reverse>
            </div>
            <div class="col-1"></div>
        </div>
    </div>

    <div id='info-alert'>
        <div class="row my-2">
            <div class="text-center text-bold pt-1 col-6 mr-2" id='info-balance'>TIDAK ADA TRANSAKSI</div>
            <div class="text-right pt-1 col mx-2" id='data_DB'>0.00</div>
            <div class="text-right pt-1 col mx-2" id='data_CR'>0.00</div>
            <div class="col-1 text-center"><button type="button" class="btn btn-success d-inline-block" onclick="addRow()">+</button></div>
        </div>
    </div>

</div>

<button type="button" id='btnSubmit' class="selesaikan btn btn-success float-right px-3 submit">Submit</button>
@endsection

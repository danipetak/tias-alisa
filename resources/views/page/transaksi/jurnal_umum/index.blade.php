@extends('layouts.main')

@section('title', 'Transaksi Jurnal Umum')

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
    $("input[name=jenis_transaksi]").change(function(){
        var rwt = document.getElementById('perubahan');
        var trs = document.getElementById('riwayat_transaksi');
        if ($(this).val() == 0) {
            rwt.style       =   '';
            trs.required    =   true;
        } else {
            rwt.style       =   'display:none';
            trs.required    =   false;
        }
    });
</script>

<script type="text/javascript">
$(".form-submit").submit(function () {
    $('.submit').hide(function(){
        document.getElementById('noted').innerHTML  = "<b>Mohon Ditunggu</b>";
    });
});

var x = 1;
function addRow() {
    var row = '';
    row += '<div class="row mb-1 column-' + (x) + '">';
    row += '    <div class="col-6 mr-1">';
    row += "        <select name='rek[]' class='select2 items form-control' required data-placeholder='Pilih Rekening'>";
    row += "        <option value=''></option>";
    row += "        {!! Akun::daftar_akun() !!}";
    row += "        </select>";
    row += '    </div>';
    row += '    <div class="col mx-1">';
    row += '        <input type="text" name="db[]" class="db form-control text-right" autocomplete="off" onkeyup="hitung(); return false;" value="0.00" data-politespace data-politespace-grouplength="3" data-politespace-delimiter="," data-politespace-decimal-mark="." step="0.01" data-politespace-reverse>';
    row += '    </div>';
    row += '    <div class="col mx-1">';
    row += '        <input type="text" name="cr[]" class="cr form-control text-right" autocomplete="off" onkeyup="hitung(); return false;" value="0.00" data-politespace data-politespace-grouplength="3" data-politespace-delimiter="," data-politespace-decimal-mark="." step="0.01" data-politespace-reverse>';
    row += '    </div>';
    row += '    <div class="col-1 text-center" onclick="deleteRow(' + (x) + ')"><button type="button" class="btn btn-danger">x</div>';
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

    var result      =   parseFloat(totalDB) - parseFloat(totalCR);
    var alert       =   document.getElementById('info-alert');
    var info        =   document.getElementById('info-balance');

    document.getElementById('data_DB').innerHTML = accounting.formatMoney(totalDB, '');
    document.getElementById('data_CR').innerHTML = accounting.formatMoney(totalCR, '');

    if (result == 0) {
        if ((parseFloat(totalDB) > 0) || (parseFloat(totalCR) > 0)) {
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

        var result      =   parseFloat(totalDB) - parseFloat(totalCR);

        if (result == 0) {
            var tanggal_transaksi   =   $("#tanggal_transaksi").val();
            var jenis_transaksi     =   $("input[name=jenis_transaksi]").val();
            var uraian              =   $("#uraian").val();
            var arus_kas            =   $("#arus_kas").val();
            var riwayat_transaksi   =   $("#riwayat_transaksi").val();

            $.ajax({
                url: "{{ route('jurmalumum.store') }}",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    tanggal_transaksi : tanggal_transaksi,
                    uraian  : uraian,
                    arus_kas : arus_kas,
                    jenis_transaksi : jenis_transaksi,
                    riwayat_transaksi : riwayat_transaksi,
                },

                success:function(response){
                    //
                },

                error: function(response) {
                    $.each(response.responseJSON.errors,function(field_name,error){
                        $(document).find('[name='+ field_name +']').after('<span class="text-danger">' + error + '</span>')
                    });
                }

            });

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
            Tanggal Transaksi <span class="text-danger">*</span>
            <input type="date" name="tanggal_transaksi" class="form-control" value="{{ old('tanggal_transaksi') ?? date('Y-m-d') }}" id="tanggal_transaksi" autocomplete="off">
        </div>

        <div class="form-group">
            Jenis Transaksi
            <div>
                <input type="radio" name="jenis_transaksi" value="1" id='trasnsaksi_baru' checked required>
                <label for="trasnsaksi_baru">Transaksi Baru</label>
            </div>

            <div>
                <input type="radio" name="jenis_transaksi" value="0" id='pembaharuan_transaksi' required>
                <label for="pembaharuan_transaksi">Perubahan Transaksi</label>
            </div>
        </div>
    </div>

    <div class="col ml-1">
        <div class="form-group" id='perubahan' style="display: none">
            Transaksi Akan Dirubah
            <select class="form-control select2" name="riwayat_transaksi" id='riwayat_transaksi' data-width="100%" data-placeholder='Pilih Transaksi'>
                <option value=""></option>
                <option value="1">fdsfdsfsdds</option>
                {{-- {!! $riwayat !!} --}}
            </select>
        </div>

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
                    {!! Akun::daftar_akun() !!}
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
            <div class="text-center font-bold pt-1 col-6 mr-2" id='info-balance'>TIDAK ADA TRANSAKSI</div>
            <div class="text-right font-bold pt-1 col mx-2" id='data_DB'></div>
            <div class="text-right font-bold pt-1 col mx-2" id='data_CR'></div>
            <div class="col-1 text-center"><button type="button" class="btn btn-success d-inline-block" onclick="addRow()">+</button></div>
        </div>
    </div>

</div>

<div class="border p-1 mb-3">
    <div class="row">
        <div class="col mr-1">
            <div class="form-group">
                Arus Kas
                <select class="form-control select2" id='arus_kas' name="arus_kas" required data-width="100%" data-placeholder='Pilih Arus Kas'>
                    <option value=""></option>
                    @foreach ($aruskas as $id => $nama)
                    <option value="{{ $id }}">{{ $nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-2 ml-1">
            <div class="form-group">
                &nbsp;
                <button type="button" id='btnSubmit' class="selesaikan btn btn-success btn-block float-right submit">Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection

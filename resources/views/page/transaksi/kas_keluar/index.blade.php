@extends('layouts.main')

@section('title', 'Transaksi Jurnal Kas Keluar')

@section('header')
<link href="{{ asset('vendor/select2/css/select2.css') }}" rel="stylesheet" />
<link href="{{ asset('vendor/politespace/politespace.css') }}" rel="stylesheet" />
@endsection

@section('footer')
<script src="{{ asset('js/accounting.js') }}"></script>
<script src="{{ asset('vendor/politespace/libs/libs.js') }}"></script>
<script src="{{ asset('vendor/politespace/politespace.js') }}"></script>
<script src="{{ asset('vendor/politespace/politespace-init.js') }}"></script>
<script src="{{ asset('js/calculate_kas.js') }}"></script>
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#riwayat').load("{{ route('jurnalkeluar.riwayat') }}");
    });
    $("input[name=jenis_transaksi]").change(function(){
        var rwt = document.getElementById('perubahan');
        var trs = document.getElementById('riwayat');
        if ($(this).val() == 0) {
            rwt.style       =   '';
            trs.required    =   true;
        } else {
            rwt.style       =   'display:none';
            trs.required    =   false;
        }
    });

    var x = 1;
    function addRow() {
        var row = '';
        row += '<div class="row mb-1 add-column column-' + (x) + '">';
        row += '    <div class="col-8 mr-1">';
        row += "        <select name='rek[]' class='rek select2 items form-control' required data-placeholder='Pilih Rekening'>";
        row += "        <option value=''></option>";
        row += "        {!! Akun::daftar_akun(FALSE, 'nonkas') !!}";
        row += "        </select>";
        row += '    </div>';
        row += '    <div class="col mx-1">';
        row += '        <input type="text" name="nominal[]" class="nominal form-control text-right" autocomplete="off" onkeyup="hitung(); return false;" value="0.00" data-politespace data-politespace-grouplength="3" data-politespace-delimiter="," data-politespace-decimal-mark="." step="0.01" data-politespace-reverse>';
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
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#btnSubmit').click(function(e){
        e.preventDefault();
        $(document).find("div.text-danger").remove();

        var rek         =   document.getElementsByClassName("rek");
        var rekening    =   [];
        for(var i = 0; i < rek.length; ++i) {
            rekening.push(rek[i].value);
        }

        var total   =   0;
        var nom     =   document.getElementsByClassName("nominal");
        var besar   =   [];
        for(var i = 0; i < nom.length; ++i) {
            var nominal =   nom[i].value;
            if (nominal === '') {
                var angka   =   0;
            } else {
                var angka   =   nominal.replace(/,/g, '');
            }
            besar.push(parseFloat(angka));
        }
        total   =   (Math.round(besar.reduce(function(previous, current, index, array){
                        return previous + current;
                    }) * 100) / 100).toFixed(2);

        if (total > 0) {
            var tanggal_transaksi   =   $("#tanggal_transaksi").val();
            var jenis_transaksi     =   $("input[name=jenis_transaksi]:checked").val();
            var rekening_kas        =   $("#rekening_kas").val();
            var uraian              =   $("#uraian").val();
            var arus_kas            =   $("#arus_kas").val();
            var riwayat_transaksi   =   $("#riwayat_transaksi").val();

            $.ajax({
                url: "{{ route('jurnalkeluar.store') }}",
                type:"POST",
                data:{
                    "_token": "{{ csrf_token() }}",
                    rekening_kas        : rekening_kas ,
                    rekening            : rekening ,
                    besar               : besar ,
                    total               : total ,
                    tanggal_transaksi   : tanggal_transaksi,
                    uraian              : uraian,
                    arus_kas            : arus_kas,
                    jenis_transaksi     : jenis_transaksi,
                    riwayat_transaksi   : riwayat_transaksi,
                },

                success:function(response){
                    $("#tanggal_transaksi").val("{{ date('Y-m-d') }}");
                    $("#uraian").val('');
                    $(".rek").select2().val(null).trigger("change");
                    $("#arus_kas").select2().val(null).trigger("change");
                    $("#riwayat_transaksi").select2().val(null).trigger("change");
                    $("#rekening_kas").select2().val(null).trigger("change");
                    document.getElementById('perubahan').style  = 'display:none';
                    $("input[name=jenis_transaksi][value='1']")[0].checked = true;
                    $('.politespace-proxy-val').html('0.00');
                    $('#total').html('0.00');
                    $('.nominal').val('0.00');
                    $('.add-column').remove();
                    $('#riwayat').load("{{ route('jurnalkeluar.riwayat') }}");
                    document.getElementById('notif-success').innerHTML  =   'Transaksi jurnal kas Keluar berhasil ditambahkan';
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
                        $(document).find('[name='+ field_name +']').after('<div class="text-danger">' + error + '</div>')
                    });
                }

            });
        } else {
            document.getElementById('notif-error').innerHTML  =   'Tidak ada transaksi';
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
    <div class="col-3 pr-1">
        <div class="form-group">
            Tanggal Transaksi
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

    <div class="col-9 pl-1">
        <div id="riwayat"></div>

        <div class="form-group">
            Uraian
            <input type="text" name="uraian" class="form-control" value="{{ old('uraian') }}" id="uraian" placeholder="Tuliskan Uraian" autocomplete="off">
        </div>

        <div class="form-group">
            Rekening Kas
            <select name="rekening_kas" id="rekening_kas" class="form-control select2" required data-width="100%" data-placeholder='Pilih Rekening Kas'>
                <option value=""></option>
                {!! Akun::daftar_akun(FALSE, 'kas') !!}
            </select>
        </div>
    </div>
</div>

<div class="border p-1 mb-3">
    <div class="row mb-1">
        <div class="text-center col-8 mr-1">
            Rekening
        </div>
        <div class="text-center col mx-1">
            Nominal
        </div>
        <div class="col-1"></div>
    </div>

    <div class="rek-loop">
        <div class="row mb-1">
            <div class="col-8 mr-1">
                <select name='rek[]' class='rek select2 items form-control' required data-placeholder='Pilih Rekening'>
                <option value=''></option>
                {!! Akun::daftar_akun(FALSE, 'nonkas') !!}
                </select>
            </div>
            <div class="col mx-1">
                <input type="text" name="nominal[]" class="nominal form-control text-right" autocomplete="off" onkeyup="hitung(); return false;" value="0.00" data-politespace data-politespace-grouplength="3" data-politespace-delimiter="," data-politespace-decimal-mark="." step="0.01" data-politespace-reverse>
            </div>
            <div class="col-1"></div>
        </div>
    </div>

    <div class="mb-4" id='info-alert'>
        <div class="row my-2">
            <div class="text-right text-bold pt-1 col-8 mr-2">TOTAL TRANSAKSI</div>
            <div class="text-right pt-1 col mx-2" id='total'>0.00</div>
            <div class="col-1 text-center"><button type="button" class="btn btn-success d-inline-block" onclick="addRow()">+</button></div>
        </div>
    </div>
</div>

<div class="border p-1 mb-4">
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

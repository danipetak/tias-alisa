@extends('layouts.main')

@section('title', 'Arus Kas')

@section('footer')
<script type="text/javascript">
$(document).ready(function() {
    $('#show_data').load("{{ route('rekening_aruskas.show') }}");

    $(document).on('click','.detail_data',function(){
        var row_id  =   $(this).data("id");

        $.ajax({
            url: "{{ route('rekening_aruskas.detail') }}",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                row_id:row_id
            },
            success:function(data){
                $("html, body").stop().animate({scrollTop:0}, 500, 'swing');

                $('#x_code').val(data.id);
                $('#nama_arus_kas').val(data.nama);
                $('input:radio[name=aliran][value=' + data.aliran + ']')[0].checked = true;
                $('input:radio[name=kategori][value=' + data.kategori + ']')[0].checked = true;
                document.getElementById('submit').innerHTML =   'Ubah' ;
                document.getElementById('clear').style      =   '' ;
            },

        });
    });

    $(document).on('click','.hapus_data',function(){
        var row_id  =   $(this).data("id");

        $.ajax({
            url: "{{ route('rekening_aruskas.destroy') }}",
            type:"DELETE",
            data:{
                "_token": "{{ csrf_token() }}",
                row_id:row_id
            },
            success:function(data){
                $('#x_code').val('');
                $('#nama_arus_kas').val('');
                $("[name=aliran]").prop('checked', false);
                $("[name=kategori]").prop('checked', false);
                $('#show_data').load("{{ route('rekening_aruskas.show') }}");

                document.getElementById('notif-success').innerHTML  =   'Hapus data arus kas berhasil';
                document.getElementById('notif-success').style      =   '';
                $('#topbar-notification').fadeIn();
                setTimeout(function() {
                    $('#topbar-notification').fadeOut();
                    document.getElementById('notif-error').style    =   'display: none';
                    document.getElementById('notif-success').style  =   'display: none';
                }, 2000)
            },

            error:function(response) {

                document.getElementById('notif-error').innerHTML  =   'Terjadi kesalahan dalam hapus data arus kas';
                document.getElementById('notif-error').style      =   '';
                $('#topbar-notification').fadeIn();
                setTimeout(function() {
                    $('#topbar-notification').fadeOut();
                    document.getElementById('notif-error').style    =   'display: none';
                    document.getElementById('notif-success').style  =   'display: none';
                }, 2000)
            }

        });
    });

    $('#clear').click(function(){
        document.getElementById('submit').innerHTML =   'Submit' ;
        document.getElementById('clear').style      =   'display: none' ;
        $('#x_code').val('');
        $('#nama_arus_kas').val('');
        $("[name=aliran]").prop('checked', false);
        $("[name=kategori]").prop('checked', false);
    });

    $('#submit').click(function(e){
        e.preventDefault();
        $(document).find("div.text-danger").remove();

        var x_code          =   $('#x_code').val();
        var nama_arus_kas   =   $('#nama_arus_kas').val();
        var aliran          =   $("[name=aliran]:checked").val();
        var kategori        =   $("[name=kategori]:checked").val();

        $.ajax({
            url: "{{ route('rekening_aruskas.store') }}",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                x_code: x_code,
                nama_arus_kas: nama_arus_kas,
                aliran: aliran,
                kategori: kategori,
            },

            success:function(response){
                $('#x_code').val('');
                $('#nama_arus_kas').val('');
                $("[name=aliran]").prop('checked', false);
                $("[name=kategori]").prop('checked', false);
                $('#show_data').load("{{ route('rekening_aruskas.show') }}");

                document.getElementById('notif-success').innerHTML  =   'Manipulasi data arus kas berhasil';
                document.getElementById('notif-success').style      =   '';
                $('#topbar-notification').fadeIn();
                setTimeout(function() {
                    $('#topbar-notification').fadeOut();
                    document.getElementById('notif-error').style    =   'display: none';
                    document.getElementById('notif-success').style  =   'display: none';
                }, 2000)
            },

            error: function(response) {
                $.each(response.responseJSON.errors,function(field_name,error){
                    if (field_name == 'nama_arus_kas') {
                        $(document).find('[name='+ field_name +']').after('<div class="text-danger">' + error + '</div>')
                    }
                    if (field_name == 'aliran') {
                        document.getElementById("aliranError").innerHTML    =   '<span class="text-danger">' + error + '</span>' ;
                    }
                    if (field_name == 'kategori') {
                        document.getElementById("kategoriError").innerHTML  =   '<span class="text-danger">' + error + '</span>' ;
                    }
                });
            }

        });
    });
});
</script>
@endsection

@section('content')
<div class="border p-2 mb-2">
    <input type="hidden" name="x_code" id="x_code">
    <div class="form-group">
        Nama Arus Kas
        <input type="text" name="nama_arus_kas" class="form-control" id="nama_arus_kas" placeholder="Tuliskan Nama Arus Kas" autocomplete="off">
    </div>

    <div class="row mb-2">
        <div class="col-5">
            Aliran
            <div class="form-group radio-toolbar">
                <input type="radio" value="penerimaan" name="aliran" id="pemasukan">
                <label for="pemasukan">Penerimaan</label>

                <input type="radio" class="ml-2" value="pengeluaran" name="aliran" id="pengeluaran">
                <label for="pengeluaran">Pengeluaran</label>
                <div id="aliranError"></div>
            </div>
        </div>

        <div class="col">
            Kategori
            <div class="form-group radio-toolbar">
                <input type="radio" value="operasional" name="kategori" id="operasional">
                <label for="operasional">Operasional</label>

                <input type="radio" class="ml-2" value="pendanaan" name="kategori" id="pendanaan">
                <label for="pendanaan">Pendanaan</label>

                <input type="radio" class="ml-2" value="investasi" name="kategori" id="investasi">
                <label for="investasi">Investasi</label>
                <div id="kategoriError"></div>
            </div>
        </div>
    </div>

    <div class="form-group text-right">
        <button type="submit" class="btn btn-secondary mr-1" id='clear' style="display: none">Clear</button>
        <button type="submit" class="btn btn-primary" id='submit'>Submit</button>
    </div>
</div>

<div id="show_data"></div>
@endsection

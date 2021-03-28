@extends('layouts.main')

@section('title', 'Rekening Akuntansi')

@section('footer')
<script type="text/javascript">
    $(document).ready(function() {
        $('#show_data').load("{{ route('rekening.show') }}");

        $(document).on('click','.up_view', function(){
            $("html, body").animate({ scrollTop: $("html, body").height()}, 500);
            document.getElementById('submit').style =   'border: 3px solid #333' ;
        });

        $(document).on('click','.hapus_akun', function(){
            var row_id      =   $(this).data('id') ;

            $.ajax({
                url: "{{ route('rekening.destroy') }}",
                type:"DELETE",
                data:{
                    "_token": "{{ csrf_token() }}",
                    row_id:row_id
                },
                success:function(data){
                    $("html, body").stop().animate({scrollTop:0}, 500, 'swing');

                    document.getElementById('notif-success').innerHTML  =   'Hapus data rekening akuntansi berhasil';
                    document.getElementById('notif-success').style      =   '';
                    $('#show_data').load("{{ route('rekening.show') }}");
                    $('#topbar-notification').fadeIn();
                    setTimeout(function() {
                        $('#topbar-notification').fadeOut();
                        document.getElementById('notif-error').style    =   'display: none';
                        document.getElementById('notif-success').style  =   'display: none';
                    }, 2000) ;
                },

                error:function(response) {
                    document.getElementById('notif-error').innerHTML  =   'Terjadi kesalahan saat hapus data rekening akuntansi';
                    document.getElementById('notif-error').style      =   '';
                    $('#topbar-notification').fadeIn();
                    setTimeout(function() {
                        $('#topbar-notification').fadeOut();
                        document.getElementById('notif-error').style    =   'display: none';
                        document.getElementById('notif-success').style  =   'display: none';
                    }, 2000) ;
                },

            });
        });

        $(document).on('click','.tambah_data', function(e){
            var row_id      =   $(this).data('id');
            var row_kode    =   $(this).data('kode');
            var row_level   =   $(this).data('level');
            var endpoin     =   $(this).data('endpoin');
            var sn          =   $(this).data('sn');
            row =   '';
            row +=  "<tr class='bg-active'>";
            row +=  "<td>";
            row +=  "<input type='hidden' name='x_code[]' value='" + row_id + "'>";
            row +=  "<small>Tambah Rekening " + ((row_level == '3') || (endpoin == '1') ? 'Transaksi' : 'Header') + "</small>";
            row +=  "<div class='row'><div class='col-auto'>" + row_kode + "</div><div class='col'><input type='text' name='kode[]' class='form-text bg-active w-100' autocomplete='off' placeholder='Tuliskan Kode'></div></div></td>";
            row +=  "<td>";
            row +=  "<input type='text' name='nama[]' class='form-text bg-active form-control border-bottom' autocomplete='off' placeholder='Tuliskan Nama Rekening'>";
            if ((row_level == '3') || (endpoin == '1')) {
            row +=  "<select class='pointer form-text bg-active w-100' name='link[]'>";
            row +=  "<option value=''>Tanpa Penghubung Rekening</option>";
            row +=  "{!! $keylink !!}";
            row +=  "</select>";
            }
            row +=  "</td>";
            row +=  "<td>";
            row +=  "<select class='pointer form-text bg-active w-100' name='sn[]'>";
            row +=  "<option value='db' " + ((sn == 'db') ? 'selected' : '') + ">Debit</option>";
            row +=  "<option value='cr' " + ((sn == 'cr') ? 'selected' : '') + ">Kredit</option>";
            row +=  "</select>";
            if (row_level == '1') {
            row +=  "<div><input id='stop" + row_id + "' type='checkbox' value='1' name='stop[]'><label for='stop" + row_id + "'>Akhir Header</div>";
            } else {
            row +=  "<input type='hidden' value='' name='stop[]'>";
            }
            row +=  "</td>";
            row +=  "<td colspan='2'>";
            row +=  "<button type='button' class='up_view btn btn-block btn-link'>Selesaikan</button>";
            row +=  "</td>";
            row +=  "</tr>";

            $(this).closest('tr').after(row);
        });
    });
</script>
@endsection

@section('content')
<form action="{{ route('rekening.store') }}" method="POST">
    @csrf
    <div id="show_data"></div>

    <div class="form-group text-right mt-3">
        Klik Submit untuk menyelesaikan
        <button type="submit" class="btn btn-primary" id='submit'>Submit</button>
    </div>
</form>
@endsection

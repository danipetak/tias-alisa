@extends('layouts.main')

@section('title', 'Penghubung Rekening')

@section('footer')
<script type="text/javascript">
$(document).ready(function() {
    $('#show_data').load("{{ route('penghubung_rekening.show') }}");

    $(document).on('click','.hapus_data',function(){
        var row_id  =   $(this).data("id");

        $.ajax({
            url: "{{ route('penghubung_rekening.destroy') }}",
            type:"DELETE",
            data:{
                "_token": "{{ csrf_token() }}",
                row_id:row_id
            },
            success:function(data){
                $('#x_code').val('');
                $('#nama_penghubung').val('');
                $('#show_data').load("{{ route('penghubung_rekening.show') }}");

                document.getElementById('notif-success').innerHTML  =   'Hapus data penghubung rekening berhasil';
                document.getElementById('notif-success').style      =   '';
                $('#topbar-notification').fadeIn();
                setTimeout(function() {
                    $('#topbar-notification').fadeOut();
                    document.getElementById('notif-error').style    =   'display: none';
                    document.getElementById('notif-success').style  =   'display: none';
                }, 2000)
            },

            error:function(response) {

                document.getElementById('notif-error').innerHTML  =   'Terjadi kesalahan dalam hapus data penghubung rekening';
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

    $(document).on('click','.detail_data',function(){
        var row_id  =   $(this).data("id");

        $.ajax({
            url: "{{ route('penghubung_rekening.detail') }}",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                row_id:row_id
            },
            success:function(data){
                $("html, body").stop().animate({scrollTop:0}, 500, 'swing');

                $('#x_code').val(data.id);
                $('#nama_penghubung').val(data.values);
                document.getElementById('submit').innerHTML =   'Ubah' ;
                document.getElementById('clear').style      =   '' ;
            },

        });
    });

    $('#clear').click(function(){
        document.getElementById('submit').innerHTML =   'Submit' ;
        document.getElementById('clear').style      =   'display: none' ;
        $('#x_code').val('');
        $('#nama_penghubung').val('');
    });

    $('#submit').click(function(e){
        e.preventDefault();
        $(document).find("div.text-danger").remove();

        var x_code          =   $('#x_code').val();
        var nama_penghubung =   $('#nama_penghubung').val();

        $.ajax({
            url: "{{ route('penghubung_rekening.store') }}",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                x_code: x_code,
                nama_penghubung: nama_penghubung
            },

            success:function(response){
                $('#x_code').val('');
                $('#nama_penghubung').val('');
                $('#show_data').load("{{ route('penghubung_rekening.show') }}");

                document.getElementById('notif-success').innerHTML  =   'Manipulasi data penghubung rekening berhasil';
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
                    $(document).find('[name='+ field_name +']').after('<div class="text-danger">' + error + '</div>')
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
        Nama Penghubung
        <input type="text" name="nama_penghubung" class="form-control" id="nama_penghubung" placeholder="Tuliskan Nama Penghubung" autocomplete="off">
    </div>

    <div class="form-group text-right">
        <button type="submit" class="btn btn-secondary mr-1" id='clear' style="display: none">Clear</button>
        <button type="submit" class="btn btn-primary" id='submit'>Submit</button>
    </div>
</div>

<div id="show_data"></div>
@endsection

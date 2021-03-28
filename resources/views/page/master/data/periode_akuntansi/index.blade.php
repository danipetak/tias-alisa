@extends('layouts.main')

@section('title', 'Periode Akuntansi')

@section('footer')
<script type="text/javascript">
$(document).ready(function() {
    $('#show_data').load("{{ route('periode.show') }}");

    $(document).on('click','.hapus_data',function(){
        var row_id  =   $(this).data("id");
        console.log(row_id);
        $.ajax({
            url: "{{ route('periode.destroy') }}",
            type:"DELETE",
            data:{
                "_token": "{{ csrf_token() }}",
                row_id:row_id
            },
            success:function(data){
                $('#show_data').load("{{ route('periode.show') }}");
                $('#show_periode').load("{{ route('periode.info') }}");

                document.getElementById('notif-success').innerHTML  =   'Periode akuntansi berhasil dihapus';
                document.getElementById('notif-success').style      =   '';
                $('#topbar-notification').fadeIn();
                setTimeout(function() {
                    $('#topbar-notification').fadeOut();
                    document.getElementById('notif-error').style    =   'display: none';
                    document.getElementById('notif-success').style  =   'display: none';
                }, 2000)
            },

            error:function(){
                document.getElementById('notif-error').innerHTML  =   'Terdapat kesalahan saat menghapus periode akuntansi';
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

    $(document).on('click','.next_data',function(){
        var row_id  =   $(this).data("id");
        console.log(row_id);
        $.ajax({
            url: "{{ route('periode.update') }}",
            type:"PATCH",
            data:{
                "_token": "{{ csrf_token() }}",
                row_id:row_id
            },
            success:function(data){
                $('#show_data').load("{{ route('periode.show') }}");
                $('#show_periode').load("{{ route('periode.info') }}");

                document.getElementById('notif-success').innerHTML  =   'Status periode akuntansi berhasil diperbaharui';
                document.getElementById('notif-success').style      =   '';
                $('#topbar-notification').fadeIn();
                setTimeout(function() {
                    $('#topbar-notification').fadeOut();
                    document.getElementById('notif-error').style    =   'display: none';
                    document.getElementById('notif-success').style  =   'display: none';
                }, 2000)
            },

            error:function(){
                document.getElementById('notif-error').innerHTML  =   'Terdapat kesalahan saat memperbaharui status periode akuntansi';
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

    $('#submit').click(function(e){
        e.preventDefault();
        $(document).find("div.text-danger").remove();

        var x_code              =   $('#x_code').val();
        var tanggal_mulai       =   $('#tanggal_mulai').val();
        var tanggal_berakhir    =   $('#tanggal_berakhir').val();

        $.ajax({
            url: "{{ route('periode.store') }}",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                x_code: x_code,
                tanggal_mulai: tanggal_mulai,
                tanggal_berakhir: tanggal_berakhir
            },

            success:function(response){
                $('#x_code').val('');
                $('#tanggal_mulai').val('');
                $('#tanggal_berakhir').val('');
                $('#show_data').load("{{ route('periode.show') }}");
                $('#show_periode').load("{{ route('periode.info') }}");

                document.getElementById('notif-success').innerHTML  =   'Manipulasi periode akuntansi berhasil';
                document.getElementById('notif-success').style      =   '';
                $('#topbar-notification').fadeIn();
                setTimeout(function() {
                    $('#topbar-notification').fadeOut();
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
    <div class="row mb-2">
        <div class="col mr-1">
            <div class="form-group">
                Tanggal Mulai
                <input type="date" name="tanggal_mulai" class="form-control" id="tanggal_mulai" autocomplete="off">
            </div>
        </div>

        <div class="col mx-1">
            <div class="form-group">
                Tanggal Berakhir
                <input type="date" name="tanggal_berakhir" class="form-control" id="tanggal_berakhir" autocomplete="off">
            </div>
        </div>

        <div class="col-2 ml-1">
            &nbsp;
            <button type="submit" class="btn btn-block btn-primary" id='submit'>Submit</button>
        </div>
    </div>
</div>

<div id="show_data"></div>
@endsection

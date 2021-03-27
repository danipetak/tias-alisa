@extends('layouts.main')

@section('title', 'Daftar Pengguna')

@section('footer')
<script type="text/javascript">
$(document).ready(function() {
    $('#show_data').load("{{ route('pengguna.show') }}");

    $(document).on('click','.hapus_data',function(){
        var row_id  =   $(this).data("id");

        $.ajax({
            url: "{{ route('pengguna.destroy') }}",
            type:"DELETE",
            data:{
                "_token": "{{ csrf_token() }}",
                row_id:row_id
            },
            success:function(data){
                $('#x_code').val('');
                $('#nama_lengkap').val('');
                $('#email').val('');
                $('#password').val('');
                $('#password_confirmation').val('');
                $('#show_data').load("{{ route('pengguna.show') }}");

                document.getElementById('notif-success').innerHTML  =   'Hapus pengguna berhasil';
                document.getElementById('notif-success').style      =   '';
                $('#topbar-notification').fadeIn();
                setTimeout(function() {
                    $('#topbar-notification').fadeOut();
                    document.getElementById('notif-error').style    =   'display: none';
                    document.getElementById('notif-success').style  =   'display: none';
                }, 2000)
            },

        });
    });

    $(document).on('click','.detail_data',function(){
        var row_id  =   $(this).data("id");

        $.ajax({
            url: "{{ route('pengguna.detail') }}",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                row_id:row_id
            },
            success:function(data){
                $("html, body").stop().animate({scrollTop:0}, 500, 'swing');

                $('#x_code').val(data.id);
                $('#nama_lengkap').val(data.name);
                $('#email').val(data.email);
                $('#password').val('');
                $('#password_confirmation').val('');
                document.getElementById('submit').innerHTML =   'Ubah' ;
                document.getElementById('clear').style      =   '' ;
            },

        });
    });

    $('#clear').click(function(){
        document.getElementById('submit').innerHTML =   'Submit' ;
        document.getElementById('clear').style      =   'display: none' ;
        $('#x_code').val('');
        $('#nama_lengkap').val('');
        $('#email').val('');
        $('#password').val('');
        $('#password_confirmation').val('');
    });

    $('#submit').click(function(e){
        e.preventDefault();
        $(document).find("div.text-danger").remove();

        var x_code                  =   $('#x_code').val();
        var nama_lengkap            =   $('#nama_lengkap').val();
        var email                   =   $('#email').val();
        var password                =   $('#password').val();
        var password_confirmation   =   $('#password_confirmation').val();

        $.ajax({
            url: "{{ route('pengguna.store') }}",
            type:"POST",
            data:{
                "_token": "{{ csrf_token() }}",
                x_code: x_code,
                nama_lengkap: nama_lengkap,
                email: email,
                password: password,
                password_confirmation: password_confirmation
            },

            success:function(response){
                $('#x_code').val('');
                $('#nama_lengkap').val('');
                $('#email').val('');
                $('#password').val('');
                $('#password_confirmation').val('');
                $('#show_data').load("{{ route('pengguna.show') }}");

                document.getElementById('notif-success').innerHTML  =   'Manipulasi daftar pengguna berhasil';
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
<div class="border p-2">
    <div class="text-bold mb-2" id='title'>Tambah Pengguna</div>

    <input type="hidden" name="x_code" id="x_code">
    <div class="row mb-2">
        <div class="col pr-1">
            <div class="form-group">
                Nama Lengkap
                <input type="text" name="nama_lengkap" class="form-control" id="nama_lengkap" placeholder="Tuliskan Nama Lengkap" autocomplete="off">
            </div>

            <div class="form-group">
                E-Mail
                <input type="email" name="email" class="form-control" id="email" placeholder="Tuliskan E-Mail" autocomplete="off">
            </div>
        </div>

        <div class="col pl-1">
            <div class="form-group">
                Password
                <input type="password" name="password" class="form-control" id="password" placeholder="Tuliskan Password" autocomplete="off">
            </div>

            <div class="form-group">
                Konfirmasi Password
                <input id="password_confirmation" type="password" class="form-control" placeholder="Tuliskan Konfirmasi Password" name="password_confirmation">
            </div>
        </div>
    </div>

    <div class="form-group text-right">
        <button type="submit" class="btn btn-secondary mr-1" id='clear' style="display: none">Clear</button>
        <button type="submit" id='submit' class="btn btn-primary">Submit</button>
    </div>

</div>

<div class="my-3" id='show_data'></div>
@endsection

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

        $(document).on('click','.tambah_data', function(e){
            var row_id      =   $(this).data('id');
            var row_kode    =   $(this).data('kode');
            var row_level   =   $(this).data('level');
            var endpoin     =   $(this).data('endpoin');
            row =   '';
            row +=  "<tr class='bg-active'>";
            row +=  "<td>";
            row +=  "<input type='hidden' name='x_code[]' value='" + row_id + "'>";
            row +=  "<small>Tambah Rekening " + ((row_level == '3') || (endpoin == '1') ? 'Transaksi' : 'Header') + "</small>";
            row +=  "<div class='row'><div class='col-auto'>" + row_kode + "</div><div class='col'><input type='text' name='kode[]' class='form-text w-100' autocomplete='off' placeholder='Tuliskan Kode'></div></div></td>";
            row +=  "<td>";
            row +=  "<input type='text' name='nama[]' class='form-text form-control border-bottom' autocomplete='off' placeholder='Tuliskan Nama Rekening'>";
            if ((row_level == '3') || (endpoin == '1')) {
            row +=  "<select class='pointer form-text w-100' name='link[]'>";
            row +=  "<option value=''>Tanpa Penghubung Rekening</option>";
            row +=  "{!! $keylink !!}";
            row +=  "</select>";
            }
            row +=  "</td>";
            row +=  "<td>";
            row +=  "<select class='pointer form-text w-100' name='sn[]'>";
            row +=  "<option value='db'>Debit</option>";
            row +=  "<option value='cr'>Kredit</option>";
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

<div class="form-group" id='perubahan' style="display: none">
    Pilih Transaksi
    <select class="form-control select2" name="riwayat_transaksi" id='riwayat_transaksi' data-width="100%" data-placeholder='Pilih Transaksi'>
        <option value=""></option>
        {!! $riwayat !!}
    </select>
</div>

<script>
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>

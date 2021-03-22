<div class="my-1 pb-1 mb-2 border-bottom">
    <small>Periode Akuntansi Aktif :</small>
    <div class="text-bold">
    @if (Periode::periode_aktif())
        {{ Periode::periode_aktif('tanggal') }}
    @else
        <span class="text-danger">Tidak Ditemukan.</span> <a href="{{ route('periode.index') }}">Klik Disini</a>
    @endif
    </div>
</div>

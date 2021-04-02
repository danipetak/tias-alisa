<div class="sidebar">
    <ul class="mb-2">
        <a href="{{ route('profil_perusahaan.index') }}">
            <li class="{{ request()->routeIs('profil_perusahaan.index') ? 'bg-active' : '' }}">
                Profil Perusahaan
            </li>
        </a>
        <a href="{{ route('pengguna.index') }}">
            <li class="{{ request()->routeIs('pengguna.index') ? 'bg-active' : '' }}">
                Daftar Pengguna
            </li>
        </a>
    </ul>

    <ul class="mb-2">
        <a href="{{ route('penghubung_rekening.index') }}">
            <li class="{{ request()->routeIs('penghubung_rekening.index') ? 'bg-active' : '' }}">
                Penghubung Rekening
            </li>
        </a>
        <a href="{{ route('periode.index') }}">
            <li class="{{ request()->routeIs('periode.index') ? 'bg-active' : '' }}">
                Periode Akuntansi
            </li>
        </a>
        <a href="{{ route('rekening_aruskas.index') }}">
            <li class="{{ request()->routeIs('rekening_aruskas.index') ? 'bg-active' : '' }}">
                Rekening Arus Kas
            </li>
        </a>
        <a href="{{ route('rekening.index') }}">
            <li class="{{ request()->routeIs('rekening.index') ? 'bg-active' : '' }}">
                Rekening Akuntansi
            </li>
        </a>
    </ul>

    <ul class="mb-2">
        <a href="{{ route('saldoawal.index') }}">
            <li class="{{ request()->routeIs('saldoawal.index') ? 'bg-active' : '' }}">
                Saldo Awal
            </li>
        </a>
        <a href="{{ route('jurnalumum.index') }}">
            <li class="{{ request()->routeIs('jurnalumum.index') ? 'bg-active' : '' }}">
                Jurnal Umum
            </li>
        </a>
        <a href="{{ route('jurnalmasuk.index') }}">
            <li class="{{ request()->routeIs('jurnalmasuk.index') ? 'bg-active' : '' }}">
                Jurnal Kas Masuk
            </li>
        </a>
        <a href="{{ route('jurnalkeluar.index') }}">
            <li class="{{ request()->routeIs('jurnalkeluar.index') ? 'bg-active' : '' }}">
                Jurnal Kas Keluar
            </li>
        </a>
        <a href="{{ route('jurnaltransfer.index') }}">
            <li class="{{ request()->routeIs('jurnaltransfer.index') ? 'bg-active' : '' }}">
                Jurnal Transfer Kas
            </li>
        </a>
        <a href="{{ route('adj_berjalan.index') }}">
            <li class="{{ request()->routeIs('adj_berjalan.index') ? 'bg-active' : '' }}">
                Jurnal Penyesuaian Berjalan
            </li>
        </a>
        <a href="{{ route('adj_mandiri.index') }}">
            <li class="{{ request()->routeIs('adj_mandiri.index') ? 'bg-active' : '' }}">
                Jurnal Penyesuaian Mandiri
            </li>
        </a>
        <a href="{{ route('adj_tercatat.index') }}">
            <li class="{{ request()->routeIs('adj_tercatat.index') ? 'bg-active' : '' }}">
                Jurnal Penyesuaian Tercatat
            </li>
        </a>
    </ul>

    <ul class="mb-2">
        <a href="{{ route('datatransaksi.index') }}">
            <li class="{{ request()->routeIs('datatransaksi.index') ? 'bg-active' : '' }}">
                Laporan Data Transaksi
            </li>
        </a>
        <a href="{{ route('periodejurnal.index') }}">
            <li class="{{ request()->routeIs('periodejurnal.index') ? 'bg-active' : '' }}">
                Laporan Periode Jurnal
            </li>
        </a>
        <a href="{{ route('bukubesar.index') }}">
            <li class="{{ request()->routeIs('bukubesar.index') ? 'bg-active' : '' }}">
                Laporan Buku Besar
            </li>
        </a>
    </ul>
</div>

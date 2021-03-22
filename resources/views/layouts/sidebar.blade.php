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
        <a href="{{ route('jurmalumum.index') }}">
            <li class="{{ request()->routeIs('jurmalumum.index') ? 'bg-active' : '' }}">
                Transaksi Jurmal Umum
            </li>
        </a>
    </ul>
</div>

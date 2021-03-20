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
        <a href="{{ route('arus_kas.index') }}">
            <li class="{{ request()->routeIs('arus_kas.index') ? 'bg-active' : '' }}">
                Arus Kas
            </li>
        </a>
    </ul>
</div>

<table id='tableAccount' class="table">
    <thead>
        <tr>
            <th style="width: 135px">Kode</th>
            <th>Nama Rekening</th>
            <th>S.N.</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $i => $row)
        <tr>
            <td>{{ $row->kode_akun }}</td>
            <td>
                {{ $row->nama_akun }}
                <div>
                    <small>{{ $row->link_akun }}</small>
                </div>
            </td>
            <td>{{ $row->saldo_normal }}</td>
            <td @if (($row->status == 1) AND (Akun::turunan_akun($row->id))) class="text-center" @endif>
                @if (($row->status == 1) AND (Akun::turunan_akun($row->id))) Ubah @endif
            </td>
            <td @if (($row->status == 1) AND (Akun::turunan_akun($row->id))) class="text-center" @endif>
                @if (($row->status == 1) AND (Akun::turunan_akun($row->id))) Hapus @endif
            </td>
        </tr>
        @if ($row->level != 4)
        <tr>
            <td style="padding:0;padding-top:2px;font-size:8px" data-endpoin="{{ $row->endpoin ?? 0 }}" data-level="{{ $row->level }}" data-kode="{{ $row->kode_akun }}" data-id="{{ $row->id }}" class="tambah_data pointer text-center text-bold" colspan="6">
                ---------------------------------------- Tambah Rekening Turunan {{ $row->nama_akun }} ----------------------------------------
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>

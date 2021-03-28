<table id='tableAccount' class="table table-list">
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
            <td @if (($row->status == 1) AND (Akun::turunan_akun($row->id))) data-id="{{ $row->id }}" class="hapus_akun pointer text-center" @endif>
                @if (($row->status == 1) AND (Akun::turunan_akun($row->id))) Hapus @endif
            </td>
             @if ($row->level != 4)
             <td data-endpoin="{{ $row->endpoin ?? 0 }}" data-sn="{{ $row->sn }}" data-level="{{ $row->level }}" data-kode="{{ $row->kode_akun }}" data-id="{{ $row->id }}" class="tambah_data pointer text-center" colspan="6">Tambah</td>
            @else
            <td></td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>

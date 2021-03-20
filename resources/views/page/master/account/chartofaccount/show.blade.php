<table class="table">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama Rekening</th>
            <th>S.N.</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
        <tr>
            <td>{{ $row->kode_akun }}</td>
            <td>
                {{ $row->nama_akun }}
                <div>
                    <small>{{ $row->link_akun }}</small>
                </div>
            </td>
            <td>{{ $row->saldo_normal }}</td>
            <td>
                Tambah
            </td>
            <td>
                @if ($row->status == 1) Ubah @endif
            </td>
            <td>
                @if ($row->status == 1) Hapus @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<table id='tableAccount' class="table">
    <thead>
        <tr>
            <th style="width: 135px">Kode</th>
            <th>Nama Rekening</th>
            <th>Debit</th>
            <th>Kredit</th>
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
            <td style="width: 120px; {{ ($row->level != 4) ? 'background-color: #ccc' : ($row->sn == 'cr' ? 'background-color: #ccc' : '' ) }}">
                @if ($row->sn == 'db' AND $row->level == 4) <input type="number" class="text-right form-text w-100" name="db[]" value="{{ $row->begining_balance ?? 0 }}"> @endif
            </td>
            <td style="width: 120px; {{ ($row->level != 4) ? 'background-color: #ccc' : ($row->sn == 'db' ? 'background-color: #ccc' : '' ) }}">
                @if ($row->sn == 'cr' AND $row->level == 4) <input type="number" class="text-right form-text w-100" name="cr[]" value="{{ $row->begining_balance ?? 0 }}"> @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

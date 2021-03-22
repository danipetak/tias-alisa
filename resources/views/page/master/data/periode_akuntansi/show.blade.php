@if (COUNT($data) > 0)
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Berakhir</th>
            <th>Status</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $i => $row)
        @php
            $step   =   FALSE ;
            if ($row->status != 4) {
                if (Periode::periode_aktif()) {
                    $step   =   ($row->status != 1) ? TRUE : FALSE ;
                } else {
                    $step   =   TRUE ;
                }
            }
        @endphp
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $row->mulai }}</td>
            <td>{{ $row->selesai }}</td>
            <td>{{ $row->status_periode }}</td>
            <td @if ($step) class="pointer text-center next_data" data-id="{{ $row->id }}" @endif>
                @if ($step) Lanjut @endif
            </td>
            <td @if ($row->status == 1) class="pointer text-center hapus_data" data-id="{{ $row->id }}" @endif >
                {{ $row->status == 1 ? 'Hapus' : '' }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

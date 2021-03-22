@if (COUNT($data) > 0)
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Penghubung</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $i => $row)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $row->values }}</td>
            <td @if ($row->status == 1) class="pointer text-center detail_data" data-id="{{ $row->id }}" @endif>
                @if ($row->status == 1) Ubah @endif
            </td>
            <td @if ($row->status == 1) class="pointer text-center hapus_data" data-id="{{ $row->id }}" @endif>
                @if ($row->status == 1) Hapus @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

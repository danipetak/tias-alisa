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
            <td class="pointer text-center detail_data" data-id="{{ $row->id }}">
                Ubah
            </td>
            <td class="pointer text-center hapus_data" data-id="{{ $row->id }}">
                Hapus
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

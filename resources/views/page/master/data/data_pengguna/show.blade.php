<table class="table">
    <thead>
        <tr>
            <th>Nama Lengkap</th>
            <th>E-Mail</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $row)
        <tr>
            <td>{{ $row->name }}</td>
            <td>{{ $row->email }}</td>
            <td class="pointer text-center detail_data" data-id="{{ $row->id }}">
                Lihat
            </td>
            <td class="pointer text-center hapus_data" data-id="{{ $row->id }}">
                Hapus
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

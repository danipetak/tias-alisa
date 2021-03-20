@if (COUNT($data) > 0)
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Arus Kas</th>
            <th>Aliran</th>
            <th>Kategori</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $i => $row)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $row->nama }}</td>
            <td class="text-capitalize">{{ $row->aliran }}</td>
            <td class="text-capitalize">{{ $row->kategori }}</td>
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

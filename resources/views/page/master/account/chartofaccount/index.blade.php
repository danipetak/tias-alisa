@extends('layouts.main')

@section('title', 'Rekening Akuntansi')

@section('footer')
<script type="text/javascript">
    $(document).ready(function() {
        $('#show_data').load("{{ route('rekening.show') }}");
    });
</script>
@endsection

@section('content')
<div id="show_data"></div>
@endsection

@extends('layouts.main')

@section('title', 'Saldo Awal')

@section('footer')
<script type="text/javascript">
    $(document).ready(function() {
        $('#show_data').load("{{ route('saldoawal.show') }}");
    });
</script>
@endsection

@section('content')
<div id="show_data"></div>

<div class="form-group my-3 text-right">
    <button class="btn btn-primary" id="submit">Submit</button>
</div>
@endsection

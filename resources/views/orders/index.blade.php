@extends('ui.layout')

@section('content')
<h3>Daftar Order</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Total Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $o)
        <tr>
            <td>{{ $o->id }}</td>
            <td>{{ $o->total_price }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

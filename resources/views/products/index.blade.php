@extends('ui.layout')

@section('content')
<h3>Daftar Produk</h3>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $p)
        <tr>
            <td>{{ $p->name }}</td>
            <td>{{ $p->price }}</td>
            <td>{{ $p->stock }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@extends('ui.layout')

@section('content')
<h3>Daftar Produk</h3>

<a href="/products-ui/create" class="btn btn-primary mb-3">
    + Tambah Produk
</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Foto</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $p)
        <tr>
            <td>
                @if($p->image)
                    <img src="{{ asset('storage/'.$p->image) }}" width="80">
                @else
                    -
                @endif
            </td>
            <td>{{ $p->name }}</td>
            <td>{{ $p->price }}</td>
            <td>{{ $p->stock }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

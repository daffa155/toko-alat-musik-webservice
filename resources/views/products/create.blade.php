@extends('ui.layout')

@section('content')
<h3>Tambah Produk</h3>

<form method="POST" action="/products-ui" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label>Nama Produk</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Harga</label>
        <input type="number" name="price" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stock" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Kategori</label>
        <select name="category_id" class="form-control" required>
            @foreach($categories as $c)
                <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Foto Produk</label>
        <input type="file" name="image" class="form-control">
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>
@endsection

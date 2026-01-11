<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Toko Alat Musik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

{{-- NAVBAR HANYA MUNCUL JIKA SUDAH LOGIN --}}
@auth
<nav class="navbar navbar-dark bg-dark px-3">
    <span class="navbar-brand">Toko Alat Musik</span>
    <div class="d-flex gap-2">
        <a href="/products-ui" class="btn btn-sm btn-light">Products</a>
        <a href="/orders-ui" class="btn btn-sm btn-light">Orders</a>

        <form method="POST" action="/logout-ui" class="d-inline">
            @csrf
            <button class="btn btn-sm btn-danger">Logout</button>
        </form>
    </div>
</nav>
@endauth

<div class="container mt-5">
    @yield('content')
</div>

</body>
</html>

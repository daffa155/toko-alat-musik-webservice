<!DOCTYPE html>
<html>
<head>
    <title>Toko Alat Musik</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<h2>Toko Alat Musik</h2>

<nav>
    <a href="/products-ui">Products</a> |
    <a href="/orders-ui">Orders</a> |
    <a href="/login-ui">Logout</a>
</nav>

<hr>

@yield('content')

</body>
</html>
 
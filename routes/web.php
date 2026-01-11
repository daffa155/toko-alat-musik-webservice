<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Ui\ProductUiController;
use App\Models\Order;

/*
|--------------------------------------------------------------------------
| LOGIN UI
|--------------------------------------------------------------------------
*/
Route::get('/login-ui', function () {
    return view('auth.login');
})->name('login.ui');

Route::post('/login-ui', function (Request $request) {

    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/products-ui');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah'
    ]);
});

/*
|--------------------------------------------------------------------------
| PROTECTED UI (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // PRODUCT
    Route::get('/products-ui', [ProductUiController::class, 'index']);
    Route::get('/products-ui/create', [ProductUiController::class, 'create']);
    Route::post('/products-ui', [ProductUiController::class, 'store']);

    // ORDER
    Route::get('/orders-ui', function () {
        return view('orders.index', [
            'orders' => Order::all()
        ]);
    });

    // LOGOUT
    Route::post('/logout-ui', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login-ui');
    });
});

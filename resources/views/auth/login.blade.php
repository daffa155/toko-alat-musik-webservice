@extends('ui.layout')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">

        <h3 class="text-center mb-4">Login</h3>

        <form method="POST" action="/login-ui">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <button class="btn btn-primary w-100">Login</button>
        </form>

    </div>
</div>
@endsection

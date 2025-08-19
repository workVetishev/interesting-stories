@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Вход</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label>Пароль</label>
            <input type="password" name="password" class="form-control" required>
            @error('password') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="remember" id="remember" class="form-check-input">
            <label for="remember" class="form-check-label">Запомнить меня</label>
        </div>

        <button type="submit" class="btn btn-primary">Войти</button>
    </form>

    <p class="mt-3">Нет аккаунта? <a href="{{ route('register.form') }}">Зарегистрироваться</a></p>
</div>
@endsection
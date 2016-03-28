@extends('templates.app')
@section('content')

    <form method="POST" action="/auth/login">
        {!! csrf_field() !!}

        @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div>
            Email
            <input type="email" name="email" value="{{ old('email') }}">
        </div>

        <div>
            Password
            <input type="password" name="password" id="password">
        </div>

        <div>
            <input type="checkbox" name="remember"> Remember Me
        </div>
        <div>
            <a href="{{ url('password/email') }}">Забыли пароль?</a>
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
@endsection
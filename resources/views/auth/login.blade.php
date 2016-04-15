@extends('templates.app')
@section('content')
    <style>
        .b-login_form div {
            margin-bottom: 10px;
        }
    </style>
    <form method="POST" action="/auth/login" class="b-login_form col-md-3">
        {!! csrf_field() !!}

        <div>
            Email
            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
        </div>

        <div>
            Password
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <div style="display: inline-block; margin-right: 30px;">
            <input type="checkbox" name="remember"> Remember Me
        </div>
        
        <div style="display: inline-block;">
            <a href="{{ url('password/email') }}">Забыли пароль?</a>
        </div>

        <div>
            <button type="submit" class="btn btn-success">Login</button>
        </div>
    </form>
@endsection
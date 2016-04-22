@extends('templates.app')
@section('content')
    <style>
        .b-register_form div {
            margin-bottom: 10px;
        }
    </style>
    <form method="POST" action="/auth/register" class="b-register_form col-md-3">
        {!! csrf_field() !!}

        <div>
            Name
            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
        </div>

        <div>
            Email
            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
        </div>

        <div>
            Password
            <input type="password" name="password" class="form-control">
        </div>

        <div>
            Confirm Password
            <input type="password" name="password_confirmation" class="form-control">
        </div>

        <div>
            <button type="submit" class="btn btn-success">Register</button>
        </div>
    </form>
    @include('auth.partials._social_auth_icons')
@endsection
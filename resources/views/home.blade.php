@extends('templates.app')
@section('metatitle')
    page1
@endsection
@section('content')

    @if(Auth::check())
        <a href="{{ route('works.create') }}" class="btn btn-success">Добавить работу</a>
    @else
    <h4>Для того чтобы добавить работу необходимо <a href="{{ url('auth/login') }}">авторизоваться</a></h4>
    @endif
@endsection
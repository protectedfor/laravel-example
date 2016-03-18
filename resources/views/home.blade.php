@extends('templates.app')
@section('metatitle')
    page1
@endsection
@section('content')
    @if(session('success'))
        <div class="alert alert-success" role="alert">
            <p>Сообщение добавлено!</p>
        </div>
    @endif
    @if(count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('messages.store') }}" method="POST">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="">Имя</label>
            <input name="name" value="{{ old('name') }}" type="text" class="form-control" id="" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Сообщение</label>
            <textarea class="form-control" name="message" id="" cols="30" rows="10">{{ old('message') }}</textarea>
        </div>
        <button type="submit" class="btn btn-default">Отправить</button>
    </form>
    <div style="margin-top: 30px;"></div>
    <div class="panel panel-default">
        <div class="panel-heading">Panel heading without title</div>
        <div class="panel-body">
            Basic panel example
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Panel heading without title</div>
        <div class="panel-body">
            Basic panel example
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Panel heading without title</div>
        <div class="panel-body">
            Basic panel example
        </div>
    </div>
@endsection
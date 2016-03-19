@extends('templates.app')
@section('metatitle')
    books
    @endsection
@section('content')
@if(session('success'))
    <div class="alert alert-success" role="alert">
        <p>Книга добавлена!</p>
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
<form action="{{ route('books.store') }}" method="POST">
    {!! csrf_field() !!}
    <div class="form-group">
        <label for="">Название</label>
        <input name="name" value="{{ old('name') }}" type="text" class="form-control" id="" placeholder="">
    </div>
    <div class="form-group">
        <label for="">Автор</label>
        <input name="author" value="{{ old('author') }}" type="text" class="form-control" id="" placeholder="">
    </div>
    <div class="form-group">
        <label for="">Год издания</label>
        <input name="publishing" value="{{ old('publishing') }}" type="text" class="form-control" id="" placeholder="">
    </div>
    <div class="form-group">
        <label for="">Описание</label>
        <textarea class="form-control" name="message" id="" cols="30" rows="10">{{ old('message') }}</textarea>
    </div>
    <button type="submit" class="btn btn-default">Отправить</button>
</form>
<div style="margin-top: 30px;"></div>
    @foreach( $books as $book)
    <div class="panel panel-default">
        <div class="panel-heading">{{ $book->name }}</div>
        <div class="panel-body">
            {{ $book->author }}
        </div>
        <hr>
        <div class="panel-body">
            {{ $book->publishing }}
        </div>
        <hr>
        <div class="panel-body">
            {{ $book->message }}
        </div>
    @endforeach
    </div>

@endsection
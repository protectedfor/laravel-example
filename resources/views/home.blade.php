@extends('templates.app')
@section('metatitle')
    page1
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
            <label for="">Имя</label>
            <input name="name" value="{{ old('name') }}" type="text" class="form-control" id="" placeholder="">
        </div>
        <div class="form-group">
            <label for="">Сообщение</label>
            <textarea class="form-control" name="description" id="" cols="30" rows="10">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-default">Отправить</button>
    </form>
    <div style="margin-top: 30px;"></div>

    @foreach($books as $book)
        <div class="panel panel-default">
            <div class="panel-heading">{{ $book->name }} - {{ $book->created_at->format('d.m.Y H:i:s') }}</div>
            <div class="panel-body">
                {{ $book->description }}
            </div>
        </div>
    @endforeach
@endsection
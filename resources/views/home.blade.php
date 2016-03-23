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
    {!! Form::open(['route' => 'books.store']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Имя') !!}
        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('name', 'Сообщение') !!}
        {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'cols' => '30', 'rows' => '10']) !!}
    </div>
    {!! Form::submit('Отправить', ['class' => 'btn btn-default']) !!}
    {!! Form::close() !!}
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
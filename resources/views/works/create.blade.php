@extends('templates.app')
@section('content')
    {!! Form::open(['route' => 'works.store']) !!}
    <div class="form-group">
        {!! Form::label('title', 'Название работы') !!}
        {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('description', 'Описание работы') !!}
        {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'cols' => '30', 'rows' => '10']) !!}
    </div>
    {!! Form::submit('Добавить', ['class' => 'btn btn-default']) !!}
    {!! Form::close() !!}
    <div style="margin-top: 30px;"></div>
@endsection
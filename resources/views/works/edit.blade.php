@extends('0.resources.views.templates.app')
@section('content')
    {!! Form::open(['route' => 'works.update']) !!}
    <div class="form-group">
        {!! Form::label('title', 'Название работы') !!}
        {!! Form::text($work->title, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('description', 'Описание работы') !!}
        {!! Form::textarea($work->description, ['class' => 'form-control', 'cols' => '30', 'rows' => '10']) !!}
    </div>
    {!! Form::submit('Добавить', ['class' => 'btn btn-default']) !!}
    {!! Form::close() !!}
    <div style="margin-top: 30px;"></div>
@endsection
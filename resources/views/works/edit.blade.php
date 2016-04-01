@extends('templates.app')
@section('content')
    {!! Form::open(['route' => ['works.update', $work->id], 'enctype' => 'multipart/form-data', 'id' => 'fileupload']) !!}
    <div class="form-group">
        {!! Form::label('title', 'Название работы') !!}
        {!! Form::text('title', $work->title, ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple/>
                </span>
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
    </div>
    <div class="form-group">
        {!! Form::label('description', 'Описание работы') !!}
        {!! Form::textarea('description', $work->description, ['class' => 'form-control', 'cols' => '30', 'rows' => '10']) !!}
    </div>
    {!! Form::submit('Добавить', ['class' => 'btn btn-default']) !!}
    {!! Form::close() !!}
    <div style="margin-top: 30px;"></div>
@endsection
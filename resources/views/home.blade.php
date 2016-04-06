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
    <div class="com-md-3">
        <input type="text" name="first" class="form-control">
    </div>
    <div class="com-md-3">
        <input type="text" name="second" class="form-control">
    </div>
    <button class="btn btn-success ajax-button">Отправить</button>
    <p id="result"></p>



    {{--{!! Form::open(['route' => 'works.store', 'enctype' => 'multipart/form-data', 'id' => 'fileupload']) !!}--}}
    {{--<div class="form-group">--}}
        {{--{!! Form::label('title', 'Название работы') !!}--}}
        {{--{!! Form::text('title', old('title'), ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
        {{--<span class="btn btn-success fileinput-button">--}}
                    {{--<i class="glyphicon glyphicon-plus"></i>--}}
                    {{--<span>Add files...</span>--}}
                    {{--<input type="file" name="files[]" multiple/>--}}
                {{--</span>--}}
        {{--<table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
        {{--{!! Form::label('description', 'Описание работы') !!}--}}
        {{--{!! Form::textarea('description', old('description'), ['class' => 'form-control', 'cols' => '30', 'rows' => '10']) !!}--}}
    {{--</div>--}}
    {{--{!! Form::submit('Добавить', ['class' => 'btn btn-default']) !!}--}}
    {{--{!! Form::close() !!}--}}
@endsection
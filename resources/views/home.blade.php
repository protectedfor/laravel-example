@extends('templates.app')
@section('metatitle')
    page1
@endsection
@section('content')

    @if(Auth::check())
        <a href="{{ route('works.create') }}" class="btn btn-success">Добавить работу</a>
    @else
        <h4>Для того чтобы добавить работу необходимо <a href="{{ url('auth/login') }}">авторизоваться</a> или <a href="{{ url('auth/register') }}">зарегистрироваться</a></h4>
    @endif


    <div class="row" style="margin-top: 15px;">
        @foreach($works as $work)
            <div class="col-md-4 work-block">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ str_limit($work->title, 25) }}<span class="badge pull-right">{{ $work->views }}</span></h3>
                        @if($work->canAccessed())
                            <a class="glyphicon glyphicon-pencil" href="{{ route('works.edit', $work->id)  }}" style="float: right;margin-top: -15px;"></a>
                        @endif
                    </div>
                    <div class="panel-body">
                        <a href="{{ route('works.show', $work->id) }}" class="thumbnail">
                            <img src="{{ $work->mainImage }}" alt="{{ $work->title }}">
                        </a>
                        <p style="max-height: 40px;overflow: hidden;">
                            {{ str_limit(strip_tags($work->description)) }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <div class="row" style="margin-top: 15px;">
        <div class="col-md-4">
            <?php

            echo "<ul>";
            foreach ($categories as $root) renderNode($root);
            echo "</ul>";

            // *Very simple* recursive rendering function
            function renderNode($node)
            {
                echo "<li>";
                echo "<b>{$node->title}</b>";

                if ($node->children()->count() > 0) {
                    echo "<ul>";
                    foreach ($node->children as $child) renderNode($child);
                    echo "</ul>";
                }

                echo "</li>";

            }
            ?>
        </div>
    </div>

    {{--<div class="com-md-3">--}}
    {{--<input type="text" name="first" class="form-control">--}}
    {{--</div>--}}
    {{--<div class="com-md-3">--}}
    {{--<input type="text" name="second" class="form-control">--}}
    {{--</div>--}}
    {{--<button class="btn btn-success ajax-button">Отправить</button>--}}
    {{--<p id="result"></p>--}}



    {{--{!! Form::open(['route' => 'works.store', 'enctype' => 'multipart/form-data', 'class' => 'work_create_form']) !!}--}}
    {{--<div class="form-group">--}}
    {{--{!! Form::label('title', 'Название работы') !!}--}}
    {{--{!! Form::text('title', old('title'), ['class' => 'form-control']) !!}--}}
    {{--</div>--}}
    {{--<div class="form-group">--}}
    {{--{!! Form::label('description', 'Описание работы') !!}--}}
    {{--{!! Form::textarea('description', old('description'), ['class' => 'form-control', 'cols' => '30', 'rows' => '10']) !!}--}}
    {{--</div>--}}
    {{--{!! Form::submit('Добавить', ['class' => 'btn btn-default']) !!}--}}
    {{--{!! Form::close() !!}--}}

@endsection
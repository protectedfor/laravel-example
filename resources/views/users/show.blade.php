@extends('templates.app')
@section('content')
    @foreach($works as $work)
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ str_limit($work->title, 25) }}</h3>
                    <a class="glyphicon glyphicon-pencil" href="{{ route('works.edit', $work->id)  }}" style="float: right;margin-top: -15px;"></a>
                </div>
                <div class="panel-body">
                    <a href="" class="thumbnail">
                        <img src="{{ $work->mainImage }}" alt="{{ $work->title }}">
                    </a>
                    {{ str_limit($work->description) }}
                </div>
            </div>
        </div>
    @endforeach
@endsection
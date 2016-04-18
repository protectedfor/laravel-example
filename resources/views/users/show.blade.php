@extends('templates.app')
@section('content')
    <div class="row">
        @foreach($works as $work)
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ str_limit($work->title, 25) }}</h3>
                        @if($work->canAccessed())
                            <a class="glyphicon glyphicon-pencil" href="{{ route('works.edit', $work->id)  }}" style="float: right;margin-top: -15px;"></a>
                        @endif
                    </div>
                    <div class="panel-body">
                        <a href="{{ route('works.show', $work->id) }}" class="thumbnail">
                            <img src="{{ $work->mainImage }}" alt="{{ $work->title }}">
                        </a>
                        {{ str_limit(strip_tags($work->description)) }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            {!! $works->render() !!}
        </div>
    </div>
@endsection
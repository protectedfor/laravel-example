@extends('templates.app')
@section('content')
    {!! Breadcrumbs::render('users_index') !!}
    <div class="row">
        @foreach($users as $user)
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <a href="{{ route('users.show', $user->id) }}">{{ str_limit($user->name, 25) }}</a>
                            <span class="badge pull-right">{{ $user->works->count() }}</span>
                        </h3>
                    </div>
                    <div class="panel-body">
                        {{ str_limit(strip_tags($user->email)) }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            {!! $users->render() !!}
        </div>
    </div>
@endsection
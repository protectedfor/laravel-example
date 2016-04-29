@extends('templates.app')
@section('content')
    <h2>{{ $work->title }} <span class="badge">{{ $work->views }}</span></h2>

    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        @if(count($work->photos) > 1)
            <ol class="carousel-indicators">
                @foreach($work->photos as $k => $photo)
                    <li data-target="#carousel-example-generic" data-slide-to="0" class=" @if($k == 0) active @endif"></li>
                @endforeach
            </ol>
        @endif
        <div class="carousel-inner" role="listbox">
            @foreach($work->photos as $k => $photo)
                <div class="item @if($k == 0) active @endif">
                    <img src="{{ route('imagecache', ['work_images', $photo->path]) }}" alt="...">
                    <div class="carousel-caption">
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Controls -->
        @if(count($work->photos) > 1)
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        @endif
    </div>
    <table class="table table-hover">
        <tr>
            <td>Дата добавления:</td>
            <td>{{ $work->created_at->format('d.m.Y') }}</td>
        </tr>
        <tr>
            <td>Пользователь:</td>
            <td>{{ $work->user->name }}</td>
        </tr>
        <tr>
            <td>Заголовок:</td>
            <td>{{ $work->title }}</td>
        </tr>
        <tr>
            <td>Описание:</td>
            <td>{!! $work->description !!}</td>
        </tr>
    </table>
    {{--{{ dd($work->id) }}--}}

    @foreach($work->comments as $comment)
        <div class="panel panel-info">
            <div class="panel-heading"><span class="label label-success" style="font-size: 16px;margin-right:10px;">{{ $comment->user->name }}</span> {{ $comment->created_at->format('d.m.Y') }}</div>
            <div class="panel-body">{{ $comment->description }}</div>
        </div>
    @endforeach
{{--    {!! Form::open(['route' => ['comments.storeComment', $work->id], 'enctype' => 'multipart/form-data', 'id' => 'fileupload', 'class' => 'comment_create_form']) !!}--}}
    {!! Form::open(['route' => ['comments.storeComment', $work->id], 'class' => 'comment_create_form']) !!}
    {!! Form::radio('work_id', $work->id, true, ['style' => 'display:none;']) !!}
    <div class="form-group">
        {!! Form::label('description', 'Комментарий') !!}
        {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'cols' => '30', 'rows' => '10', 'placeholder' => 'Оставьте свой комментарий...']) !!}
    </div>
    {!! Form::submit('Добавить', ['class' => 'btn btn-default']) !!}
    {!! Form::close() !!}
    <div style="margin-top: 30px;"></div>


    {{--<div id="disqus_thread"></div>--}}
    <script>
        /**
         * RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
         * LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
         */
        /*
         var disqus_config = function () {
         this.page.url = PAGE_URL; // Replace PAGE_URL with your page's canonical URL variable
         this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
         };
         */
        (function () { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');

            s.src = '//laravelexample.disqus.com/embed.js';

            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
@endsection
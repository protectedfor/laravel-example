<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    <p>{!! session('error') !!}</p>
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    <p>{!! session('success') !!}</p>
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
        </div>
    </div>
</div>
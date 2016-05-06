<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">Brand</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="@if(Request::url() == route('users.index')) active @endif"><a href="{{ route('users.index') }}">{{ trans('sentences.navbar.users') }} <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Мои работы</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left" role="search" action="{{ route('home') }}">
                <div class="form-group">
                    <input type="text" name="query" value="{{ Request::get('query') }}" class="form-control" placeholder="{{ trans('sentences.search.placeholder') }}">
                </div>
                <button type="submit" class="btn btn-default">{{ trans('sentences.search.button') }}</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::check())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('users.show', Auth::id()) }}">Мои работы</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ url('auth/logout') }}">Выход</a></li>
                        </ul>
                    </li>
                @else
                    <li><a href="{{ url('auth/login') }}">Вход</a></li>
                    <li><a href="{{ url('auth/register') }}">Регистрация</a></li>
                @endif
            </ul>
            {{--            {{ dd(LaravelLocalization::getCurrentLocale()) }}--}}
            {{--{{ dd(LaravelLocalization::getSupportedLocales()) }}--}}
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ LaravelLocalization::getCurrentLocaleName() }}<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @section('localization')
                            @foreach(LaravelLocalization::getSupportedLocales() as $k => $locale)
                                <?php if (LaravelLocalization::getCurrentLocale() == $k) continue; ?>
                                <li><a href="{{ LaravelLocalization::getLocalizedURL($k) }}">{{ array_get($locale, 'native') }}</a></li>
                            @endforeach
                        @show
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
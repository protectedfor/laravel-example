<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
            <i class="fa fa-globe fa-fw"></i> {{{ $currentLocale }}} <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu" style="min-width:100px;">
            @foreach ($locales as $locale => $localeData)
                <li>
                    <a href="{{{ route('locale.switch') }}}?locale={{{ $locale }}}">
                        <div>
                            <nobr><i class="fa fa-globe fa-fw"></i> {{{ $localeData['native'] }}}</nobr>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> {{ AdminAuth::user()->name ?: 'admin' }} <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="{{ URL::route('home') }}"><i class="fa fa-sign-out fa-fw"></i> Back to Site</a></li>
            <li><a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out fa-fw"></i> {{ trans('admin::lang.auth.logout') }}</a></li>
        </ul>
    </li>
</ul>

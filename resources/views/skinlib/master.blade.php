<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') - {{ option_localized('site_name') }}</title>
    {!! bs_favicon() !!}
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- App Styles -->
    @include('common.dependencies.style', ['module' => 'skinlib'])

    @yield('style')
</head>

<body class="hold-transition {{ option('color_scheme') }} layout-top-nav">
    <div class="wrapper">

        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ option('site_url') }}" class="navbar-brand">
                            {{ option_localized('site_name') }}
                        </a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active">
                                <a href="{{ url('skinlib') }}">{{ trans('general.skinlib') }}</a>
                            </li>
                            <li>
                                <a href="{{ url('user/closet') }}">{{ trans('general.my-closet') }}</a>
                            </li>

                            @unless (isset($with_out_filter))
                            <!-- Filters -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-filter" aria-hidden="true"></i> {{ trans('skinlib.general.filter') }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="filter" data-filter="skin" href="#">{{ trans('general.skin') }} <small>{{ trans('skinlib.filter.any-model') }}</small></a></li>

                                    <li><a class="filter" data-filter="steve" href="#">{{ trans('general.skin') }} <small>{{ trans('skinlib.filter.steve-model') }}</small></a></li>

                                    <li><a class="filter" data-filter="alex" href="#">{{ trans('general.skin') }} <small>{{ trans('skinlib.filter.alex-model') }}</small></a></li>

                                    <li class="divider"></li>

                                    <li><a class="filter" data-filter="cape" href="#">{{ trans('general.cape') }}</a></li>

                                    @if (!is_null($user))
                                    <li class="divider"></li>
                                    <li><a class="filter" data-filter="uploader" data-uid="{{ $user->uid }}" href="#">{{ trans('skinlib.general.my-upload') }}</a></li>
                                    @endif

                                    <li class="divider"></li>
                                    <li><a href="{{ url('skinlib') }}">{{ trans('skinlib.filter.clean-filter') }}</a></li>
                                </ul>
                            </li>

                            <!-- Sort -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-sort-amount-desc" aria-hidden="true"></i> {{ trans('skinlib.general.sort') }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a class="sort" data-sort="likes" href="#">{{ trans('skinlib.sort.most-likes') }}</a></li>
                                    <li class="divider"></li>
                                    <li><a class="sort" data-sort="time" href="#">{{ trans('skinlib.sort.newest-uploaded') }}</a></li>
                                </ul>
                            </li>
                            @endunless
                        </ul>

                        @unless (isset($with_out_filter))
                        <form class="navbar-form navbar-left" id="search-form" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" id="navbar-search-input" name="q" placeholder="{{ trans('skinlib.general.search-textures') }}" value="{{ $q or '' }}" />
                            </div>
                        </form>
                        @endunless
                    </div><!-- /.navbar-collapse -->
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('skinlib/upload') }}"><i class="fa fa-upload" aria-hidden="true"></i> <span class="description-text">{{ trans('skinlib.general.upload-new-skin') }}</span></a></li>

                            @include('common.language')

                            @if (!is_null($user))
                                @include('common.user-menu')
                            @else {{-- Anonymous User --}}
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <!-- Menu Toggle Button -->
                                <a href="{{ url('auth/login') }}">
                                    <i class="fa fa-user"></i>
                                    <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                    <span class="hidden-xs nickname">{{ trans('general.anonymous') }}</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div><!-- /.navbar-custom-menu -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>

        @yield('content')

        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="container">
                <!-- YOU CAN NOT MODIFIY THE COPYRIGHT TEXT W/O PERMISSION -->
                <div id="copyright-text" class="pull-right hidden-xs">
                    {!! bs_copyright() !!}
                </div>
                <!-- Default to the left -->
                {!! bs_custom_copyright() !!}
            </div>
        </footer>

    </div><!-- ./wrapper -->

    <!-- App Scripts -->
    @include('common.dependencies.script', ['module' => 'skinlib'])

    @yield('script')

    <script>
        if ($('.navbar').height() > 50) {
            $('.description-text').hide();
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ option_localized('site_name') }}</title>
    {!! bs_favicon() !!}
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- App Styles -->
    @include('common.dependencies.style', ['module' => 'index'])
</head>

<body class="hold-transition {{ option('color_scheme') }} layout-top-nav">

    <div class="hp-wrapper" style="background-image: url('{{ $home_pic_url }}');">
        <!-- Navigation -->
        <header class="main-header transparent">
            <nav class="navbar navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="{{ option('site_url') }}" class="navbar-brand">{{ option_localized('site_name') }}</a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="{{ url('/') }}">{{ trans('general.index') }}</a></li>
                            <li><a href="{{ url('skinlib') }}">{{ trans('general.skinlib') }}</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            @include('common.language')

                            @if (!is_null($user))
                                @include('common.user-menu')
                            @else {{-- Anonymous User --}}
                            <!-- User Account Menu -->
                            <li class="dropdown user user-menu">
                                <a href="{{ url('auth/login') }}" class="btn btn-login">{{ trans('general.login') }}</a>
                            </li>
                            @endif
                        </ul>
                    </div><!-- /.navbar-custom-menu -->
                </div><!-- /.container-fluid -->
            </nav>
        </header>

        <div class="container">
            <div class="splash">
                <h1 class="splash-head">{{ option_localized('site_name') }}</h1>
                <p class="splash-subhead">
                    {{ option_localized('site_description') }}
                </p>
                <p>
                    @if (is_null($user))
                        @if (option('user_can_register'))
                        <a href="{{ url('auth/register') }}" id="btn-register" class="button">{{ trans('general.register') }}</a>
                        @else
                        <a href="{{ url('auth/login') }}" id="btn-close-register" class="button">{{ trans('general.login') }}</a>
                        @endif
                    @else
                    <a href="{{ url('user') }}" class="button">{{ trans('general.user-center') }}</a>
                    @endif
                </p>
            </div>
        </div> <!--/ .container -->
    </div><!--/ #headerwrap -->

    <!-- INTRO WRAP -->
    <div id="intro">
        <div class="container">
            <div class="row text-center">
                <h1>Features</h1>
                <br>
                <br>
                <div class="col-lg-4">
                    <i class="fa {{ trans('index.features.first.icon') }}" aria-hidden="true"></i>
                    <h3>{!! trans('index.features.first.name') !!}</h3>
                    <p>{!! trans('index.features.first.desc') !!}</p>
                </div>
                <div class="col-lg-4">
                    <i class="fa {{ trans('index.features.second.icon') }}" aria-hidden="true"></i>
                    <h3>{!! trans('index.features.second.name') !!}</h3>
                    <p>{!! trans('index.features.second.desc') !!}</p>
                </div>
                <div class="col-lg-4">
                    <i class="fa {{ trans('index.features.third.icon') }}" aria-hidden="true"></i>
                    <h3>{!! trans('index.features.third.name') !!}</h3>
                    <p>{!! trans('index.features.third.desc') !!}</p>
                </div>
            </div>
            <br>
        </div> <!--/ .container -->
    </div><!--/ #introwrap -->

    <div id="footerwrap">
        <div class="container">
            <div class="col-lg-6">
                {!! trans('index.introduction', ['sitename' => option_localized('site_name')]) !!}
            </div>

            <div class="col-lg-6">
                <a href="{{ url('auth/register') }}" id="btn-register" class="button">{{ trans('index.start') }}</a>
            </div>
        </div>
    </div>

    <div id="copyright">
        <!-- Designed by Pratt -->
        <div class="container">
            <!-- YOU CAN NOT MODIFIY THE COPYRIGHT TEXT W/O PERMISSION -->
            <div id="copyright-text" class="pull-right hidden-xs">
                {!! bs_copyright() !!}
            </div>
            <!-- Default to the left -->
            {!! bs_custom_copyright() !!}
        </div>
    </div>

    <!-- App Scripts -->
    @include('common.dependencies.script')

    <script type="text/javascript">

        function changeWrapperHeight() {
            var btn = $('p a.button');
            var bottom = btn.offset().top + btn.height() + 80;

            if (bottom > $(window).height()) {
                $('.hp-wrapper').height(bottom + 'px');
            } else {
                $('.hp-wrapper').height($(window).height() + 'px');
            }
        }

        function changeHeaderTransparency() {
            if ($(window).scrollTop() >= ($(window).height() * 2 / 3)) {
                $('.main-header').removeClass('transparent');
            } else {
                $('.main-header').addClass('transparent');
            }
        }

        $(window)
            .scroll(changeHeaderTransparency)
            .ready(changeWrapperHeight)
            .resize(function () {
                isMobileBrowserScrolling() ? null : changeWrapperHeight();
            });
    </script>
</body>
</html>

@extends('auth.master')

@section('title', trans('auth.forgot.title'))

@section('content')

<div class="login-box">
    <div class="login-logo">
        <a href="{{ url('/') }}">{{ option_localized('site_name') }}</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">@lang('auth.forgot.message')</p>

        @if (Session::has('msg'))
        <div class="callout callout-warning">{{ Session::pull('msg') }}</div>
        @endif

        <form id="login-form">
            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control" placeholder="@lang('auth.email')">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="row" id="captcha-form">
                <div class="col-xs-8">
                    <div class="form-group has-feedback">
                        <input id="captcha" type="text" class="form-control" placeholder="@lang('auth.captcha')">
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <img class="pull-right captcha" src="{{ url('auth/captcha') }}" alt="CAPTCHA" title="@lang('auth.change-captcha')" data-placement="top" data-toggle="tooltip">
                </div>
                <!-- /.col -->
            </div>

            <div id="msg" class="callout hide"></div>

            <div class="row">
                <div class="col-xs-8">
                    <a href="{{ url('auth/login') }}" class="text-center">@lang('auth.forgot.login-link')</a>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button id="forgot-button" class="btn btn-primary btn-block btn-flat">@lang('auth.forgot.button')</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

@endsection

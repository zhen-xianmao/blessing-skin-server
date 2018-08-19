@extends('admin.master')

@section('title', trans('general.plugin-manage'))

@section('style')
<style> .btn { margin-right: 4px; } </style>
@endsection

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            @lang('general.plugin-manage')
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        @if (session()->has('message'))
            <div class="callout callout-success" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <div class="box">
            <div class="box-body table-bordered">
                <table id="plugin-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th>@lang('admin.plugins.name')</th>
                            <th>@lang('admin.plugins.description')</th>
                            <th>@lang('admin.plugins.author')</th>
                            <th>@lang('admin.plugins.version')</th>
                            <th>@lang('admin.plugins.dependencies')</th>
                            <th>@lang('admin.plugins.status.title')</th>
                            <th>@lang('admin.plugins.operations.title')</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection

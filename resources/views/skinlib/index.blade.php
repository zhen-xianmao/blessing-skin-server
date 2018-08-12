@extends('skinlib.master')

@section('title', trans('general.skinlib'))

@section('content')
<!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>{{ trans('general.skinlib') }}
                <small id="search-indicator"></small>
            </h1>
            <ol class="breadcrumb">
                <li><i class="fa fa-tags"></i> {{ trans('skinlib.filter.now-showing') }}</li>
                <li id="filter-indicator"></li>
                <li id="uploader-indicator"></li>
                <li class="active" id="sort-indicator"></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="box box-default">
                <!-- Container of Skin Library -->
                <div id="skinlib-container" class="box-body"></div>

                <div class="box-footer">
                    <!-- Pagination -->
                    <div class="pull-right" id="skinlib-paginator"></div>
                    <select class="pull-right pagination"></select>
                    <p class="pull-right pagination"></p>
                </div>

                <div class="overlay">
                    <i class="fa fa-refresh fa-spin"></i>
                    <span>{{ trans('general.loading') }}</span>
                </div>
            </div><!-- /.box -->
        </section><!-- /.content -->
    </div><!-- /.container -->
</div><!-- /.content-wrapper -->
@endsection

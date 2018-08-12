@extends('admin.master')

@section('title', trans('general.player-manage'))

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            {{ trans('general.player-manage') }}
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-body table-bordered">
                <table id="player-table" class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ trans('general.player.pid') }}</th>
                            <th>{{ trans('general.player.owner') }}</th>
                            <th>{{ trans('general.player.player-name') }}</th>
                            <th>{{ trans('general.player.preference') }}</th>
                            <th>{{ trans('general.player.previews') }}</th>
                            <th>{{ trans('general.player.last-modified') }}</th>
                            <th>{{ trans('general.operations') }}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        $('.box-body').css(
            'min-height',
            $('.content-wrapper').height() - $('.content-header').outerHeight() - 120
        );
    });
</script>
@endsection

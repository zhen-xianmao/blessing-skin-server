@extends('skinlib.master')

@section('title', $texture->name)

@section('content')
<!-- Full Width Column -->
<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @lang('skinlib.show.title')
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="box box-primary">
                        @include('common.texture-preview')

                        <div class="box-footer">
                            @if (is_null($user)) {{-- Not logged in --}}
                            <button disabled="disabled" title="@lang('skinlib.show.anonymous')" class="btn btn-primary pull-right">@lang('skinlib.item.add-to-closet')</button>
                            @else

                                @if ($user->getCloset()->has($texture->tid))
                                <a onclick="removeFromCloset({{ $texture->tid }});" id="{{ $texture->tid }}" class="btn btn-primary pull-right">@lang('skinlib.item.remove-from-closet')</a>
                                @else
                                <a onclick="addToCloset({{ $texture->tid }});" id="{{ $texture->tid }}" class="btn btn-primary pull-right">@lang('skinlib.item.add-to-closet')</a>
                                @endif

                            @endif
                            <div class="btn likes" title="@lang('skinlib.show.likes')" data-toggle="tooltip" data-placement="top"><i class="fas fa-heart"></i>
                                <span id="likes">{{ $texture->likes }}</span>
                            </div>
                        </div><!-- /.box-footer -->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('skinlib.show.detail')</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>@lang('skinlib.show.name')</td>
                                        <td id="name">{{ $texture->name }}
                                            @if (!is_null($user) && ($texture->uploader == $user->uid || $user->isAdmin()))
                                            <small>
                                                <a style="cursor: pointer" onclick="changeTextureName({{ $texture->tid }}, '{{ $texture->name }}');">@lang('skinlib.show.edit-name')</a>
                                            </small>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('skinlib.show.model')</td>
                                        <td>
                                            @if ($texture->type == 'cape')
                                                @lang('general.cape')
                                            @else
                                                {{ $texture->type }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Hash
                                            @if (option('allow_downloading_texture'))
                                            <i class="fas fa-question-circle" title="@lang('skinlib.show.download-raw')" data-toggle="tooltip" data-placement="top"></i>
                                            @endif
                                        </td>
                                        <td>
                                            @if (option('allow_downloading_texture'))
                                            <a href="{{ url('raw/'.$texture->tid) }}.png" title="{{ $texture->hash }}">{{ substr($texture->hash, 0, 15) }}...</a>
                                            @else
                                            <span title="{{ $texture->hash }}">{{ substr($texture->hash, 0, 15) }}...</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>@lang('skinlib.show.size')</td>
                                        <td>{{ $texture->size }} KB</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('skinlib.show.uploader')</td>
                                        @if ($uploader = app('users')->get($texture->uploader))
                                        <td><a href="{{ url('skinlib?filter='.($texture->type == 'cape' ? 'cape' : 'skin').'&uploader='.$uploader->uid) }}&sort=time">{{ $uploader->getNickName() }}</a></td>
                                        @else
                                        <td><a href="#">@lang('general.unexistent-user')</a></td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>@lang('skinlib.show.upload-at')</td>
                                        <td>{{ $texture->upload_at }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

                    @if (!is_null($user))
                        @if ($texture->uploader == $user->uid)
                            @include('common.manage-panel', [
                                'title'   => trans('skinlib.show.delete-texture')." / ".trans('skinlib.privacy.change-privacy'),
                                'message' => trans('skinlib.show.notice')
                            ])

                        @elseif ($user->isAdmin())
                            @include('common.manage-panel', [
                                'title'   => trans('skinlib.show.manage-panel'),
                                'message' => trans('skinlib.show.notice-admin')
                            ])
                        @endif
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">@lang('skinlib.show.comment')</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            @if (option('comment_script') != "")
                            <!-- Comment Start -->
                            {!! Utils::getStringReplaced(option('comment_script'), ['{tid}' => $texture->tid, '{name}' => $texture->name, '{url}' => get_current_url()]) !!}
                            <!-- Comment End -->
                            @else
                            <p style="text-align: center; margin: 30px 0;">@lang('skinlib.show.comment-not-available')</p>
                            @endif
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>

        </section><!-- /.content -->
    </div><!-- /.container -->
</div><!-- /.content-wrapper -->

@endsection

@section('script')
<script>
    var texture = {!! $texture->toJson() !!};

    $.msp.config.slim = (texture.type === 'alex');
    $.msp.config.skinUrl = texture.type === 'alex' ? defaultAlexSkin : defaultSteveSkin;

    if (texture.type === 'cape') {
        $.msp.config.capeUrl = url('textures/' + texture.hash);
    } else {
        $.msp.config.skinUrl = url('textures/' + texture.hash);
    }

    $(document).ready(function () {
        initSkinViewer(60);
        registerAnimationController();
        registerWindowResizeHandler();
    });
</script>
@endsection

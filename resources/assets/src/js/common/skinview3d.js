/* global skinview3d */

$.msp = {};
$.msp.handles = {};
$.msp.control = null;
$.msp.config = {
    domElement: document.getElementById('skin_container'),
    slim: false,
    width: $('#skin_container').width(),
    height: $('#skin_container').height(),
    skinUrl: '',
    capeUrl: ''
};

function initSkinViewer(cameraPositionZ = 70) {
    disposeSkinViewer();

    $.msp.viewer = new skinview3d.SkinViewer($.msp.config);
    $.msp.viewer.camera.position.z = cameraPositionZ;

    $.msp.viewer.animation = new skinview3d.CompositeAnimation();

    // Init all available animations and pause them
    $.msp.handles.walk   = $.msp.viewer.animation.add(skinview3d.WalkingAnimation);
    $.msp.handles.run    = $.msp.viewer.animation.add(skinview3d.RunningAnimation);
    $.msp.handles.rotate = $.msp.viewer.animation.add(skinview3d.RotatingAnimation);
    $.msp.handles.walk.paused = $.msp.handles.run.paused = $.msp.handles.rotate.paused = true;

    $.msp.control = skinview3d.createOrbitControls($.msp.viewer);
}

function disposeSkinViewer() {
    if ($.msp.viewer instanceof skinview3d.SkinViewer) {
        $.msp.viewer.dispose();
        $.msp.handles = {};
        $.msp.control = undefined;
    }
}

function initAnimationControllers() {
    $('.fa-pause').click(function () {
        $.msp.viewer.animationPaused = !$.msp.viewer.animationPaused;
        $(this).toggleClass('fa-pause').toggleClass('fa-play');
    });

    $('.fa-forward').click(function () {
        $.msp.handles.run.paused  = !$.msp.handles.run.paused;
        $.msp.handles.walk.paused = !$.msp.handles.run.paused;
    });

    $('.fa-repeat').click(() => ($.msp.handles.rotate.paused = !$.msp.handles.rotate.paused));
    $('.fa-stop').click(() => initSkinViewer());
}

if (process.env.NODE_ENV === 'test') {
    module.exports = { initSkinViewer, initAnimationControllers };
}

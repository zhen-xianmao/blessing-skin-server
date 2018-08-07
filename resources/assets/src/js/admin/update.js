'use strict';

async function downloadUpdates() {
    console.log('Prepare to download');

    let intervalId;

    try {
        const preparation = await fetch({
            url: url('admin/update/download?action=prepare-download'),
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                $('#update-button').html(
                    `<i class="fa fa-spinner fa-spin"></i> ${ trans('admin.preparing') }`
                ).prop('disabled', true);
            }
        });
        console.log(preparation);

        $('#modal-start-download').modal({
            'backdrop': 'static',
            'keyboard': false
        });

        console.log('Start downloading');

        // Start downloading progress polling
        intervalId = setInterval(progressPolling, 1000);

        const download = await fetch({
            url: url('admin/update/download?action=start-download'),
            type: 'POST',
            dataType: 'json'
        });

        clearInterval(intervalId);

        console.log('Downloading finished');
        console.log(download);

        $('.modal-title').html('<i class="fa fa-spinner fa-spin"></i> ' + trans('admin.extracting'));
        $('.modal-body').append(`<p>${trans('admin.downloadCompleted')}</p>`);

        console.log('Start extracting');

        const extract = await fetch({
            url: url('admin/update/download?action=extract'),
            type: 'POST',
            dataType: 'json'
        });

        console.log('Package extracted and files are covered');
        $('#modal-start-download').modal('toggle');

        swal({
            type: 'success',
            html: extract.msg
        }).then(function () {
            window.location = url('/');
        }, function () {
            window.location = url('/');
        });
    } catch (error) {
        showAjaxError(error);
        clearInterval(intervalId);
    }
}

async function progressPolling() {
    try {
        const { total, downloaded } = await fetch({
            url: url('admin/update/download?action=get-progress'),
            type: 'GET'
        });

        if (total === undefined) {
            return;
        }

        const progress = (downloaded / total * 100).toFixed(2);
        console.log(`Download progress: ${downloaded}/${total}`);

        $('#file-size').html(total);
        $('#download-progress').html(progress);
        $('.progress-bar')
            .css('width', progress + '%')
            .attr('aria-valuenow', progress);
    } catch (error) {
        // No need to show error if failed to get size
    }
}

async function checkForUpdates() {
    try {
        const data = await fetch({ url: url('admin/update/check') });
        if (data.available === true) {
            const dom = `<span class="label label-primary pull-right">v${data.latest}</span>`;

            $(`[href="${url('admin/update')}"]`).append(dom);
        }
    } catch (error) {
        //
    }
}

if (process.env.NODE_ENV === 'test') {
    module.exports = {
        checkForUpdates,
        progressPolling,
        downloadUpdates,
    };
}

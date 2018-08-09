'use strict';

if ($('#plugin-table').length === 1) {
    $(document).ready(initPluginsTable);
}

function initPluginsTable() {
    $.pluginsTable = $('#plugin-table').DataTable({
        columnDefs: pluginsTableColumnDefs,
        fnDrawCallback: () => $('[data-toggle="tooltip"]').tooltip(),
        ajax: {
            url: url('admin/plugins/data'),
            type: 'POST'
        }
    }).on('xhr.dt', handleDataTablesAjaxError);
}

const pluginsTableColumnDefs = [
    {
        targets: 0,
        data: 'title'
    },
    {
        targets: 1,
        data: 'description',
        orderable: false,
        width: '35%'
    },
    {
        targets: 2,
        data: 'author',
        render: data => isEmpty(data.url) ? data.author : `<a href="${data.url}" target="_blank">${data.author}</a>`
    },
    {
        targets: 3,
        data: 'version',
        orderable: false
    },
    {
        targets: 4,
        data: 'dependencies',
        searchable: false,
        orderable: false,
        render: data => {
            if (data.requirements.length === 0) {
                return `<i>${trans('admin.noDependencies')}</i>`;
            }

            let result = data.isRequirementsSatisfied ? '' : `<a href="http://t.cn/RrT7SqC" target="_blank" class="label label-primary">${trans('admin.whyDependencies')}</a><br>`;

            for (const name in data.requirements) {
                const constraint = data.requirements[name];
                const color = (name in data.unsatisfiedRequirements) ? 'red' : 'green';

                result += `<span class="label bg-${color}">${name}: ${constraint}</span><br>`;
            }

            return result;
        }
    },
    {
        targets: 5,
        data: 'status'
    },
    {
        targets: 6,
        data: 'operations',
        searchable: false,
        orderable: false,
        render: (data, type, row) => {
            let toggleButton, configViewButton;

            if (data.enabled) {
                toggleButton = `<a class="btn btn-warning btn-sm" onclick="disablePlugin('${row.name}');">${trans('admin.disablePlugin')}</a>`;
            } else {
                toggleButton = `<a class="btn btn-primary btn-sm" onclick="enablePlugin('${row.name}');">${trans('admin.enablePlugin')}</a>`;
            }

            if (data.enabled && data.hasConfigView) {
                configViewButton = `<a class="btn btn-default btn-sm" href="${url('/')}admin/plugins/config/${row.name}">${trans('admin.configurePlugin')}</a>`;
            } else {
                configViewButton = `<a class="btn btn-default btn-sm" disabled="disabled" title="${trans('admin.noPluginConfigNotice')}" data-toggle="tooltip" data-placement="top">${trans('admin.configurePlugin')}</a>`;
            }

            const deletePluginButton = `<a class="btn btn-danger btn-sm" onclick="deletePlugin('${row.name}');">${trans('admin.deletePlugin')}</a>`;

            return toggleButton + configViewButton + deletePluginButton;
        }
    }
];

async function enablePlugin(name) {
    try {
        const { requirements } = await fetch({
            type: 'POST',
            url: url(`admin/plugins/manage?action=requirements&name=${name}`),
            dataType: 'json'
        });

        if (requirements.length === 0) {
            await swal({
                text: trans('admin.noDependenciesNotice'),
                type: 'warning',
                showCancelButton: true
            });
        }

        const { errno, msg, reason } = await fetch({
            type: 'POST',
            url: url(`admin/plugins/manage?action=enable&name=${name}`),
            dataType: 'json'
        });

        if (errno === 0) {
            toastr.success(msg);

            $.pluginsTable.ajax.reload(null, false);
        } else {
            swal({ type: 'warning', html: `<p>${msg}</p><ul><li>${reason.join('</li><li>')}</li></ul>` });
        }
    } catch (error) {
        showAjaxError(error);
    }
}

async function disablePlugin(name) {
    try {
        const { errno, msg } = await fetch({
            type: 'POST',
            url: url(`admin/plugins/manage?action=disable&name=${name}`),
            dataType: 'json'
        });
        if (errno === 0) {
            toastr.success(msg);

            $.pluginsTable.ajax.reload(null, false);
        } else {
            swal({ type: 'warning', html: msg });
        }
    } catch (error) {
        showAjaxError(error);
    }
}

async function deletePlugin(name) {
    try {
        await swal({
            text: trans('admin.confirmDeletion'),
            type: 'warning',
            showCancelButton: true
        });
    } catch (error) {
        return;
    }

    try {
        const { errno, msg } = await fetch({
            type: 'POST',
            url: url(`admin/plugins/manage?action=delete&name=${name}`),
            dataType: 'json'
        });
        if (errno === 0) {
            toastr.success(msg);

            $.pluginsTable.ajax.reload(null, false);
        } else {
            swal({ type: 'warning', html: msg });
        }
    } catch (error) {
        showAjaxError(error);
    }
}

if (process.env.NODE_ENV === 'test') {
    module.exports = {
        initPluginsTable,
        deletePlugin,
        enablePlugin,
        disablePlugin,
    };
}

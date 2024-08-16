@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div id="toolbar">
                <button id="remove" class="btn btn-danger" disabled>
                    <i class="fa fa-trash"></i> Delete
                </button>
            </div>
            <table id="table" data-toolbar="#toolbar" data-search="true" data-show-refresh="true"
                data-show-toggle="true" data-show-fullscreen="true" data-show-columns="true"
                data-show-columns-toggle-all="true" data-detail-view="true" data-show-export="true"
                data-click-to-select="true" data-detail-formatter="detailFormatter" data-minimum-count-columns="2"
                data-show-pagination-switch="true" data-pagination="true" data-id-field="id"
                data-page-list="[10, 25, 50, 100, all]" data-show-footer="true" data-side-pagination="server"
                data-url="{{ route('api.linkedin-companies-list') }}" data-response-handler="responseHandler">
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
var $table = $('#table')
var $remove = $('#remove')
var selections = []

function getIdSelections() {
    return $.map($table.bootstrapTable('getSelections'), function(row) {
        return row.id
    })
}

function responseHandler(res) {
    $.each(res.rows, function(i, row) {
        row.state = $.inArray(row.id, selections) !== -1
    })
    return res
}

function detailFormatter(index, row) {
    var html = []
    $.each(row, function(key, value) {
        html.push('<p><b>' + key + ':</b> ' + value + '</p>')
    })
    return html.join('')
}

function operateFormatter(value, row, index) {
    return [
        '<a class="edit" href="javascript:void(0)" title="Edit">',
        '<i class="fa fa-edit"></i>',
        '</a>  ',
        '<a class="remove" href="javascript:void(0)" title="Remove">',
        '<i class="fa fa-trash"></i>',
        '</a>'
    ].join('')
}

window.operateEvents = {
    'click .edit': function(e, value, row, index) {
        // Implement edit functionality if needed
    },
    'click .remove': function(e, value, row, index) {
        $table.bootstrapTable('remove', {
            field: 'id',
            values: [row.id]
        })
    }
}

function initTable() {
    $table.bootstrapTable('destroy').bootstrapTable({
        height: 600,
        locale: 'en-US',
        columns: [
            [{
                    field: 'state',
                    checkbox: true,
                    align: 'center',
                    valign: 'middle'
                },
                {
                    field: 'name',
                    title: 'Company Name',
                    sortable: true,
                    align: 'left'
                },
                {
                    field: 'industry',
                    title: 'Industry',
                    sortable: true,
                    align: 'center'
                },
                {
                    field: 'country',
                    title: 'Country',
                    sortable: true,
                    align: 'center'
                },
                {
                    field: 'linkedin_url',
                    title: 'LinkedIn URL',
                    sortable: true,
                    align: 'left',
                    formatter: function(value, row, index) {
                        return `<a href="${value}" target="_blank">${value}</a>`;
                    }
                },
                {
                    field: 'created_at',
                    title: 'Created At',
                    sortable: true,
                    align: 'center',
                    formatter: function(value, row, index) {
                        return new Date(value).toLocaleDateString();
                    }
                },
                {
                    field: 'operate',
                    title: 'Actions',
                    align: 'center',
                    events: operateEvents,
                    formatter: operateFormatter
                }
            ]
        ]
    });

    $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table',
        function() {
            $remove.prop('disabled', !$table.bootstrapTable('getSelections').length);
            selections = getIdSelections();
        });

    $table.on('all.bs.table', function(e, name, args) {
        console.log(name, args);
    });

    $remove.click(function() {
        var ids = getIdSelections();
        $table.bootstrapTable('remove', {
            field: 'id',
            values: ids
        });
        $remove.prop('disabled', true);
    });
}

$(function() {
    initTable();
    $('#locale').change(initTable);
});
</script>
@endpush
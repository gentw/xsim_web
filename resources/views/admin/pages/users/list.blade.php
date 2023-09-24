@extends('admin.layout.app')

@section('breadcrumb')
{!! Breadcrumbs::render('user') !!}
@endsection

@push('page_title_icon')
<i class="fa fa-users"></i>
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Begin: life time stats -->
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-users font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">Manage Users</span>
                </div>
                <div class="tools">

                </div>
                <div class="actions">
                    @if (in_array('add', $permissions))
                        <a href="{{ route('admin.user.create') }}" data-toggle="tooltip" title="Add User" class="btn btn-circle green"> Add
                            <i class="fa fa-plus"></i>
                        </a>
                        <a href="{{ route('admin.user_age_export') }}" data-toggle="tooltip" title="Export Age Group" class="btn btn-circle blue"> Export Age Group
                            <i class="fa fa-download"></i>
                        </a>
                    @endif
                </div>
            </div>
             @if (in_array('delete', $permissions))
                <a href="{{ route('admin.user.destroy',0) }}" name="del_select" id="del_select" class="btn btn-sm btn-danger delete_all_link">Delete Selected</a>
            @endif
            <div class="portlet-body">
                <div class="table-container">
                    <table class="table table-striped table-bordered table-hover" id="table_DT">
                    </table>
                </div>
            </div>
        </div>
        <!-- End: life time stats -->
    </div>
</div>
@endsection

@push('scripts')

<script type="text/javascript">

    $(function(){
         oTable = $("#table_DT").dataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
                "aria": {
                    "sortAscending": ": click to sort column ascending",
                    "sortDescending": ": click to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total entries)",
                "lengthMenu": "_MENU_ entries",
                "search": "Search:",
                "zeroRecords": "No matching records found",
                "paginate": {
                    "previous": '<i class="fa fa-angle-left" ></i>',
                    "next": '<i class="fa fa-angle-right" ></i>'
                }
            },
            "columns": [
                @if (in_array('delete', $permissions))
                    { "title": "<input type='checkbox' class='all_select'>" ,"data": "checkbox","width":"3%",searchble: false, sortable:false},
                @endif
                { "title": "First Name" ,"data": "firstname"},
                { "title": "Last Name" ,"data": "lastname"},
                { "title": "Email Address" ,"data": "email" },
                { "title": "Contact number" ,"data": "phone" },
                { "title": "Zip Code" ,"data": "zip" },
                @if (in_array('edit', $permissions))
                    { "title": "Status", "data": "active", searchable: false},
                @endif
                @if (in_array('view', $permissions) || in_array('edit', $permissions) || in_array('delete', $permissions))
                    { "title": "Action" ,"data": "action", searchble: false, sortable: false},
                @endif

            ],

            // setup responsive extension: http://datatables.net/extensions/responsive/
            responsive: false,

            //"ordering": false, disable column ordering
            //"paging": false, disable pagination

            "order": [
                @if (in_array('delete', $permissions))
                    [1, 'asc']
                @else
                    [0, 'asc']
                @endif
            ],
            "lengthMenu": [
                [10, 20, 50, 100],
                [10, 20, 50, 100] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,
            "ajax": {
                "url": "{{route('admin.user.listing')}}", // ajax source
            },
            drawCallback: function( oSettings ) {
              $('.status-switch').bootstrapSwitch();
              $('.status-switch').bootstrapSwitch('onColor', 'success');
              $('.status-switch').bootstrapSwitch('offColor', 'danger');
            },
            "dom": "<'row' <'col-md-12'>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable

        });

        // handle datatable custom tools
        $('#sample_3_tools > li > a.tool-action').on('click', function() {
            var action = $(this).attr('data-action');
            oTable.DataTable().button(action).trigger();
        });
    });
</script>

@endpush
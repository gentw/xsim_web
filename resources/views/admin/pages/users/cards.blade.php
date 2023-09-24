@extends('admin.layout.app')

@section('breadcrumb')
{!! Breadcrumbs::render('cards', $user) !!}
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
                    <i class="fa fa-mobile font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">Manage Cards</span>
                </div>
                <div class="tools">

                </div>
                <div class="actions">
                    @if (in_array('add', $permissions))
                        <a href="{{ route('admin.user.card_add', $user->id_user) }}" data-toggle="tooltip" title="Add User" class="btn btn-circle green"> Add
                            <i class="fa fa-plus"></i>
                        </a>
                    @endif
                </div>
            </div>
            {{--
            @if (in_array('delete', $permissions))
                <a href="{{ route('admin.user.destroy',0) }}" name="del_select" id="del_select" class="btn btn-sm btn-danger delete_all_link">Delete Selected</a>
            @endif
            --}}
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
                { "title": "Card number" ,"data": "card_number"},
                { "title": "Balance" ,"data": "balance", searchble: false, sortable:false},
                { "title": "Landline/ National numbers" ,"data": "enum", searchble: false, sortable:false},
                { "title": "Validity" ,"data": "validity", searchble: false, sortable:false},
                @if (in_array('add', $permissions))
                    { "title": "Action" ,"data": "action", searchble: false, sortable: false},
                @endif
            ],

            // setup responsive extension: http://datatables.net/extensions/responsive/
            responsive: false,

            //"ordering": false, disable column ordering
            //"paging": false, disable pagination

            "order": [
                [0, 'asc']
            ],
            "lengthMenu": [
                [10, 20, 50, 100],
                [10, 20, 50, 100] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,
            "ajax": {
                "url": "{{route('admin.user.card_listing', $user->id_user)}}", // ajax source
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

        /**
         * Delete record from database
         */
        $(document).on('click', '.remove-national-number', function(e){
            e.preventDefault();
            var action = $(this).attr('href');
            var enumNumber = $(this).data('enumNumber');
            bootbox.confirm('Are you sure! you want to delete this record?', function(res){
                if(res){
                    $.ajax({
                        url: action,
                        type: 'DELETE',
                        dataType: 'json',
                        beforeSend:addOverlay,
                        data: {
                            _token: $('meta[name="csrf_token"]').attr('content'),
                            enumNumber: enumNumber
                        },
                        success:function(r){
                            showMessage(r.status,r.message);
                            if (typeof oTable.draw !== "undefined")
                            {
                                oTable.draw();
                            }
                            else if (typeof oTable.fnDraw !== "undefined")
                            {
                                oTable.fnDraw();
                            }
                        },
                        complete:removeOverlay
                    });
                }
            });
        });
        $(document).on('click', '.remove-card', function(e){
            e.preventDefault();
            var action = $(this).attr('href');
            bootbox.confirm('Are you sure! you want to delete this record?', function(res){
                if(res){
                    $.ajax({
                        url: action,
                        type: 'POST',
                        beforeSend:addOverlay,
                        data: {
                            _token: $('meta[name="csrf_token"]').attr('content'),
                            _method: "DELETE",
                        },
                        success:function(r){
                            showMessage(r.status,r.message);
                            if (typeof oTable.draw !== "undefined")
                            {
                                oTable.draw();
                            }
                            else if (typeof oTable.fnDraw !== "undefined")
                            {
                                oTable.fnDraw();
                            }
                        },
                        complete:removeOverlay
                    });
                }
            });
        });
    });
</script>

@endpush

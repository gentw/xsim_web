@extends('admin.layout.app')

@section('breadcrumb')
{!! Breadcrumbs::render('add_extra_number', $card) !!}
@endsection

@push('page_title_icon')
<i class="fa fa-users"></i>
@endpush

@push('page_css')
<style type="text/css">
    select{
        text-indent: 28px;
        cursor: pointer;
    }
</style>
@endpush

@section('content')
 <div class="row ">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-mobile font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">Remove National Number</span>
                </div>
            </div>
            <div class="portlet-body">
                <form id="frmRemove" class="form-horizontal" role="form" method="POST" action="{{ route('admin.user.remove_number', $card->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="user_id" value="{{ old('user_id', $card->user->id_user) }}">
                    <input type="hidden" name="type" value="">
                    <input type="hidden" name="national_number" value="">
                    
                    @foreach($national_numbers as $number)
                        <div class="form-group">
                            <label class="col-md-2 control-label">{{ $number }}</label>
                            <div class="col-md-4">
                                <button class="number-remove btn btn-danger" type="button" data-type="{{ $number == $primary_enum ? 'primary' : 'secondary' }}" data-number="{{ $number }}"> Remove </button>
                            </div>
                        </div>
                    @endforeach
                </form>
            </div>
        </div>
        <!-- End: SAMPLE FORM PORTLET -->
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $('.number-remove').click(function(){
        var $this = $(this);
        bootbox.confirm('Are you sure, You want to delete this number ?', function(res){
            if(res){
                $('#frmRemove [name="type"]').val($this.data('type'));
                $('#frmRemove [name="national_number"]').val($this.data('number'));
                $('#frmRemove').submit();
            }
        });
    })
});

</script>
@endpush

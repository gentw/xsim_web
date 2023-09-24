@extends('admin.layout.app')

@section('breadcrumb')
{!! Breadcrumbs::render('edit_validity', $card) !!}
@endsection

@push('page_title_icon')
<i class="fa fa-users"></i>
@endpush

@push('page_css')
<link href="{{ asset('global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
    #validity{
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
                    <span class="caption-subject font-green sbold uppercase">Edit Card Validity</span>
                </div>
            </div>
            <div class="portlet-body">
                <form id="frmstore" class="form-horizontal" role="form" method="POST" action="{{ route('admin.user.update_validity') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="card_number" value="{{ old('card_number', $card->card_number) }}">
                    <div class="form-group{{ $errors->has('validity') ? ' has-error' : '' }}">
                        <label for="validity" class="col-md-2 control-label">Validity{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-calendar"></i>
                                <input type="text" class="form-control" placeholder="Card Validity" value="{{ old('validity', $card->card_validity) }}" readonly name="validity" id="validity" data-error-container="#error-validity">
                                <span id="error-validity"></span>
                                @if ($errors->has('validity'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('validity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn green">Submit</button>
                            <a href="{{route('admin.user.cards', $card->user->id_user)}}" class="btn red">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End: SAMPLE FORM PORTLET -->
    </div>
</div>
@endsection

@push('page_js')
<script src="{{ asset('global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
@endpush

@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $('#validity').datepicker({
        format: 'yyyy-mm-dd'
    });

    $('#frmstore').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        rules: {
            validity: {
                required: true,
            },
        },
        messages: {
            validity: {
                required: "@lang('validation.required', ['attribute'=>'validity'])",
            },
        },

        invalidHandler: function (event, validator) { //display error alert on form submit   
            $('.alert-danger', $('#frmRegister')).show();
            $('#frmRegister').addClass('form-error');
        },

        highlight: function (element) { // hightlight error inputs
            $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },
        success: function (label) {
            label.closest('.form-group').removeClass('has-error');
            label.remove();
        },

        errorPlacement: function (error, element) {
            if (element.attr("data-error-container")) {
                error.appendTo(element.attr("data-error-container"));
            } else {
                error.insertAfter(element);
            }
        },

        submitHandler: function (form) {
            $('#frmRegister').removeClass('form-error');
            form.submit();
        }
    });

    $(document).on('submit','#frmstore',function(){
        if($("#frmstore").valid()){
            return true;
        }else{
            return false;
        }
    });
});

</script>
@endpush

@extends('admin.layout.app')

@section('breadcrumb')
{!! Breadcrumbs::render('add_balance', $card) !!}
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
                    <i class="fa fa-money font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">Add Balance</span>
                </div>
            </div>
            <div class="portlet-body">
                <form id="frmstore" class="form-horizontal" role="form" method="POST" action="{{ route('admin.user.add_card_balance') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="number" value="{{ old('number', $card->card_number) }}">
                    <input type="hidden" name="user_id" value="{{ old('user_id', $card->user->id_user) }}">
                    <div class="form-group{{ $errors->has('balance') ? ' has-error' : '' }}">
                        <label for="balance" class="col-md-2 control-label">Amount{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-user"></i>
                                <select class="form-control" name="balance" id="balance" data-error-container="#error-balance">
                                    <option value="" selected disabled>Select Amount</option>
                                    <option value="10" @if(old('balance') == 10) selected @endif>10</option>
                                    <option value="20" @if(old('balance') == 20) selected @endif>20</option>
                                    <option value="50" @if(old('balance') == 50) selected @endif>50</option>
                                    <option value="100" @if(old('balance') == 100) selected @endif>100</option>
                                    <option value="200" @if(old('balance') == 200) selected @endif>200</option>
                                </select>
                                <span id="error-balance"></span>
                                @if ($errors->has('balance'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('balance') }}</strong>
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

@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
   $('#frmstore').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        rules: {
            balance: {
                required: true,
            },
        },
        messages: {
            balance: {
                required: "@lang('validation.required', ['attribute'=>'amount'])",
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

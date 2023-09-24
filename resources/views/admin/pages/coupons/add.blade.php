@extends('admin.layout.app')

@section('breadcrumb')
{!! Breadcrumbs::render('add_coupon') !!}
@endsection

@push('page_title_icon')
<i class="fa fa-list-ul"></i>
@endpush

@push('page_css')
<link href="{{ asset('global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
    select{
        text-indent: 28px;
        cursor: pointer;
    }
    .form-horizontal .radio, .form-horizontal .radio-inline{
        padding-top: 2px;
    }
    .checkbox-inline, .radio-inline{
        padding-left: 0px;
    }
    .date-picker{
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
                    <i class="fa fa-list-ul font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">Add Coupon</span>
                </div>
            </div>
            <div class="portlet-body">
                <form id="frmCoupon" class="form-horizontal" role="form" method="POST" action="{{ route('admin.coupons.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-2 control-label">Title{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-edit"></i>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" value="{{ old('title','') }}">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>       
                    {{-- Start / End Date --}}
                    <div class="form-group">
                        <label for="name" class="col-md-2 control-label">Avaliblity Date{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <div class="input-group input-large date-picker input-daterange" data-date-format="yyyy-mm-dd" data-date-start-date="+0d" style="width: 100% !important;">
                                    <div class="input-icon">
                                        <i class="fa fa-hourglass-start"></i>
                                        <input type="text" class="form-control" name="start_date" id="start_date" data-date-format="yyyy-mm-dd" placeholder="YYYY - MM - DD" data-error-container="#date-start-error" readonly="readonly">
                                    </div>
                                    <span class="input-group-addon"> To </span>
                                    <div class="input-icon">
                                        <i class="fa fa-hourglass-end"></i>
                                        <input type="text" class="form-control" name="end_date" id="end_date" placeholder="YYYY - MM - DD" data-error-container="#date-end-error" readonly="readonly" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="col-md-6" id="date-start-error"></span>
                                        <span class="col-md-6" id="date-end-error"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="form-group{{ $errors->has('discount') ? ' has-error' : '' }}">
                        <label for="discount" class="col-md-2 control-label">Discount %{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-edit" aria-hidden="true"></i>
                                <input type="text" min="0" max="100"  pattern="\d*" class="form-control" name="discount" id="discount" placeholder="Enter Discount" value="{{ old('discount','') }}">
                                @if ($errors->has('discount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('discount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>   
                    <div class="form-group{{ $errors->has('min_order_amount') ? ' has-error' : '' }}">
                        <label for="min_order_amount" class="col-md-2 control-label">Minimum order amount
                          <button type="button" data-toggle="tooltip" data-placement="top" title="Minimum order amount to apply this coupon." class="tooltip-btn"><i class="fa fa-question-circle" aria-hidden="true"></i></button>
                        </label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-euro"></i>
                                <input type="text" min="0" pattern="\d*" class="form-control" name="min_order_amount" id="min_order_amount" placeholder="Enter Amount" value="{{ old('min_order_amount','') }}">
                                @if ($errors->has('min_order_amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('min_order_amount') }}</strong>
                                    </span>
                                @endif  
                            </div>
                        </div>
                    </div>   
                    <div class="form-group{{ $errors->has('card') ? ' has-error' : '' }}">
                        <label for="card" class="col-md-2 control-label">Select card type
                          <button type="button" data-toggle="tooltip" data-placement="top" title="If selected, discount will be applied to selected cards only." class="tooltip-btn"><i class="fa fa-question-circle" aria-hidden="true"></i></button>
                        </label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-edit"></i>
                                <select class="form-control" name="card" id="card">
                                    <option value="" selected="">Select Card</option>
                                    @foreach($cardtypes as $card)
                                    <option value="{{$card->id}}">{{ $card->type_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('card'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('card') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>   

                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn green">Submit</button>
                            <a href="{{route('admin.coupons.index')}}" class="btn red">Cancel</a>
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
    $('.date-picker').datepicker({
        format: 'yyyy-mm-dd',
    });
    $('#frmCoupon').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        rules: {            
            title: {
                required: true,
            },
        },

        messages: {
            title: {
                required: "@lang('validation.required', ['attribute'=>'title'])",
            },
        },

        invalidHandler: function (event, validator) { //display error alert on form submit   
            $('.alert-danger', $('#frmCoupon')).show();
            $('#frmCoupon').addClass('form-error');
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
            $('#frmCoupon').removeClass('form-error');
            form.submit();
        }
    });

    $(document).on('submit','#frmCoupon',function(){
        if($("#frmCoupon").valid()){
            return true;
        }else{
            return false;
        }
    });
  
});
</script>
@endpush

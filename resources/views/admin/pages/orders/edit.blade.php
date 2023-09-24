@extends('admin.layout.app')

@section('breadcrumb')
{!! Breadcrumbs::render('edit_order', $order) !!}
@endsection

@push('page_title_icon')
<i class="fa fa-shopping-cart"></i>
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
                    <i class="fa fa-shopping-cart font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">Edit Card Order</span>
                </div>
            </div>
            <div class="portlet-body">
                <form id="frmstore" class="form-horizontal" role="form" method="POST" action="{{ route('admin.order.update', $order->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                        <label for="user_id" class="col-md-2 control-label">User</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-user"></i>
                                <input type="text" class="form-control" name="user_id" value="{{ !empty($order->user_id) ? $order->user->contact->firstname . ' ' . $order->user->contact->lastname : 'N/A' }}" disabled>
                                @if ($errors->has('user_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('qty_regular') ? ' has-error' : '' }}">
                        <label for="qty_regular" class="col-md-2 control-label">Regular SIM Quantity</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-cart-arrow-down"></i>
                                <input type="number" class="form-control" name="qty_regular" value="{{$order->qty_regular}}" disabled>
                                @if ($errors->has('qty_regular'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('qty_regular') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('qty_32') ? ' has-error' : '' }}">
                        <label for="qty_32" class="col-md-2 control-label">25% off SIM Quantity</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-cart-arrow-down"></i>
                                <input type="number" class="form-control" name="qty_32" value="{{$order->qty_32}}" disabled>
                                @if ($errors->has('qty_32'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('qty_32') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('qty_50') ? ' has-error' : '' }}">
                        <label for="qty_50" class="col-md-2 control-label">Free SIM Quantity</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-cart-arrow-down"></i>
                                <input type="number" class="form-control" name="qty_50" value="{{$order->qty_50}}" disabled>
                                @if ($errors->has('qty_50'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('qty_50') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        <label for="status" class="col-md-2 control-label">Status{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-search"></i>
                                <select name="status" id="status" class="form-control">
                                    <option value="requested" @if($order->status == "requested") selected @endif>Requested</option>
                                    <option value="processing" @if($order->status == "processing") selected @endif>Processing</option>
                                    <option value="deliveried" @if($order->status == "deliveried") selected @endif>Deliveried</option>
                                </select>
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn green">Submit</button>
                            <a href="{{route('admin.order.index')}}" class="btn red">Cancel</a>
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
            status: {
                required: true,
            },
        },

        messages: {
            status: {
                required: "@lang('validation.required', ['attribute'=>'status'])",
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

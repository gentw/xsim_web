@extends('admin.layout.app')

@section('breadcrumb')
{!! Breadcrumbs::render('edit_number', $number) !!}
@endsection

@push('page_title_icon')
<i class="fa fa-phone"></i>
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
                    <i class="fa fa-phone font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">Edit National number</span>
                </div>
            </div>
            <div class="portlet-body">
                <form id="frmstore" class="form-horizontal" role="form" method="POST" action="{{ route('admin.number.update', $number->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                        <label for="country" class="col-md-2 control-label">Country{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-globe"></i>
                                <input type="text" class="form-control" name="country" id="country" placeholder="Enter Country" maxlength="230" value="{{ old('country', $number->country) }}">
                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                        <label for="number" class="col-md-2 control-label">Number{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-phone"></i>
                                <input type="text" class="form-control" name="number" id="number" placeholder="Enter Number" maxlength="15" value="{{ old('number', $number->number) }}">
                                @if ($errors->has('number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('setup_fee') ? ' has-error' : '' }}">
                        <label for="setup_fee" class="col-md-2 control-label">Setup Fee{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-money"></i>
                                <input type="text" class="form-control" name="setup_fee" id="setup_fee" placeholder="Enter Setup Fee" value="{{ old('setup_fee', $number->setup_fee) }}">
                                @if ($errors->has('setup_fee'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('setup_fee') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('monthly_fee') ? ' has-error' : '' }}">
                        <label for="monthly_fee" class="col-md-2 control-label">Monthly Fee{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-money"></i>
                                <input type="text" class="form-control" name="monthly_fee" id="monthly_fee" placeholder="Enter Monthly Fee" value="{{ old('monthly_fee', $number->monthly_fee) }}">
                                @if ($errors->has('monthly_fee'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('monthly_fee') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('allocated') ? ' has-error' : '' }}">
                        <label for="allocated" class="col-md-2 control-label">Allocated</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-search"></i>
                                <select class="form-control" name="allocated" id="allocated">
                                    <option value="1" @if(old('allocated', $number->allocated) == 1) selected @endif>Yes</option>
                                    <option value="0" @if(old('allocated', $number->allocated) == 0) selected @endif>No</option>
                                </select>
                                @if ($errors->has('allocated'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('allocated') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                        <label for="active" class="col-md-2 control-label">Active</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-search"></i>
                                <select class="form-control" name="active" id="active">
                                    <option value="1" @if(old('active', $number->active) == 1) selected @endif>Yes</option>
                                    <option value="0" @if(old('active', $number->active) == 0) selected @endif>No</option>
                                </select>
                                @if ($errors->has('active'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('active') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn green">Submit</button>
                            <a href="{{route('admin.number.index')}}" class="btn red">Cancel</a>
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
            country: {
                required: true,
                not_empty: true,
            },
            number: {
                required: true,
                digits: true,
                minlength: 5,
                maxlength: 15
            },
            setup_fee: {
                required: true,
                number: true,
                min: 0,
            },
            monthly_fee: {
                required: true,
                number: true,
                min: 0,
            }
        },

        messages: {
            country: {
                required: "@lang('validation.required', ['attribute'=>'country'])",
            },
            number: {
                required: "@lang('validation.required', ['attribute'=>'number'])",
                digits: "@lang('validation.numeric', ['attribute'=>'number'])",
                minlength: "@lang('validation.min.string', ['attribute'=>'number', 'min'=>5])",
                maxlength: "@lang('validation.max.string', ['attribute'=>'number', 'max'=>15])"
            },
            setup_fee: {
                required: "@lang('validation.required', ['attribute'=>'setup fee'])",
                digits: "@lang('validation.numeric', ['attribute'=>'setup fee'])",
            },
            monthly_fee: {
                required: "@lang('validation.required', ['attribute'=>'monthly fee'])",
                digits: "@lang('validation.numeric', ['attribute'=>'monthly fee'])",
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

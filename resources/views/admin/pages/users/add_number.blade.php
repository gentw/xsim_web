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
                    <span class="caption-subject font-green sbold uppercase">Add National Number</span>
                </div>
            </div>
            <div class="portlet-body">
                <form id="frmstore" class="form-horizontal" role="form" method="POST" action="{{ route('admin.user.add_extra_number') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="card_number" value="{{ old('card_number', $card->card_number) }}">
                    <input type="hidden" name="user_id" value="{{ old('user_id', $card->user->id_user) }}">
                    <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                        <label for="country" class="col-md-2 control-label">Country{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-user"></i>
                                <select class="form-control" name="country" id="country" data-error-container="#error-country">
                                    <option value="" selected disabled>Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->country }}" @if(old('country') == $country->country) selected @endif>{{ $country->country }}</option>
                                    @endforeach
                                </select>
                                <span id="error-country"></span>
                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                        <label for="number" class="col-md-2 control-label">National number{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-user"></i>
                                <select class="form-control" name="number" id="number" data-error-container="#error-number">
                                    <option value="" selected disabled>Select a phone number</option>
                                </select>
                                <span id="error-number"></span>
                                @if ($errors->has('number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('number') }}</strong>
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
    $('#country').change(function(){
        var action = "{{ route('admin.get_national_numbers') }}";
        $.ajax({
            url: action,
            type: 'POST',
            dataType: 'json',
            beforeSend: addOverlay,
            data: {
                _token: $('meta[name="csrf_token"]').attr('content'),
                country: $('#country').val(),
            },
            success: function(r){
                if(r.status == 200){
                    $('#number').html(`<option value="" selected disabled>Select a phone number</option>`);
                    for (var i = r.numbers.length - 1; i >= 0; i--) {
                        $('#number').append(`<option value="`+r.numbers[i].number+`">+`+r.numbers[i].number+`</option>`);
                    }
                    $('#number').trigger('change');
                }
                else{
                    showMessage(r.status, r.message);
                }
            },
            complete: removeOverlay
        });
    });

    $('#frmstore').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        rules: {
            country: {
                required: true,
            },
            number: {
                required: true,
            },
        },
        messages: {
            country: {
                required: "@lang('validation.required', ['attribute'=>'country'])",
            },
            number: {
                required: "@lang('validation.required', ['attribute'=>'national number'])",
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

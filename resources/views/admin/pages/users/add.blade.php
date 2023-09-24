@extends('admin.layout.app')

@section('breadcrumb')
{!! Breadcrumbs::render('add_user') !!}
@endsection

@push('page_title_icon')
<i class="fa fa-users"></i>
@endpush

@push('page_css')
<link href="{{ asset('global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
<style type="text/css">
    select{
        text-indent: 28px;
        cursor: pointer;
    }
    #dob{
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
                    <i class="fa fa-user font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">Add User</span>
                </div>
            </div>
            <div class="portlet-body">
                <form id="frmstore" class="form-horizontal" role="form" method="POST" action="{{ route('admin.user.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-2 control-label">Title{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-user"></i>
                                <select class="form-control" name="title" id="title" data-error-container="#error-title">
                                    <option value="" selected disabled>Select Title</option>
                                    <option value="Mr" @if(old('title') == 'Mr') selected @endif>Mr</option>
                                    <option value="Ms" @if(old('title') == 'Ms') selected @endif>Ms</option>
                                    <option value="Mrs" @if(old('title') == 'Mrs') selected @endif>Mrs</option>
                                </select>
                                <span id="error-title"></span>
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-2 control-label">First Name{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-user"></i>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter User Name" maxlength="50" value="{{ old('name','') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                        <label for="surname" class="col-md-2 control-label">Last Name{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-user"></i>
                                <input type="text" class="form-control" name="surname" id="surname" placeholder="Enter User Name" maxlength="50" value="{{ old('surname','') }}">
                                @if ($errors->has('surname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-2 control-label">Email{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-envelope"></i>
                                <input type="email" placeholder="Enter E-mail Address" name="email" id="email" class="form-control" value="{{old('email','')}}" maxlength="150" />
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-2 control-label">Password{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-lock"></i>
                                <input type="password" placeholder="Enter Password" name="password" id="password" class="form-control" value="{{old('password','')}}" maxlength="30" />
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label for="phone" class="col-md-2 control-label">Current Phone Number{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-phone"></i>
                                <input type="text" placeholder="Enter Contact No" name="phone" id="phone" class="form-control" value="{{old('phone','')}}" maxlength="15" />
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                        <label for="mobile" class="col-md-2 control-label">Current Mobile Number{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-mobile"></i>
                                <input type="text" placeholder="Enter Phone No" name="mobile" id="mobile" class="form-control" value="{{old('mobile','')}}" maxlength="15" />
                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                        <label for="dob" class="col-md-2 control-label">Date Of Birth{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-calendar"></i>
                                <input type="text" placeholder="Enter Date Of Birth" name="dob" id="dob" class="form-control" value="{{old('dob','')}}" readonly />
                                @if ($errors->has('dob'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                        <label for="address" class="col-md-2 control-label">Address{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-map-signs"></i>
                                <input type="text" placeholder="Enter Address" name="address" id="address" class="form-control" value="{{old('address','')}}" />
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
                        <label for="zip_code" class="col-md-2 control-label">Zip code</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-street-view"></i>
                                <input type="text" placeholder="Enter Zip Code" name="zip_code" id="zip_code" class="form-control" value="{{old('zip_code','')}}" maxlength="15" />
                                @if ($errors->has('zip_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zip_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                        <label for="city" class="col-md-2 control-label">City{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-location-arrow"></i>
                                <input type="text" placeholder="Enter City" name="city" id="city" class="form-control" value="{{old('city','')}}" />
                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                        <label for="country" class="col-md-2 control-label">Country{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-globe"></i>
                                <select class="form-control" name="country" id="country" data-error-container="#error-country">
                                    <option value="" selected disabled>Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id_country }}" @if(old('country') == $country->id_country) selected @endif>{{ $country->name }}</option>
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
                    <div class="form-group{{ $errors->has('currency') ? ' has-error' : '' }}">
                        <label for="currency" class="col-md-2 control-label">Currency{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-money"></i>
                                <select class="form-control" name="currency" id="currency" data-error-container="#error-currency">
                                    <option value="" selected disabled>Select Currency</option>
                                    <!-- <option>USD</option> -->
                                    <option value="EUR" @if(old('currency') == 'EUR') selected @endif>EUR</option>
                                </select>
                                <span id="error-currency"></span>
                                @if ($errors->has('currency'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('currency') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('document') ? ' has-error' : '' }}">
                        <label for="document" class="col-md-2 control-label">Type of document{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-book"></i>
                                <select class="form-control" name="document" id="document" data-error-container="#error-document">
                                    <option value="" selected disabled>Select Type of Document</option>
                                    <option value="passport" @if(old('document') == 'passport') selected @endif>Passport</option>
                                    <option value="id" @if(old('document') == 'id') selected @endif>ID</option>
                                </select>
                                <span id="error-document"></span>
                                @if ($errors->has('document'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('document') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('document_no') ? ' has-error' : '' }}">
                        <label for="document_no" class="col-md-2 control-label">Document Number{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-credit-card"></i>
                                <input type="text" placeholder="Enter Document No" name="document_no" id="document_no" class="form-control" value="{{old('document_no','')}}" maxlength="15" />
                                @if ($errors->has('document_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('document_no') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
                        <label for="company" class="col-md-2 control-label">Company{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-building"></i>
                                <input type="text" placeholder="Enter Company" name="company" id="company" class="form-control" value="{{old('company','')}}"/>
                                @if ($errors->has('company'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn green">Submit</button>
                            <a href="{{route('admin.user.index')}}" class="btn red">Cancel</a>
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
    $('#dob').datepicker({
        format: 'yyyy-mm-dd',
        endDate: '0d'
    });

    $('#frmstore').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        rules: {
            title: {
                required: true,
            },
            address: {
                required: true,
                not_empty: true,
            },
            name: {
                required: true,
                not_empty: true,
            },
            zip_code: {
                minlength: 4,
                digits: true,
            },
            surname: {
                required: true,
                not_empty: true,
            },
            city: {
                required: true,
                not_empty: true,
            },
            dob: {
                required: true,
            },
            country: {
                required: true,
            },
            currency: {
                required: true,
            },
            document: {
                required: true,
            },
            document_no: {
                required: true,
                not_empty: true,
            },
            phone: {
                required: true,
                digits: true,
                minlength: 5,
                maxlength: 15
            },
            mobile: {
                required: true,
                digits: true,
                minlength: 5,
                maxlength: 15
            },
            company: {
                required: true,
                not_empty: true,
            },
            email: {
                required: true,
                valid_email: true,
                remote: {
                    url: "{{ route('admin.uniqueemail') }}",
                    type: "post",
                    data: {
                        _token: function() {
                            return "{{csrf_token()}}"
                        },
                        email: function(){
                            return $("#email").val();
                        }
                    }
                },
            },
            password: {
                required: true,
                minlength:6,
                no_space: true
            },
            password_confirmation:{
                required:true,
                minlength:6,
                no_space:true,
                equalTo:"#password"
            },
            accept_email: {
                required: true,
            },
            accept_terms: {
                required: true,
            },
        },

        messages: {
            title: {
                required: "@lang('validation.required', ['attribute'=>'title'])",
            },
            address: {
                required: "@lang('validation.required', ['attribute'=>'address'])",
            },
            name: {
                required: "@lang('validation.required', ['attribute'=>'name'])",
            },
            zip_code: {
                required: "@lang('validation.required', ['attribute'=>'zip code'])",
                digits: "@lang('validation.numeric', ['attribute'=>'zip code'])",
            },
            surname: {
                required: "@lang('validation.required', ['attribute'=>'surname'])",
            },
            city: {
                required: "@lang('validation.required', ['attribute'=>'city'])",
            },
            dob: {
                required: "@lang('validation.required', ['attribute'=>'date of birth'])",
            },
            country: {
                required: "@lang('validation.required', ['attribute'=>'country'])",
            },
            currency: {
                required: "@lang('validation.required', ['attribute'=>'currency'])",
            },
            document: {
                required: "@lang('validation.required', ['attribute'=>'document'])",
            },
            document_no: {
                required: "@lang('validation.required', ['attribute'=>'document number'])",
            },
            phone: {
                required: "@lang('validation.required', ['attribute'=>'phone'])",
                digits: "@lang('validation.numeric', ['attribute'=>'phone'])",
                minlength: "@lang('validation.min.string', ['attribute'=>'phone', 'min'=>5])",
                maxlength: "@lang('validation.max.string', ['attribute'=>'phone', 'max'=>15])"
            },
            mobile: {
                required: "@lang('validation.required', ['attribute'=>'mobile'])",
                digits: "@lang('validation.numeric', ['attribute'=>'mobile'])",
                minlength: "@lang('validation.min.string', ['attribute'=>'mobile', 'min'=>5])",
                maxlength: "@lang('validation.max.string', ['attribute'=>'mobile', 'max'=>15])"
            },
            company: {
                required: "@lang('validation.required', ['attribute'=>'company'])",
            },
            email: {
                required: "@lang('validation.required', ['attribute'=>'email'])",
                email:"@lang('validation.email', ['attribute'=>'email'])",
                remote:"@lang('validation.unique',['attribute'=>'email'])",
            },
            password: {
                required: "@lang('validation.required', ['attribute'=>'password'])",
                minlength: "@lang('validation.min.string', ['attribute'=>'password', 'min'=>6])"
            },
            password_confirmation:{
                required:"@lang('validation.required', ['attribute'=>'confirm password'])",
                minlength: "@lang('validation.min.string', ['attribute'=>'confirm password', 'min'=>6])",
                equalTo:"@lang('validation.same', ['attribute'=>'confirm password', 'other'=>'password'])"
            },
            accept_email: {
                required: "@lang('validation.accepted', ['attribute'=>'periodic emails'])",
            },
            accept_terms: {
                required: "@lang('validation.accepted', ['attribute'=>'general conditions'])",
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

@extends('layouts.dashboard')

@push('page_css')
<link href="{{ asset('global/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div id="page-content-wrapper" class="account-settings-page dashboard-advanced-section">
    <div class="container-fluid">
        <div class="text-center">
            <h3>Account Settings</h3>
        </div>
        <div class="row account-settings-inner form-step">
            <form action="{{ route('edit_profile') }}" method="post" id="frm-profile" role="form">
                <div class="col-md-6">
                    {{ csrf_field() }}
                    <input type="hidden" name="advance_view" value="{{ $advance_view }}">
                    <div class="form-group">
                        <label>Title</label>
                        <select name="title" id="title" class="custom disable" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' data-error-container="#error-title" >
                            <option value="" class="hideme">Title</option>
                            <option value="Mr" @if(old('title', $user->contact->title) == 'Mr') selected @endif>Mr</option>
                            <option value="Ms" @if(old('title', $user->contact->title) == 'Ms') selected @endif>Ms</option>
                            <option value="Mrs" @if(old('title', $user->contact->title) == 'Mrs') selected @endif>Mrs</option>
                        </select>
                        <span id="error-title"></span>
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="name" id="name" class="form-control disable" value="{{ old('name', $user->contact->firstname) }}" placeholder="Enter First Name">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="surname" id="surname" class="form-control disable" value="{{ old('surname', $user->contact->lastname) }}" placeholder="Enter Last Name">
                        @if ($errors->has('surname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('surname') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Date of birth</label>
                        <input type="text" name="dob" id="dob" class="form-control disable" value="{{ old('dob', date('Y-m-d', strtotime($user->birthsdate))) }}" placeholder="Enter Birthdate">
                        @if ($errors->has('dob'))
                            <span class="help-block">
                                <strong>{{ $errors->first('dob') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Mobile number</label>
                        <input type="text" name="mobile" id="mobile" class="form-control disable" value="{{ old('mobile', $user->contact->mobile) }}" placeholder="Enter Mobile Number">
                        @if ($errors->has('mobile'))
                            <span class="help-block">
                                <strong>{{ $errors->first('mobile') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Company</label>
                        <input type="text" name="company" id="company" class="form-control disable" value="{{ old('company', $user->contact->business_name) }}" placeholder="Enter Company Name">
                        @if ($errors->has('company'))
                            <span class="help-block">
                                <strong>{{ $errors->first('company') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="address" id="address" class="form-control disable" value="{{ old('address', $user->contact->address) }}" placeholder="Enter Address">
                        @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Zip Code</label>
                        <input type="text" name="zip_code" id="zip_code" class="form-control disable" value="{{ old('zip', $user->contact->zip) }}" placeholder="Enter Zip Code">
                        @if ($errors->has('zip_code'))
                            <span class="help-block">
                                <strong>{{ $errors->first('zip_code') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" id="city" class="form-control disable" value="{{ old('city', $user->contact->city) }}" placeholder="Enter City">
                        @if ($errors->has('city'))
                            <span class="help-block">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Country</label>
                        <select class="custom disable" name="country" id="country" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' data-error-container="#error-country">
                            <option value="" class="hideme">Country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id_country }}" @if(old('country', $user->contact->key_country) == $country->id_country) selected @endif>{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('country'))
                            <span class="help-block">
                                <strong>{{ $errors->first('country') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control disable" value="{{ old('phone', $user->contact->phone) }}" placeholder="Enter Phone">
                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>                    
                </div>
                <div class="clearfix"></div>
                <h3 class="text-center space-below">Change Password</h3>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control disable" value="{{ old('email', $user->username) }}" placeholder="Enter Email Address">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" id="password" class="form-control disable" placeholder="Enter Password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control disable" placeholder="Enter Confirm Password">
                        @if ($errors->has('confirm_password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('confirm_password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="clearfix"></div>
                <button type="submit" class="btn simple-btn yellow disable" id="btn-save">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('page_js')
<script src="{{ asset('global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
@endpush

@push('scripts')
<script type="text/javascript">
    /**
     * call forwading validation rules
     */
    $('#dob').datepicker({
        format: 'yyyy-mm-dd',
        endDate: '0d'
    });

    $('#frm-profile').validate({
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
                // required: true,
                // not_empty: true,
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
                    url: "{{ route('uniqueemailothers') }}",
                    type: "post",
                    data: {
                        _token: function() {
                            return "{{csrf_token()}}"
                        },
                        email: function(){
                            return $("#email").val();
                        },
                        id: function(){
                            return "{{ Auth::id() }}";
                        }
                    }
                },
            },
            password: {
                required: function(){
                    return $('#email').val() != "{{ Auth::user()->username }}";
                },
                minlength:6,
                no_space: true
            },
            confirm_password:{
                required: function(){
                    return $('#email').val() != "{{ Auth::user()->username }}";
                },
                equalTo: '#password'
            }
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
                    required: "The Password field is required if email is changed.",
                    minlength: "@lang('validation.min.string', ['attribute'=>'password', 'min'=>6])"
                },
                confirm_password:{
                    required: "The Confirm password field is required if email changed.",
                    equalTo: "The password confirmation does not match."
                }
        },
        errorClass: 'help-block',
        errorElement: 'span',
        invalidHandler: function (event, validator) { //display error alert on form submit   
            $('#frm-profile').addClass('form-error');
            $('.alert-danger', $('#frm-profile')).show();
        },
        highlight: function (element) {
            $('#frm-profile').addClass('form-error');
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
           $(element).closest('.form-group').removeClass('has-error');
        },
        errorPlacement: function (error, element) {
            if (element.attr("data-error-container")) {
                error.appendTo(element.attr("data-error-container"));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            $('#frm-profile').removeClass('form-error');
            form.submit();
        }
    });

    /**
     * Check validation on submit of call forwading form
     */
    $("#frm-profile").submit(function(){
        if($(this).valid()){
            if($('#name').val() == '' && $('#email').val() == '' && $('#password').val() == ''){
                showMessage(412, 'Nothing to update');
                return false;
            }
            else{
                return true;
            }
        }
        else{
            return false;
        }
    });
</script>
@endpush
@extends('layouts.app')

@section('content')
<main>
    <section class="register-section">
        <div class="container">
            <div class="register-form text-center">
                <h2>Register Your Account</h2>
                <!-- <p>Fill out the form here below and a sales person will contact you</p> -->
                <form class="login-form {{ $errors->isEmpty() ? '' : 'form-error' }}" id="frmRegister" role="form" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <select name="title" id="title" class="custom" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' data-error-container="#error-title" >
                            <option value="" class="hideme">Title</option>
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
                    <div class="form-group">
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', '') }}" placeholder="Name">
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" name="surname" id="surname" class="form-control" value="{{ old('surname', '') }}" placeholder="Surname">
                        @if ($errors->has('surname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('surname') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group" id='date-birth'>
                            <input type="text" name="dob" id="dob" class="form-control" value="{{ old('dob', '') }}" placeholder="Date of birth (DD/MM/YYYY)">
                        @if ($errors->has('dob'))
                            <span class="help-block">
                                <strong>{{ $errors->first('dob') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" name="address" id="address" class="form-control" value="{{ old('address', '') }}" placeholder="Address">
                        @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" name="zip_code" id="zip_code" class="form-control" value="{{ old('zip_code', '') }}" placeholder="ZIP Code">
                        @if ($errors->has('zip_code'))
                            <span class="help-block">
                                <strong>{{ $errors->first('zip_code') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <input type="text" name="city" id="city" class="form-control" value="{{ old('city', '') }}" placeholder="City">
                        @if ($errors->has('city'))
                            <span class="help-block">
                                <strong>{{ $errors->first('city') }}</strong>
                            </span>
                        @endif
                    </div>
                     <div class="form-group">
                        <select class="custom" name="country" id="country" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' data-error-container="#error-country">
                            <option value="" class="hideme">Country</option>
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
                    <div class="form-group">
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email', '') }}" placeholder="Email">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <!-- <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">+</span>
                            <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', '') }}" data-error-container="#error-phone" placeholder="Current Phone Number">
                        </div> -->
                        <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone', '') }}" data-error-container="#error-phone" placeholder="Current Landline Phone Number">
                        <span id="error-phone"></span>
                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                       <!--  <div class="input-group">
                            <span class="input-group-addon" id="basic-addon1">+</span>
                            <input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile', '') }}" placeholder="Current Mobile Phone" data-error-container="#error-mobile" aria-describedby="basic-addon1">
                        </div>     -->          
                        <input type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile', '') }}" placeholder="Current Mobile Phone" data-error-container="#error-mobile" aria-describedby="basic-addon1">        
                        <span id="error-mobile"></span>  
                        @if ($errors->has('mobile'))
                            <span class="help-block">
                                <strong>{{ $errors->first('mobile') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group light">
                        International format (not your XXSIM#) <br> Ex: 00417812345678
                    </div>
                    
                    <div class="form-group">
                        <select class="custom" name="currency" id="currency" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' data-error-container="#error-currency">
                            <option value="" class="hideme">Currency</option>
                            <!-- <option>USD</option> -->
                            <option value="EUR" @if(old('currency') == 'EUR') selected @endif>EUR</option>
                        </select>
                        <span id="error-currency"></span>
                        @if ($errors->has('country'))
                            <span class="help-block">
                                <strong>{{ $errors->first('country') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <select class="custom" name="document" id="document" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' data-error-container="#error-document">
                            <option value="" class="hideme">Type of Document</option>
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
                    <div class="form-group">
                        <input type="text" class="form-control" name="document_no" id="document_no" value="{{ old('document_no', '') }}" placeholder="Document #">
                        @if ($errors->has('document_no'))
                            <span class="help-block">
                                <strong>{{ $errors->first('document_no') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" name="company" id="company" class="form-control" value="{{ old('company', '') }}" placeholder="Company (optional)">
                        @if ($errors->has('company'))
                            <span class="help-block">
                                <strong>{{ $errors->first('company') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control" value="{{ old('password', '') }}" placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="{{ old('password_confirmation', '') }}" placeholder="Confirm Password">
                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <div class="row checkbox-area">
                        <div class="col-sm-8 text-left">
                            <!-- <div class="check-box">
                                <label for="chk1">I accept periodic emails that inform me of news at XXSIM</label>
                                <input type="checkbox" name="accept_email" id="chk_email" data-error-container="#error-accept-email" />
                            </div> -->
                            <span id="error-accept-email"></span>
                            <div class="check-box">
                                <label for="chk2">I have read and accept the <a href="{{ route('general_sales') }}">general conditions of sale</a></label>
                                <input type="checkbox" name="accept_terms" id="chk_terms" data-error-container="#error-accept-terms" />
                            </div>
                            <span id="error-accept-terms"></span>
                        </div>
                        <div class="col-sm-4 text-right top-space">
                            <button type="submit" class="rounded-btn">Register</button>
                        </div>
                    </div>
                    <!-- <button type="submit" class="theme-btn">Register</button> -->
                </form>
            </div>
        </div>
    </section>
</main>
@endsection

@push('scripts')
<script type="text/javascript">
    $(function(){

        // $('#date-birth').datetimepicker({
        //         format: 'YYYY-MM-DD',
        //         allowInputToggle: true
        // });
        // 
        var today = new Date();
        var today = today.getFullYear() + '-' + ("0" + (today.getMonth()+1)).slice(-2) + '-' + ("0" + today.getDate()).slice(-2);
        $('#dob').datetextentry({
            field_order : 'DMY',
            separator : '/',
            E_MAX_DATE : 'Date must not be later than ' + today,
            max_date : today,
            show_tooltips: false,
        });

        $('#frmRegister').validate({
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
                /*zip_code: {
                    required: true,
                    not_empty: true,
                    digits: true,
                },*/
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
                /*company: {
                    required: true,
                    not_empty: true,
                },*/
                email: {
                    required: true,
                    valid_email: true,
                    remote: {
                        url: "{{ route('uniqueemail') }}",
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
                /*zip_code: {
                    required: "@lang('validation.required', ['attribute'=>'zip code'])",
                    digits: "@lang('validation.numeric', ['attribute'=>'zip code'])",
                },*/
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
                // company: {
                //     required: "@lang('validation.required', ['attribute'=>'company'])",
                // },
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
                $('#frmRegister').addClass('form-error');
                $(element).closest('.form-group').addClass('has-error'); // set error class to the control group
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
                if($('#dob').val() == ''){
                    showMessage(212, 'Please provide a proper date');
                    return false;
                }
                else{
                    $('#frmRegister').removeClass('form-error');
                    form.submit();
                }
            }
        });
    });
</script>
@endpush

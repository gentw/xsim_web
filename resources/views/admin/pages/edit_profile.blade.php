@extends('admin.layout.app')

@section('breadcrumb')
{!! Breadcrumbs::render('my_profile') !!}
@endsection

@push('page_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/profile.css') }}">
@endpush

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet bordered">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="{{ checkImage(2,$user->profile_image) }}" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> {{$user->name}} </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
            </div>
            <!-- END PORTLET MAIN -->
        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light bordered">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->
                                <div class="tab-pane active" id="tab_1_1">
                                    <form role="form" id="frmProfile" method="POST" action="{{ route('admin.profile.edit') }}" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label class="control-label">{!! $mend_sign !!}Name</label>
                                            <div class="input-icon">
                                                <i class="fa fa-font"></i>
                                                <input type="text" placeholder="Enter Name" name="name" id="name" class="form-control" value="{{old('name',$user->name)}}" maxlength="50" /> 
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label class="control-label">{!! $mend_sign !!}Email</label>
                                            <div class="input-icon">
                                                <i class="fa fa-envelope"></i>
                                                <input type="email" placeholder="Enter E-mail Address" name="email" id="email" class="form-control" value="{{old('email',$user->email)}}" maxlength="150" /> 
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('contact_no') ? ' has-error' : '' }}">
                                            <label class="control-label">{!! $mend_sign !!}Contact Number</label>
                                            <div class="input-icon">
                                                <i class="fa fa-phone"></i>
                                                <input type="text" placeholder="Enter Contact No" name="contact_no" id="contact_no" class="form-control" value="{{old('contact_no',$user->contact_no)}}" maxlength="10" /> 
                                                @if ($errors->has('contact_no'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('contact_no') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('profile_photo') ? ' has-error' : '' }}">
                                            <label class="control-label">Profile Picture</label>
                                            <div class="input-icon">
                                                <i class="fa fa-upload"></i>
                                                <input type="file" name="profile_photo" id="profile_photo" class="form-control" /> 
                                                @if ($errors->has('profile_photo'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('profile_photo') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <label for="password" class="control-label">{!! $mend_sign !!}Password Verification</label>
                                            <div class="input-icon">
                                                <i class="fa fa-lock"></i>
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Password Verification"> 
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="margiv-top-10">
                                            <button type="submit" class="btn green"> Save Changes </button>
                                        </div>
                                    </form>
                                </div>
                                <!-- END PERSONAL INFO TAB -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PROFILE CONTENT -->
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('admin/js/jquery.sparkline.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('admin/js/profile.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">

    $(function(){
        $('#frmProfile').validate({
            errorElement: 'span',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                name:{
                    required:true,
                    not_empty:true,
                    maxlength:50
                },
                email:{
                    required:true,
                    valid_email:true,
                    /*remote: {
                        url: "{{ route('admin.uniqueAdminemail') }}",
                        type: "post",
                        data: {
                            _token: function() {
                                return "{{csrf_token()}}"
                            },
                            email: function(){
                                return $("#email").val();
                            },
                            id: function(){
                                return {{$user->id}}
                            }
                        }
                    },*/
                    maxlength:150,
                },
                contact_no:{
                    required:true,
                    digits:true,
                    minlength:10,
                    maxlength:10
                },
                profile_photo:{
                    extension:'jpg|png|jpeg'
                },
                password:{
                    required: true,
                    minlength:6,
                    remote: {
                        url: "{{ route('admin.checkoldpass') }}",
                        type: "post",
                        data: {
                            _token: "{{ csrf_token()}}",
                            current_password: function() {
                                return $( "#password" ).val();
                            },
                            email: "{{ $user->email }}",
                        }
                    }
                }
            },
            messages: {
                name:{
                    required:"@lang('validation.required',['attribute'=>'name'])",
                    maxlength:50
                },
                email:{
                    required:"@lang('validation.required',['attribute'=>'email'])",
                    email: "@lang('validation.email', ['attribute'=>'email address'])",
                    pattern: "@lang('validation.email', ['attribute'=>'email address'])",
                    remote:"@lang('validation.exists',['attribute'=>'email'])",
                    maxlength:"@lang('validation.max.string',['attribute'=>'email','max'=>150])"
                },
                contact_no:{
                    required:"@lang('validation.required',['attribute'=>'contact number'])",
                    minlength:"@lang('validation.min.string',['attribute'=>'contact number','min'=>10])",
                    maxlength:"@lang('validation.max.string',['attribute'=>'contact number','max'=>14])"
                },
                profile_photo:{
                    extension:"@lang('validation.mimetypes',['attribute'=>'profile photo','value'=>'jpg|png|jpeg'])"
                },
                password: {
                    required: "@lang('validation.required', ['attribute'=>'password'])",
                    minlength: "@lang('validation.min.string', ['attribute'=>'password', 'min'=>6])",
                    remote: "@lang('validation.not_match', ['attribute'=>'password'])",
                },
            },
            errorClass: 'help-block',
            errorElement: 'span',
            highlight: function (element) {
               $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element) {
               $(element).closest('.form-group').removeClass('has-error');
            },
            errorPlacement: function (error, element) {
                if (element.attr("type") == "radio") {
                      error.appendTo('.a');
                }else{
                    if (element.attr("data-error-container")) {
                        error.appendTo(element.attr("data-error-container"));
                    } else {
                        error.insertAfter(element);
                    }
                }
            }
        });
        $(document).on('submit','#frmProfile',function(){
        if($("#frmProfile").valid()){
            return true;
        }else{
            return false;
        }
    }); 
    });
</script>
@endpush
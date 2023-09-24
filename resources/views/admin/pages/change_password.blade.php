@extends('admin.layout.app')

@section('breadcrumb')
{!! Breadcrumbs::render('change_pass') !!}
@endsection

@section('content')
 <div class="row ">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-lock font-green"></i>
                    <span class="caption-subject font-green bold uppercase">Change Password</span>
                </div>
                {{-- <div class="actions">
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-cloud-upload"></i>
                    </a>
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-wrench"></i>
                    </a>
                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                        <i class="icon-trash"></i>
                    </a>
                </div> --}}
            </div>
            <div class="portlet-body">
                <form class="form-horizontal" id="frmChange" role="form" method="POST" action="{{ route('admin.changepass') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                        <label for="current_password" class="col-md-2 control-label">Current Password</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-lock"></i>
                                <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Current Password"> 
                                @if ($errors->has('current_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-2 control-label">New Password</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-lock"></i>
                                <input type="password" class="form-control" name="password" id="password" placeholder="New Password"> 
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password_confirmation" class="col-md-2 control-label">Confirm Password</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-lock"></i>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password"> 
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn green">Submit</button>
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
    $(function(){
        $('#frmChange').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                current_password: {
                    required: true,
                    minlength:6,
                    remote: {
                        url: "{{ route('admin.checkoldpass') }}",
                        type: "post",
                        data: {
                            _token: "{{ csrf_token()}}",
                            current_password: function() {
                                return $( "#current_password" ).val();
                            },
                            email: "{{ Auth::user()->email }}",
                        }
                    }
                },
                password: {
                    required: true,
                    minlength:6,
                    no_space: true
                },
                password_confirmation: {
                    required:true,
                    minlength:6,
                    no_space: true,
                    equalTo: '#password'
                }
            },

            messages: {
                current_password: {
                    required: "@lang('validation.required', ['attribute'=>'current password'])",
                    minlength: "@lang('validation.min.string', ['attribute'=>'current password', 'min'=>6])",
                    remote: "@lang('validation.not_match', ['attribute'=>'current password'])",
                },
                password: {
                    required: "@lang('validation.required', ['attribute'=>'password'])",
                    minlength: "@lang('validation.min.string', ['attribute'=>'password', 'min'=>6])"
                },
                password_confirmation: {
                    required: "@lang('validation.required', ['attribute'=>'confirm password'])",
                    minlength: "@lang('validation.min.string', ['attribute'=>'confirm password', 'min'=>6])",
                    equalTo: "@lang('validation.confirmed', ['attribute'=>'password'])"
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('.alert-danger', $('.login-form')).show();
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
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function (form) {
                form.submit();
            }
        }); 
    });
</script>
@endpush
@extends('admin.layout.app')

@section('breadcrumb')
{!! Breadcrumbs::render('edit_press', $press) !!}
@endsection

@push('page_title_icon')
<i class="fa fa-list-ul"></i>
@endpush

@push('page_css')
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
                    <span class="caption-subject font-green sbold uppercase">Edit Press</span>
                </div>
            </div>
            <div class="portlet-body">
                <form id="frmPress" class="form-horizontal" role="form" method="POST" action="{{ route('admin.presses.update', $press->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                        <label for="type" class="col-md-2 control-label">Type{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <label class="radio-inline"><input type="radio" data-error-container="#error-type" name="type" id="type"  value="press" @if(old('type', $press->type) == "press") checked @endif >Press</label>
                            <label class="radio-inline"><input type="radio" data-error-container="#error-type" name="type" id="type" value="television" @if(old('type', $press->type) == "television") checked @endif>Television</label>
                            <span id="error-type"></span>
                            @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
                        <label for="language" class="col-md-2 control-label">language{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-globe"></i>
                                <select type="text" class="form-control" name="language" id="language">
                                    <option value="french" @if(old('language', $press->language) == "french") selected @endif>French</option>
                                    <option value="german" @if(old('language', $press->language) == "german") selected @endif>German</option>
                                    <option value="english" @if(old('language', $press->language) == "english") selected @endif>English</option>
                                    <option value="italian" @if(old('language', $press->language) == "italian") selected @endif>Italian</option>
                                </select>
                                @if ($errors->has('language'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('language') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-2 control-label">Title{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-edit"></i>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" value="{{ old('title', $press->title) }}">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Press</label>
                        <div class="col-md-4">
                            <a href="{{ $press->link }}" target="_blank">{{ $press->link }}</a>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group{{ $errors->has('file_type') ? ' has-error' : '' }}">
                        <label for="file_type" class="col-md-2 control-label">File Type</label>
                        <div class="col-md-4">
                            <label class="radio-inline"><input type="radio" name="file_type" value="link" checked>Link</label>
                            <label class="radio-inline"><input type="radio" name="file_type" value="file" >File</label>
                            @if ($errors->has('file_type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('file_type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                        <label for="link" class="col-md-2 control-label">Link</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-external-link"></i>
                                <input type="text" class="form-control" name="link" id="link" placeholder="Enter Link" value="{{ old('link','') }}">
                                @if ($errors->has('link'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                        <label for="file" class="col-md-2 control-label">File{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-upload"></i>
                                <input type="file" class="form-control" name="file" id="file" placeholder="Upload File" value="{{ old('file','') }}">
                                @if ($errors->has('file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('file') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn green">Submit</button>
                            <a href="{{route('admin.presses.index')}}" class="btn red">Cancel</a>
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
    $('#file').closest('.form-group').hide();
    $('#frmPress').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        rules: {
            type: {
                required: true,
            },
            language: {
                required: true,
            },
            title: {
                required: true,
            },
            file:{
                extension: 'pdf|jpg|png|jpeg'
            },
        },

        messages: {
            type: {
                required: "@lang('validation.required', ['attribute'=>'type'])",
            },
            language: {
                required: "@lang('validation.required', ['attribute'=>'language'])",
            },
            title: {
                required: "@lang('validation.required', ['attribute'=>'title'])",
            },
            file: {
                required: "@lang('validation.required', ['attribute'=>'file'])",
                extension: "The file must be a pdf or image.",
            },
            link: {
                required: "@lang('validation.required', ['attribute'=>'link'])",
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

    $(document).on('submit','#frmPress',function(){
        if($("#frmPress").valid()){
            return true;
        }else{
            return false;
        }
    });

    $('input[name="file_type"]').change(function() {
        if($(this).val() == 'file') {
            $('#file').closest('.form-group').show();
            $('#link').closest('.form-group').hide();
        }else{
            $('#link').closest('.form-group').show();
            $('#file').closest('.form-group').hide();
        }
    })
});
</script>
@endpush

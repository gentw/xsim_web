@extends('admin.layout.app')

@section('breadcrumb')
{!! Breadcrumbs::render('edit_content', $content) !!}
@endsection

@push('page_title_icon')
<i class="fa fa-file-text"></i>
@endpush

@section('content')
 <div class="row ">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-file-text font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">Edit Content Page</span>
                </div>
            </div>
            <div class="portlet-body">
                <form id="frmstore" class="form-horizontal" role="form" method="POST" action="{{ route('admin.content.update', $content->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-2 control-label">Page Name</label>
                        <div class="col-md-9">
                            <div class="input-icon">
                                <i class="fa fa-file"></i>
                                <input type="text" class="form-control" disabled name="name" id="name" placeholder="Enter Page Name" maxlength="230" value="{{ old('name', $content->name) }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                        <label for="content" class="col-md-2 control-label">Page Content</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="content" id="content" placeholder="Enter Page Content">{{ old('content', $content->content) }}</textarea>
                            @if ($errors->has('content'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn green">Submit</button>
                            <a href="{{route('admin.content.index')}}" class="btn red">Cancel</a>
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
<script src="{{ asset('admin/plugins/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
@endpush

@push('scripts')
<script type="text/javascript">
$(document).ready(function() {

    $('#frmstore').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        rules: {
            content: {
                required: true,
            }
        },

        messages: {
            content: {
                required: "@lang('validation.required', ['attribute'=>'page content'])",
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

    CKEDITOR.replace("content", {filebrowserUploadUrl: "{{ route('admin.upload_ck') }}" });
    // {{-- {filebrowserUploadUrl: '<?php //echo base_url("admin/offers/upload_ck_file"); ?>'} --}}
});

</script>
@endpush

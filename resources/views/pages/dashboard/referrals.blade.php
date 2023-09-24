@extends('layouts.dashboard')

@section('content')
<div id="page-content-wrapper">
    <div class="referrals-section">
        <h1>Refer a friend!</h1>
        <p>Fill out the form here below and a sales person will contact you immediately</p>
        <form action="javascript:;" id="frm-referal">
            <div class="submit-box">
                <input type="email" name="email" class="form-control" placeholder="Enter the email">
                <button type="submit" class="simple-btn">submit</button>
            </div>
        </form> 
        <div class="clearfix"></div>
        <ul class="referrals-list">
            <li class="title"><h2>referrals <span>status</span></h2></li>
            @forelse($refers as $refer)
                <li>{{ $refer['email'] }}<span>{{ $refer['sign_up_status'] == 'y' ? 'Signed Up' : 'Not Sign Up' }}</span></li>
            @empty
                <li>No Referrals found</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $('#frm-referal').validate({
        rules: {
            email:{
                required: true,
                valid_email: true,
            },
        },
        messages: {
            email:{
                required:"@lang('validation.required',['attribute'=>'email'])",
            },
        },
        errorClass: 'help-block',
        errorElement: 'span',
        invalidHandler: function (event, validator) { 
            $('#frm-referal').addClass('form-error');
            $('.alert-danger', $('#frm-referal')).show();
        },
        highlight: function (element) {
            $('#frm-referal').addClass('form-error');
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
            $('#frm-referal').removeClass('form-error');
            form.submit();
        }
    });

    $("#frm-referal").submit(function(){
        if($(this).valid()){
            var email = $("#frm-referal input[name='email']").val();
            var action = "{{ route('action_referal') }}";
            $.ajax({
                url: action,
                type: 'POST',
                dataType: 'json',
                beforeSend:addOverlay,
                data: {
                    _token: $('meta[name="csrf_token"]').attr('content'),
                    email: email
                },
                success: function(r){
                    showMessage(r.status, r.message);
                    if(r.status == 200){
                        if($("ul.referrals-list").html().trim() == "<li>No Referrals found</li>"){
                            $("ul.referrals-list").html('');
                        }
                        $("ul.referrals-list").append(`<li>`+ email +`<span>Not Sign Up</span></li>`);
                    }
                },
                complete:removeOverlay
            });
        }
        else{
            return false;
        }
    });
</script>
@endpush
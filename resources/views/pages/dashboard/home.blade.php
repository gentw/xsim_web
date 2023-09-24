@extends('layouts.dashboard')

@push('page_css')
<!-- Custom CSS -->
    <link href="{{ asset('dashboard/css/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endpush

@push('page_js')
 <!-- Extra Javascript -->
    <script src="{{ asset('dashboard/js/jquery.mCustomScrollbar.concat.min.js') }}" type="text/javascript"></script>
@endpush

@section('content')
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="common-number-section">
            <div class="text-left">
                <select id="change-card" name="card_number" class="custom select2 jcf-ignore" data-error-container="#error-card-number" >
                    {{-- data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' --}}
                    @forelse(Auth::user()->cards as $card)
                        <option data-validity="{{ $card->card_validity }}" value="{{ $card->card_number }}">+{{ $card->card_number }}</option>
                    @empty
                        <option value="" selected disabled>No card available</option>
                    @endforelse
                </select>
                <span id="error-card-number"></span>
            </div>
        </div>
        <div class="row">
            @if($basic_widget['current_balance'] == 1)
            <div class="col-lg-4 col-md-6 data-block">
                <div class="shadow-box current-balance-block">
                    <p>current balance</p>
                    <div class="clearfix"></div>
                    <h1 id="card-balance">€0.00</h1>
                    <center><p>Validity : <span id="card-validity">N/A</span></p></center>
                    @if(Auth::user()->cards->count() > 1)
                        <center><a href="{{ route('dashboard.auto_reload', 'simple') }}" class="simple-btn round">Corporate Account</a></center>
                    @endif
                    {{-- 
                        @elseif(Auth::user()->cards->count() == 1 && (Auth::user()->cards)[0]->group_id != NULL)
                        <center><a href="{{ route('dashboard.auto_reload', 'simple') }}" class="simple-btn round">Corporate Account</a></center>
                    --}}
                </div>
            </div>
            @endif
            @if($basic_widget['history'] == 1)
            <div class="col-lg-5 col-md-6 data-block">
                
                <div class="shadow-box history-block">
                    <div class="title-block">
                        <div class="col-sm-7 col-md-5 col-lg-8">
                            <p>History</p>
                        </div>
                        <div class="col-sm-5 col-md-7 col-lg-4">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="date-filter">
                        <ul>
                            <li>
                                <div class="form-group">
                                    <div class='input-group date' id='date-now'>
                                        <input type='text' class="form-control" id="input-date-to" value="{{ date('Y-m-d', strtotime('-1 months')) }}" placeholder="DATE TO" />
                                        <span class="input-group-addon">
                                        </span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form-group">
                                    <div class='input-group date' id='date-to'>
                                        <input type='text' class="form-control"  id="input-date-from" value="{{ date('Y-m-d') }}" placeholder="DATE NOW" />
                                        <span class="input-group-addon">
                                        </span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="form-group">
                                    <button type="button" class="date-filter-btn" id="change-history-date">Change</button>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <ul class="top-menu-list list-inline">
                        <li><a data-id="reload-log" href="#" class="active">RELOAD</a></li>
                        <li><a data-id="call-log" href="#">CALL</a></li>
                        <li><a data-id="internet-log" href="#">INTERNET</a></li>
                        <li><a data-id="sms-log" href="#">SMS</a></li>
                    </ul>
                    <div class="clearfix"></div>
                    <ul id="reload-log" class="history-list">
                        <img src="{{ asset('global/images/loader.gif') }}">
                    </ul>
                    <ul id="call-log" class="history-list hide">
                        <img src="{{ asset('global/images/loader.gif') }}">
                    </ul>
                    <ul id="internet-log" class="history-list hide">
                        <img src="{{ asset('global/images/loader.gif') }}">
                    </ul>
                    <ul id="sms-log" class="history-list hide">
                        <img src="{{ asset('global/images/loader.gif') }}">
                    </ul>
                </div>
            </div>
            @endif
            @if($basic_widget['add_sim'] == 1)
            <div class="col-lg-3 col-md-6 data-block">
                <div class="shadow-box add-sim-card-block">
                    <a href="{{ route('dashboard.add_card') }}" class="simple-btn yellow">Add a Sim Card</a>
                    <ul class="number-list">
                        @foreach(Auth::user()->cards as $card)
                            <li>
                                <p class="number">+{{ $card->card_number }}</p>
                                <p data-card="{{ $card->card_number }}" class="status {{ (!empty($card->card_status) ? 'active' : '') }}">{{ (!empty($card->card_status) ? 'Activated' : 'Deactivated') }}</p> <!-- card-status -->
                                <a href="javascript:;" data-number="{{ $card->card_number }}" class="icon card-delete"><img src="{{ asset('dashboard/images/rubbish-bin.png') }}" alt="rubbish bin"></a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            @endif
            @if($basic_widget['reload'] == 1)
            <div class="col-lg-4 col-md-6 data-block">
                <div class="shadow-box small reload-block">
                    <p>Reload</p>
                    <form action="{{ route('online_shop') }}" method="post" id="frm-reload">
                        {{ csrf_field() }}
                        <div  class="form-group">
                            <input type="hidden" name="card_number" value="">
                        </div>
                        <div class="form-group reload-amt">
               				<select name="amount" class="custom" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}'>
               					<option value="">Select Amount</option>
               					<option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
               					<option value="200">200</option>
               				</select>
               			</div>
                        <button type="submit" class="simple-btn full">Submit</button>
                    </form> 
                </div>
            </div>
            @endif
            @if($basic_widget['refer_friend'] == 1)
            <div class="col-lg-4 col-md-6 data-block">
                <div class="shadow-box small refer-friend-block">
                    <p>Refer a friend</p>
                    <form action="javascript:;" id="frm-referal">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Enter the email">
                        </div>
                        <button type="submit" class="simple-btn full">Submit</button>
                    </form> 
                </div>
            </div>
            @endif
            <div class="col-lg-4 col-md-6 add-remove-block-function home-page">
                <div class="simple-shadow small add-remove-block">
                    <p>Add or remove a widget</p>
                    <a href="javascript:;" class="add-icon"><img src="{{ asset('dashboard/images/add-icon.png') }}" alt="add" /></a>
                </div>
                <div class="simple-shadow small add-remove-list-block hide">
                    <div class="add-header">
                        <div class="pull-left">
                            <img class="remove-img remove-icon" src="{{ asset('dashboard/images/remove-sprite.png') }}" alt="remove">
                        </div>
                        <div class="pull-right">
                            <p class="text-right">Add or remove a widget</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="add-remove-list">
                        <ul>
                            <li>
                                <div class="list-title">
                                    <span>Balance</span>
                                </div> 
                                <div class="action-btns">
                                    <ul class="list-inline">
                                        <li class="@if($basic_widget['current_balance'] == 1) hide @endif">
                                            <a href="javascript:;"><img src="{{ asset('dashboard/images/add-sprite.png') }}" data-class="current_balance-basic" alt="add" class="add-img"></a>
                                        </li>
                                        <li class="@if($basic_widget['current_balance'] == 0) hide @endif">
                                            <a href="javascript:;"><img class="remove-img" src="{{ asset('dashboard/images/remove-sprite.png') }}" data-class="current_balance-basic" alt="remove"></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="list-title">
                                    <span>History</span>
                                </div> 
                                <div class="action-btns">
                                    <ul class="list-inline">
                                        <li class="@if($basic_widget['history'] == 1) hide @endif">
                                            <a href="javascript:;"><img src="{{ asset('dashboard/images/add-sprite.png') }}" data-class="history-basic" alt="add" class="add-img"></a>
                                        </li>
                                        <li class="@if($basic_widget['history'] == 0) hide @endif">
                                            <a href="javascript:;"><img class="remove-img" src="{{ asset('dashboard/images/remove-sprite.png') }}" data-class="history-basic" alt="remove"></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="list-title">
                                    <span>User Cards</span>
                                </div> 
                                <div class="action-btns">
                                    <ul class="list-inline">
                                        <li class="@if($basic_widget['add_sim'] == 1) hide @endif">
                                            <a href="javascript:;"><img src="{{ asset('dashboard/images/add-sprite.png') }}" data-class="add_sim-basic" alt="add" class="add-img"></a>
                                        </li>
                                        <li class="@if($basic_widget['add_sim'] == 0) hide @endif">
                                            <a href="javascript:;"><img class="remove-img" src="{{ asset('dashboard/images/remove-sprite.png') }}" data-class="add_sim-basic" alt="remove"></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="list-title">
                                    <span>Reload</span>
                                </div> 
                                <div class="action-btns">
                                    <ul class="list-inline">
                                        <li class="@if($basic_widget['reload'] == 1) hide @endif">
                                            <a href="javascript:;"><img src="{{ asset('dashboard/images/add-sprite.png') }}" data-class="reload-basic" alt="add" class="add-img"></a>
                                        </li>
                                        <li class="@if($basic_widget['reload'] == 0) hide @endif">
                                            <a href="javascript:;"><img class="remove-img" src="{{ asset('dashboard/images/remove-sprite.png') }}" data-class="reload-basic" alt="remove"></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <div class="list-title">
                                    <span>Refer a Friend</span>
                                </div> 
                                <div class="action-btns">
                                    <ul class="list-inline">
                                        <li class="@if($basic_widget['refer_friend'] == 1) hide @endif">
                                            <a href="javascript:;"><img src="{{ asset('dashboard/images/add-sprite.png') }}" data-class="refer_friend-basic" alt="add" class="add-img"></a>
                                        </li>
                                        <li class="@if($basic_widget['refer_friend'] == 0) hide @endif">
                                            <a href="javascript:;"><img class="remove-img" src="{{ asset('dashboard/images/remove-sprite.png') }}" data-class="refer_friend-basic" alt="remove"></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Delete Modal -->
<div id="delete-modal" class="modal fade common-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h2>Are you sure want to delete this number?<h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-confirm" data-dismiss="modal">Confirm</button>
            </div>
        </div>
    </div>
</div>
<!-- Active Modal -->
<div id="active-modal" class="modal fade common-modal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <h2>Are you sure want to active this number?<h2>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-confirm" data-dismiss="modal">Confirm</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        (function($){
            $(window).on("load",function(){
                $(".history-list,.add-remove-list-block,.add-sim-card-block .number-list").mCustomScrollbar();
            });
        })(jQuery);

        /**
             * Set the same height of all block
             */
            function data_block_height(){
                var maxHeight = -1;

               $('.data-block,.add-remove-block-function').each(function() {
                 maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
               });

               $('.data-block,.add-remove-block-function').each(function() {
                 $(this).height(maxHeight);
               });
            }

            data_block_height();
    });
    
</script>
    <!-- Add Remove Widget Script -->
    <script type="text/javascript">
        $(function(){
            /**
             * Date selection in history block
             */
            $('#date-now').datetimepicker({
                format: 'YYYY-MM-DD'
            });

            $('#date-to').datetimepicker({
                format: 'YYYY-MM-DD'
            });

            $("#date-now").on("dp.change", function (e) {
                $('#date-to').data("DateTimePicker").minDate(e.date);
            });

            $("#date-to").on("dp.change", function (e) {
                $('#date-now').data("DateTimePicker").maxDate(e.date);
            });

            /**
             * Add or Remove Widgets 
             */
            $(".add-remove-block .add-icon").click(function(){
                $(".add-remove-block").addClass("hide");
                $(".add-remove-list-block").removeClass("hide");
            });

            $(".add-remove-list-block .remove-icon").click(function(){
                $(".add-remove-block").removeClass("hide");
                $(".add-remove-list-block").addClass("hide");
            });

            $(".action-btns .remove-img").click(function(){
                var id = $(this).data('class');

                $.ajax({
                    url: "{{ route('remove_widget') }}",
                    type: 'POST',
                    dataType: 'json',
                    beforeSend:addOverlay,
                    data: {
                        _token: $('meta[name="csrf_token"]').attr('content'),
                        widget: id
                    },
                    success: function(r){
                        location.reload();
                    },
                    //complete:removeOverlay
                });
            });

            $(".action-btns .add-img").click(function(){
                var id = $(this).data('class');

                $.ajax({
                    url: "{{ route('add_widget') }}",
                    type: 'POST',
                    dataType: 'json',
                    beforeSend:addOverlay,
                    data: {
                        _token: $('meta[name="csrf_token"]').attr('content'),
                        widget: id
                    },
                    success: function(r){
                        location.reload();
                    },
                    //complete:removeOverlay
                });
            });

            /**
             * Change section in history block
             */
            $(".history-block ul.top-menu-list li a").click(function(){
                $(".history-list").addClass('hide');
                $("#" + $(this).data('id')).removeClass('hide');
                $(".history-block ul.top-menu-list li a").removeClass('active').mCustomScrollbar("update");
                $(this).addClass('active');
            });
            
            /**
             * Set balance and history of selected card
             */
            if($("#change-card").val() != '' && $("#change-card").val() != null){
                var card_selected = "{{ session('card_selected') }}";
                if(card_selected != '' && card_selected != null){
                    if(card_selected != $("#change-card").val()){
                        $("#change-card").val(card_selected).change();
                    }
                }
                else{
                    $.ajax({
                        url: "{{ route('set_session_card') }}",
                        type: 'POST',
                        data: { _token: $('meta[name="csrf_token"]').attr('content'), card: $("#change-card").val() }
                    });
                }
                @if($basic_widget['current_balance'] == 1)
                    set_balance($("#change-card").val());
                @endif
                @if($basic_widget['history'] == 1)
                    set_call_history($("#change-card").val(), $('#input-date-to').val(), $('#input-date-from').val());
                @endif
                $("#frm-reload input[name='card_number']").val($("#change-card").val());
                $('#card-validity').html(($('#change-card option:selected').data('validity') != '' ? $('#change-card option:selected').data('validity') : 'N/A'));
            }

            /**
             * Set balance and history on change of card
             */
            $("#change-card").change(function(){
                var card_selected = "{{ session('card_selected') }}";
                if(card_selected != $("#change-card").val()){
                    $.ajax({
                        url: "{{ route('set_session_card') }}",
                        type: 'POST',
                        data: { _token: $('meta[name="csrf_token"]').attr('content'), card: $("#change-card").val() }
                    });
                }
                @if($basic_widget['current_balance'] == 1)
                    set_balance($("#change-card").val());
                @endif
                @if($basic_widget['history'] == 1)
                    set_call_history($("#change-card").val(), $('#input-date-to').val(), $('#input-date-from').val());
                @endif
                $("#frm-reload input[name='card_number']").val($(this).val());
                $('#card-validity').html(($('#change-card option:selected').data('validity') != '' ? $('#change-card option:selected').data('validity') : 'N/A'));
                // set_call_history($(this).val(), '2017-05-01', '2018-02-18');
            });

            /**
             * Set history on change of dates
             */
            $("#change-history-date").click(function(){
                $(this).blur();
                set_call_history($("#change-card").val(), $('#input-date-to').val(), $('#input-date-from').val());
            });

            /**
             * Reload card validation rules
             */
            $("#frm-reload").validate({
                rules: {
                    card_number:{
                        required:true
                    },
                    amount:{
                        required:true
                    },
                },
                messages: {
                    card_number:{
                        required:"@lang('validation.required',['attribute'=>'card number'])",
                    },
                    amount:{
                        required:"@lang('validation.required',['attribute'=>'amount'])",
                    },
                },
                errorClass: 'help-block',
                errorElement: 'span',
                invalidHandler: function (event, validator) { //display error alert on form submit   
                    $('#frm-reload').addClass('form-error');
                    $('.alert-danger', $('#frm-reload')).show();
                },
                highlight: function (element) {
                    $('#frm-reload').addClass('form-error');
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
                    $('#frm-reload').removeClass('form-error');
                    form.submit();
                }
            });

            /**
             * Check validation on submit of reload form
             */
            $("#frm-reload").submit(function(){
                if($(this).valid()){
                    return true;
                }
                else{
                    return false;
                }
            });

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
                invalidHandler: function (event, validator) { //display error alert on form submit   
                    $('#frm-referal').addClass('form-error');
                    $('.alert-danger', $('.login-form')).show();
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
                        },
                        complete:removeOverlay
                    });
                }
                else{
                    return false;
                }
            });

            /**
             * Delete a card
             */
            $(".card-delete").click(function(){
                $("#delete-modal .btn-confirm").attr('data-number', $(this).data('number'));
                $("#delete-modal").modal("show");
            });

            $("#delete-modal").on('hide.bs.modal', function () {
                $("#delete-modal .btn-confirm").removeAttr('data-number');
            });

            $("#delete-modal .btn-confirm").click(function(){
                var number = $(this).data('number');
                var action = "{{ route('action_remove_card') }}";
                $.ajax({
                    url: action,
                    type: 'POST',
                    dataType: 'json',
                    beforeSend:addOverlay,
                    data: {
                        _token: $('meta[name="csrf_token"]').attr('content'),
                        number: number
                    },
                    success: function(r){
                        showMessage(r.status, r.message)
                        if(r.status == 200){
                            $('.add-sim-card-block a[data-number="'+number+'"].card-delete').parent('li').remove();
                        }
                    },
                    complete:removeOverlay
                });
            });

            /**
             * Active a card
             */
            $('.card-active').click(function(){
                $("#active-modal .btn-confirm").attr('data-number', $(this).data('number'));
                $("#active-modal").modal("show");
            });

            $("#active-modal").on('hide.bs.modal', function () {
                $("#active-modal .btn-confirm").removeAttr('data-number');
            });

            $("#active-modal .btn-confirm").click(function(){
                var number = $(this).data('number');
                var data = {'api_name': 'card_status', 'card': number, 'block': 'f'};
                call_api(data, function(r){
                    if(r.status == 200){
                        var card = JSON.parse(r.result);
                        if(card.blocked == "false"){
                            var $this = $('.add-sim-card-block a[data-number="'+number+'"].card-active');
                            $this.prev().prev().addClass('active').html('Activated');
                            $this.remove();
                        }
                    }
                    else{
                        showMessage(r.status,r.message);
                    }
                });
            });

            $('.card-status').each(function(){
                var $this = $(this);
                var data = {'api_name' : 'card_status', 'card': $this.data('card'), 'block': 'c'};
                call_api(data, function(r){
                    if(r.status == 200){
                        var card = JSON.parse(r.result);
                        if(card.blocked == "false"){
                            $this.addClass('active').html('Activated');
                            $this.next().next().remove();
                        }
                    }
                    else{
                        // showMessage(r.status,r.message);
                    }
                });
            });

            /**
             * Set balance of selected card
             */
            function set_balance(card){
                var data = {'api_name' : 'get_balance', 'card': card};
                call_api(data, function(r){
                    if(r.status == 200){
                        var card = JSON.parse(r.result).card;
                        var balance = ((card.curr == "EUR") ? "€" : "$") + card.balance;
                        $("#card-balance").html(balance);
                    }
                    else{
                        showMessage(r.status,r.message);
                        $("#card-balance").html("€0.00");
                    }
                });
            }

            /**
             * Set all history of selected card
             */
            function set_call_history(card, start, end){
                var data = {'api_name' : 'get_call_history', 'card' : card, 'start' : start, 'end' : end};
                var history_errors = [];
                call_api(data, function(r){
                    $(".history-list").mCustomScrollbar("destroy");
                    if(r.status == 200){
                        var calls = JSON.parse(r.result).call;
                        var sms = JSON.parse(r.result).sms;

                        var call_log = sms_log = new Array();
                        
                        if(Array.isArray(calls)){
                            call_log = calls;
                        }
                        else{
                            if(calls != undefined){
                                call_log[0] = calls;
                            }
                        }
                        
                        if(Array.isArray(sms)){
                            sms_log = sms;
                        }
                        else{
                            if(sms != undefined){
                                sms_log[0] = sms;
                            }
                        }                        

                        $("ul#call-log").html('');
                        $("ul#sms-log").html('');

                        for(var i=0; i<call_log.length; i++){
                            $("ul#call-log").append(`<li>
                                                        <img src="{{ asset('dashboard/images/call.png') }}" alt="call">
                                                        <p class="title">`+ ((call_log[i].cdir == 'I') ? 'Inbound' : 'Outbound') +` call</p>
                                                        <p class="price red">€`+ call_log[i].ccost +`</p>
                                                        <div class="clearfix"></div>
                                                        <p class="date">`+ call_log[i].calldate +` | Duration `+ call_log[i].duration +` s | A-Number +`+ call_log[i].anum +` | B-Number +`+ call_log[i].bnum +`</p>
                                                    </li>`);
                        }

                        for(var i=0; i<sms_log.length; i++){
                            $("ul#sms-log").append(`<li>
                                                        <img src="{{ asset('dashboard/images/sms.png') }}" alt="sms">
                                                        <p class="title">`+sms_log[i].smst+`</p>
                                                        <p class="price red">€`+ (sms_log[i].ccost == undefined ? '0.00' : sms_log[i].ccost) +`</p>
                                                        <div class="clearfix"></div>
                                                        <p class="date">`+ sms_log[i].calldate +` | A-Number +`+ sms_log[i].anum +` | B-Number +`+ sms_log[i].bnum +`</p>
                                                    </li>`);
                        }

                        if(call_log.length == 0){
                            $("ul#call-log").append(`<li>
                                                        <p class="title">No call history found.</p>
                                                    </li>`);
                            $("ul#call-log li").each(function(){
                                if($(this).html() == ''){
                                    $(this).remove();
                                }
                            });
                        }

                        if(sms_log.length == 0){
                            $("ul#sms-log").append(`<li>
                                                        <p class="title">No sms history found.</p>
                                                    </li>`);
                            $("ul#sms-log li").each(function(){
                                if($(this).html() == ''){
                                    $(this).remove();
                                }
                            });
                        }
                        // console.log('SMS history');
                        // $(".history-list").mCustomScrollbar("update");
                    }
                    else{
                        if($.inArray(r.message, history_errors) == -1){
                            history_errors.push(r.message);
                        }
                    }
                }, false);
                data = {'api_name' : 'recharge_history', 'card' : card, 'start' : start, 'end' : end};
                call_api(data, function(r){
                    $(".history-list").mCustomScrollbar("destroy");
                    if(r.status == 200){
                        $("ul#reload-log").html('');
                        var recharges = JSON.parse(r.result);
                        if(recharges.recharge_amount == "0.00 EUR"){
                            $("ul#reload-log").append(`<li>
                                                        <p class="title">No recharge history found.</p>
                                                    <li>`);
                            $("ul#reload-log li").each(function(){
                                if($(this).html() == ''){
                                    $(this).remove();
                                }
                            });
                        }
                        else{
                            if(recharges.money_transfer.records.record != undefined){
                                var recharge_history = recharges.money_transfer.records.record;
                                for (var i = 0; i < recharge_history.length; i++) {
                                    if(recharge_history[i].type == 'card'){
                                        $("ul#reload-log").append(`<li>
                                                                    <img src="{{ asset('dashboard/images/reload.png') }}" alt="reload">
                                                                    <p class="title">reload</p>
                                                                    <p class="price">€`+ (recharge_history[i].amount).replace(' EUR', '').replace('+', '') +`</p>
                                                                    <div class="clearfix"></div>
                                                                    <p class="date">`+ recharge_history[i].added +` | Added €`+ (recharge_history[i].amount).replace(' EUR', '').replace('+', '') +`</p>
                                                                </li>`);
                                    }
                                }
                            }
                        }
                        // console.log('Reload history');
                        // $(".history-list").mCustomScrollbar("update");
                    }
                    else{
                        if($.inArray(r.message, history_errors) == -1){
                            history_errors.push(r.message);
                        }
                    }
                }, false);
                data = {'api_name' : 'internet_history', 'card' : card, 'start' : start, 'end' : end};
                call_api(data, function(r){
                    $(".history-list").mCustomScrollbar("destroy");
                    if(r.status == 200){
                        $("ul#internet-log").html('');
                        var records = JSON.parse(r.result).call;
                        var internet_log = new Array();
                    
                        if(Array.isArray(records)){
                            internet_log = records;
                        }
                        else{
                            if(records != undefined){
                                internet_log[0] = records;
                            }
                        }

                        for (var i = 0; i < internet_log.length; i++) {
                            $("ul#internet-log").append(`<li>
                                                        <img src="{{ asset('dashboard/images/internet.png') }}" alt="internet">
                                                        <p class="title">internet</p>
                                                        <p class="price red">€`+ (internet_log[i].cost * 1).toFixed(2) +`</p>
                                                        <div class="clearfix"></div>
                                                        <p class="date">`+ internet_log[i].calldate +` | `+ ((internet_log[i].inb != '' || internet_log[i].inb != 0) ? (internet_log[i].inb / (1024 * 1024)).toFixed(2) : '0.00') +` MB</p>
                                                    </li>`);
                        }

                        if(internet_log.length == 0){
                            $("ul#internet-log").append(`<li>
                                                            <p class="title">No internet history found.</p>
                                                        </li>`);
                            $("ul#internet-log li").each(function(){
                                if($(this).html() == ''){
                                    $(this).remove();
                                }
                            });
                        }
                        // console.log('Internet history');
                        // $(".history-list").mCustomScrollbar("update");
                    }
                    else{
                        if($.inArray(r.message, history_errors) == -1){
                            history_errors.push(r.message);
                        }
                        showMessage(412, history_errors.toString());
                    }
                }, false);
            }

            /**
             * Reload a selected card
             */
            function set_reload(card, amount){
                var data = {'api_name' : 'account_details'};
                call_api(data, function(r){
                    if(r.status == 200){
                        var account = JSON.parse(r.result);
                        data = {'api_name' : 'reload', 'card' : card, 'amount' : amount, 'orederid' : account.orderid+1};
                        call_api(data, function(r){
                            if(r.status == 200){
                                // console.log("card reload : " + r);
                            }
                            else{
                                // console.log("card reload error : " + r.message);
                                showMessage(r.status,r.message);
                            }
                        });
                    }
                    else{
                        showMessage(r.status,r.message);
                    }
                });
            }
        });
        
    </script>
    
@endpush
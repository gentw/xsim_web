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
<div id="page-content-wrapper" class="history-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-7">
                <div class="date-filter">
                    <ul>
                        <li>
                            <div class="form-group">
                                <div class='input-group date' id='date-now'>
                                    <input type='text' class="form-control" id="input-date-to" value="{{ date('Y-m-d', strtotime('-6 months')) }}" placeholder="DATE TO" />
                                    <span class="input-group-addon">
                                    </span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="form-group">
                                <div class='input-group date' id='date-to'>
                                    <input type='text' class="form-control" id="input-date-from" value="{{ date('Y-m-d') }}" placeholder="DATE NOW" />
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
                <div class="shadow-box history-block">
                    <p class="title">History</p>
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
            <div class="col-lg-4 col-md-5">
                <div class="shadow-box current-balance-block">
                    <div class="align-vertical">
                        <select id="change-card" class="custom select2 jcf-ignore">
                            @forelse(Auth::user()->cards as $card)
                                <option value="{{ $card->card_number }}">+{{ $card->card_number }}</option>
                            @empty
                                <option value="" selected disabled>No card available</option>
                            @endforelse
                        </select>
                        <p>current balance</p>
                        <h1 id="card-balance">€0.00</h1>
                        <center><a href="{{ route('online_shop', 'recharge') }}" class="simple-btn round">Reload</a></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script type="text/javascript">
     $(function () {
            /**
             * Date selection
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
             * Change section
             */
            $(".history-block ul.top-menu-list li a").click(function(){
                $(".history-list").addClass('hide');
                $("#" + $(this).data('id')).removeClass('hide');
                $(".history-block ul.top-menu-list li a").removeClass('active');
                $(this).addClass('active');
            });

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
                set_balance($(this).val());
                set_call_history($(this).val(), $('#input-date-to').val(), $('#input-date-from').val());
                // set_call_history($(this).val(), '2017-05-01', '2018-02-18');
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
                set_balance($("#change-card").val());
                set_call_history($("#change-card").val(), $('#input-date-to').val(), $('#input-date-from').val());
                // set_call_history($("#change-card").val(), '2017-05-01', '2018-02-18');
            }

            /**
             * Set history on change of dates
             */
            $("#change-history-date").click(function(){
                $(this).blur();
                set_call_history($("#change-card").val(), $('#input-date-to').val(), $('#input-date-from').val());
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
                                                        <p class="date">`+ call_log[i].calldate +` | Duration `+ call_log[i].duration +` s</p>
                                                    </li>`);
                        }

                        for(var i=0; i<sms_log.length; i++){
                            $("ul#sms-log").append(`<li>
                                                        <img src="{{ asset('dashboard/images/sms.png') }}" alt="sms">
                                                        <p class="title">`+sms_log[i].smst+`</p>
                                                        <p class="price red">€`+ (sms_log[i].ccost == undefined ? '0.00' : sms_log[i].ccost) +`</p>
                                                        <div class="clearfix"></div>
                                                        <p class="date">`+ sms_log[i].calldate +` | +`+ sms_log[i].anum +`</p>
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

                        $(".history-block .history-list").mCustomScrollbar();
                    }
                    else{
                        if($.inArray(r.message, history_errors) == -1){
                            history_errors.push(r.message);
                        }
                        showMessage(412, history_errors.toString());
                    }
                }, false);
            }
        });
</script>
<script>
    (function($){
        $(window).on("load",function(){
            $(".history-block .history-list").mCustomScrollbar();
        });
    })(jQuery);
</script>

@endpush
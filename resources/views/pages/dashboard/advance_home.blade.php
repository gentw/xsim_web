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
    <section class="dashboard-advanced-section">
        <div class="container-fluid">
            <div class="common-number-section">
                <div class="text-left">
                    <select id="change-card" class="custom select2 jcf-ignore">
                        @forelse(Auth::user()->cards as $card)
                            <option value="{{ $card->card_number }}">+{{ $card->card_number }}</option>
                        @empty
                            <option value="" selected disabled>No card available</option>
                        @endforelse
                    </select>
                </div>
            </div>
            <div class="row">
                @if($advance_widget['call_forward'] == 1)
                <div class="col-lg-4 col-md-6 data-block">
                    <div class="simple-shadow call-forward-block">
                        <div class="before-forwading">
                            <p>Specify a number for call forwarding</p>
                            <form action="javascript:;" id="frm-redirect">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">+</span>
                                        <input type="tel" name="redirect_card" id="redirect_card" class="form-control" placeholder="Phone number with international prefix" data-error-container="#error-redirect-card">
                                    </div>
                                    <span id="error-redirect-card"></span>
                                </div>
                                <button type="submit" class="simple-btn full">Submit</button>
                            </form>
                        </div>
                        <div class="after-forwading text-center hide">
                            <p>Your Number is forwaded to</p>
                            <ul id="redirect_numbers">
                            </ul>
                            <div class="remove-number"><a href="javascript:;" id="remove-redirect">Delete</a></div>
                        </div>
                    </div>
                </div>
                @endif
                @if($advance_widget['activation'] == 1)
                <div class="col-lg-4 col-md-6 data-block">
                    <div class="simple-shadow big activation-block">
                        <div class="text-center">
                            <p>Your current national number</p>
                            <ul id="national_numbers">
                            </ul>
                            <a href="{{ route('dashboard.landline_activation') }}" class="btn simple-btn yellow">Add a new number</a>
                            <div><a href="{{ route('dashboard.landline_activation_number') }}">SEE ALL</a></div>
                        </div>

                    </div>
                </div>
                @endif
                @if($advance_widget['geolocalisation'] == 1)
                <div class="col-lg-4 col-md-6 data-block">
                    <div class="simple-shadow big geolocalisation-block">
                        <p>Your XXSIM Card is here <img src="{{ asset('dashboard/images/map-marker-small.png') }}" alt="marker" /></p>
                        <div id="map"></div>
                    </div>
                </div>
                @endif
                @if($advance_widget['gprs'] == 1)
                <div class="col-lg-4 col-md-6 data-block">
                    <div class="simple-shadow text-center gprs-block call-forward-block">
                        <p>View GPRS Packages</p>
                        <a href="{{ route('dashboard.gprs') }}" class="btn simple-btn yellow">GPRS Packages</a> 
                        @php
                            $disable_options = !empty(Auth::user()->cards()->count()) ? '' : 'disabled';
                        @endphp
                        <div class="toggle-btns">
                            <ul>
                                <li>
                                    <ul class="list-inline">
                                        <li class="text-left toggle-title pull-left">
                                            Activate GPRS
                                        </li>
                                        <li class="text-right pull-right">
                                            <label class="switch">
                                              <input type="checkbox" id="gprs_active" class="jcf-ignore active_switch" {{ $disable_options }}>
                                              <span class="slider round"></span>
                                            </label>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </li>
                                <li>
                                    <ul class="list-inline">
                                        <li class="text-left toggle-title pull-left">
                                            Enable Skype Calls
                                        </li>
                                        <li class="text-right pull-right">
                                            <label class="switch">
                                              <input type="checkbox" id="skype_active" class="jcf-ignore active_switch" {{ $disable_options }}>
                                              <span class="slider round"></span>
                                            </label>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </li>
                                <li>
                                    <ul class="list-inline">
                                        <li class="text-left toggle-title pull-left">
                                            Enable Viber Calls
                                        </li>
                                        <li class="text-right pull-right">
                                            <label class="switch">
                                              <input type="checkbox" id="viber_active" class="jcf-ignore active_switch" {{ $disable_options }}>
                                              <span class="slider round"></span>
                                            </label>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </li>
                                <li>
                                    <ul class="list-inline">
                                        <li class="text-left toggle-title pull-left">
                                            Enable Mailbox
                                        </li>
                                        <li class="text-right pull-right">
                                            <label class="switch">
                                              <input type="checkbox" id="mailbox_active" class="jcf-ignore active_switch" {{ $disable_options }}>
                                              <span class="slider round"></span>
                                            </label>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
                @if($advance_widget['auto_reload'] == 1)
                <div class="col-lg-4 col-md-6 data-block hide">
                    <div class="simple-shadow small advanced reload-block">
                        <form action="javascript:;">
                            <p>Auto-reload</p>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Specify minimum amount balance">
                            </div>
                            <button type="submit" class="simple-btn full">Submit</button>
                        </form>
                    </div>
                </div>
                @endif
                @if($advance_widget['statistics'] == 1)
                <div class="col-lg-4 col-md-6 data-block hide">
                    <div class="simple-shadow small statistics-block">
                        <p>Affiliate Statistics</p>
                        <ul class="statistics-list">
                            <li>Gains/paid<span>0/0</span></li>
                            <li>Clicks<span>3</span></li>
                            <li>Sales<span>3</span></li>
                            <li>Conversion Rate<span>5%</span></li>
                            <li>Commision Rate<span>EUR 5</span></li>
                        </ul>
                        <div class="clearfix"></div>
                        <p class="note">Increase commision rate to EUR 7 by selling 21 XXSIM cards more</p>
                    </div>
                </div>
                @endif
                <div class="col-lg-4 col-md-6 add-remove-block-function">
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
                                        <span>Call Forwarding</span>
                                    </div>
                                    <div class="action-btns">
                                        <ul class="list-inline">
                                            <li class="@if($advance_widget['call_forward'] == 1) hide @endif">
                                                <a href="javascript:;"><img src="{{ asset('dashboard/images/add-sprite.png') }}" alt="add" data-class="call_forward-advance" class="add-img"></a>
                                            </li>
                                            <li class="@if($advance_widget['call_forward'] == 0) hide @endif">
                                                <a href="javascript:;"><img class="remove-img" src="{{ asset('dashboard/images/remove-sprite.png') }}" alt="remove" data-class="call_forward-advance"></a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="list-title">
                                        <span>GPRS</span>
                                    </div>
                                    <div class="action-btns">
                                        <ul class="list-inline">
                                            <li class="@if($advance_widget['gprs'] == 1) hide @endif">
                                                <a href="javascript:;"><img src="{{ asset('dashboard/images/add-sprite.png') }}" alt="add" data-class="gprs-advance" class="add-img"></a>
                                            </li>
                                            <li class="@if($advance_widget['gprs'] == 0) hide @endif">
                                                <a href="javascript:;"><img class="remove-img" src="{{ asset('dashboard/images/remove-sprite.png') }}" alt="remove" data-class="gprs-advance"></a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="list-title">
                                        <span>Landline Activation</span>
                                    </div>
                                    <div class="action-btns">
                                        <ul class="list-inline">
                                            <li class="@if($advance_widget['activation'] == 1) hide @endif">
                                                <a href="javascript:;"><img src="{{ asset('dashboard/images/add-sprite.png') }}" alt="add" data-class="activation-advance" class="add-img"></a>
                                            </li>
                                            <li class="@if($advance_widget['activation'] == 0) hide @endif">
                                                <a href="javascript:;"><img class="remove-img" src="{{ asset('dashboard/images/remove-sprite.png') }}" alt="remove" data-class="activation-advance"></a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="list-title">
                                        <span>Geolocalization</span>
                                    </div>
                                    <div class="action-btns">
                                        <ul class="list-inline">
                                            <li class="@if($advance_widget['geolocalisation'] == 1) hide @endif">
                                                <a href="javascript:;"><img src="{{ asset('dashboard/images/add-sprite.png') }}" alt="add" data-class="geolocalisation-advance" class="add-img"></a>
                                            </li>
                                            <li class="@if($advance_widget['geolocalisation'] == 0) hide @endif">
                                                <a href="javascript:;"><img class="remove-img" src="{{ asset('dashboard/images/remove-sprite.png') }}" alt="remove" data-class="geolocalisation-advance"></a>
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
    </section>
</div>
@endsection

@push('scripts')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-RflCDDa2LEXGkPIVCjyZnotaVP7_fXA" type="text/javascript"></script>
    <script type="text/javascript">
        var lat = 19.4254133;
        var lng = -99.1776649;

        function initMap() {
            var mapDiv = document.getElementById('map');
            var latlng= new google.maps.LatLng(lat, lng);
            var map = new google.maps.Map(mapDiv, {
              center: latlng,
              zoom: 13,
              mapTypeId: google.maps.MapTypeId.MAP,
              disableDefaultUI: true,
              scrollwheel: true
            });

            var marker = new google.maps.Marker({
                position: latlng,
                icon: 'images/map-marker-small.png'
            });
            marker.setMap(map);
        }

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
            @if($advance_widget['call_forward'] == 1)
                check_call_forwading($('#change-card').val());
            @endif
            @if($advance_widget['geolocalisation'] == 1)
                set_location($('#change-card').val());
            @endif
            @if($advance_widget['activation'] == 1)
                set_national_numbers($('#change-card').val());
            @endif
            @if($advance_widget['gprs'] == 1)
                manage_gprs_service_status($('#change-card').val());
            @endif
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
            @if($advance_widget['call_forward'] == 1)
                check_call_forwading($('#change-card').val());
            @endif
            @if($advance_widget['geolocalisation'] == 1)
                set_location($('#change-card').val());
            @endif
            @if($advance_widget['activation'] == 1)
                set_national_numbers($('#change-card').val());
            @endif
            @if($advance_widget['gprs'] == 1)
                manage_gprs_service_status($('#change-card').val());
            @endif
        });

        /**
         * call forwading validation rules
         */
        $('#frm-redirect').validate({
            rules: {
                redirect_card:{
                    required: true,
                    digits: true,
                    minlength: 11,
                    maxlength: 15
                },
            },
            messages: {
                redirect_card:{
                    required:"@lang('validation.required',['attribute'=>'phone number'])",
                    digits:"@lang('validation.numeric',['attribute'=>'phone number'])",
                    minlength: "@lang('validation.min.string', ['attribute'=>'phone', 'min'=>11])",
                    maxlength: "@lang('validation.max.string', ['attribute'=>'phone', 'max'=>15])"
                },
            },
            errorClass: 'help-block',
            errorElement: 'span',
            invalidHandler: function (event, validator) { //display error alert on form submit   
                $('#frm-redirect').addClass('form-error');
                $('.alert-danger', $('#frm-redirect')).show();
            },
            highlight: function (element) {
                $('#frm-redirect').addClass('form-error');
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
                $('#frm-redirect').removeClass('form-error');
                form.submit();
            }
        });

        /**
         * Check validation on submit of call forwading form
         */
        $("#frm-redirect").submit(function(){
            if($(this).valid()){
                var card = $("#change-card").val();
                var redirect_card = $("#frm-redirect input[name='redirect_card']").val();
                set_call_forwading(card, redirect_card);
            }
            else{
                return false;
            }
        });

        $("#frm-gprs").submit(function(){
            var zone = $("#frm-gprs #zone").val();
            if(zone == '' || zone == null){
                showMessage(412, "Please select any zone.");
                return false;
            }
            else{
                var url = '{{ route("dashboard.gprs_package", ":zone") }}';
                url = url.replace(':zone', zone);
                window.location = url;
                return true;
            }
        });

        $('#remove-redirect').click(function(){
            remove_call_forwading($('#change-card').val());
        });

        $('.active_switch').click(function(e){
            if(e.originalEvent.isTrusted){
                var id = $(this).attr('id');

                if(id == "viber_active" || id == "skype_active"){
                    if($(this).prop('checked')){
                        manage_national_numbers('add_secondary_national_number', $('#change-card').val(), "899"+$('#change-card').val());
                    }
                    else{
                        manage_national_numbers('remove_national_number', $('#change-card').val(), "899"+$('#change-card').val());
                    }
                }
                else if(id == "gprs_active"){
                    if($(this).prop('checked')){
                        manage_gprs_service_status($('#change-card').val(), 'f');
                    }
                    else{
                        manage_gprs_service_status($('#change-card').val(), 't');
                    }
                }
            }
        });

        /**
         * Set Location of selected card
         */
        function set_location(card){
            var data = {'api_name' : 'geolocation_status', 'card' : card};
            call_api(data, function(r){
                if(r.status == 200){
                    var status = JSON.parse(r.result).status;
                    if(status == "disabled"){
                        $(".geolocalisation-block").html(`<p>Geolocation Service Status is disable</p><a href="{{ route('dashboard.geolocalization') }}" class="btn simple-btn yellow">ACTIVATE</a>`);
                    }
                    else{
                        $(".geolocalisation-block").html(`<p>Your XXSIM Card is here <img src="{{ asset('dashboard/images/map-marker-small.png') }}" alt="marker" /></p><div id="map"></div>`);
                        data = {'api_name' : 'geolocation', 'card' : card};
                        call_api(data, function(r){
                            if(r.status == 200){
                                var result = JSON.parse(r.result);
                                  lat = result.latitude;
                                  lng = result.longitude;
                                  initMap();
                            }
                            else{
                                showMessage(r.status,r.message);
                            }
                        });
                    }
                }
                else{
                    showMessage(r.status,r.message);
                }
            });
        }

        /**
         * Set call forwading of selected card
         */
        function set_call_forwading(card, redirect_card){
            var data = {'api_name' : 'call_forwading', 'card' : card, 'redirect_card' : redirect_card};
            call_api(data, function(r){
                if(r.status == 200){
                    showMessage(r.status, "Call redirecting successfully to inputed number.");
                    $('.before-forwading').addClass('hide');
                    $('.after-forwading').removeClass('hide');
                    $('#redirect_numbers').html(`<li>+`+redirect_card+`</li>`);
                }
                else{
                    showMessage(r.status,r.message);
                }
            });
        }

        function remove_call_forwading(card) {
            var data = {'api_name' : 'call_forwading', 'card' : card, 'redirect_card' : ''};
            call_api(data, function(r){
                if(r.status == 200){
                    showMessage(r.status, "Call redirecting removed successfully.");
                    $('.before-forwading').removeClass('hide');
                    $('.after-forwading').addClass('hide');
                    $('#redirect_numbers').html('');
                }
                else{
                    showMessage(r.status,r.message);
                }
            });
        }

        function check_call_forwading(card) {
            var data = {'api_name' : 'check_redirect', 'card' : card};
            call_api(data, function(r){
                if(r.status == 200){
                    var card = JSON.parse(r.result);
                    $('.before-forwading').addClass('hide');
                    $('.after-forwading').removeClass('hide');
                    $('#redirect_numbers').html(`<li>+`+card.redirect+`</li>`);
                }
                else{
                    $('.before-forwading').removeClass('hide');
                    $('.after-forwading').addClass('hide');
                    // showMessage(r.status,r.message);
                }
            });
        }

        /**
         * Set balance of selected card
         */
        function set_national_numbers(card){
            var numbers = [];
            var data = {'api_name' : 'get_all_enum', 'num': card};
            call_api(data, function(r){
                if(r.status == 200){
                    var card = JSON.parse(r.result);
                    if(Array.isArray(card.primary_enum)){
                        if(card.primary_enum.length > 0){
                            for (var i = card.primary_enum.length - 1; i >= 0; i--) {
                                if(card.primary_enum[i] != undefined && card.primary_enum[i] != '' && card.primary_enum[i] != null){
                                    numbers.push(card.primary_enum[i]);
                                }
                            }
                        }
                    }
                    else{
                        if(card.primary_enum != '' || card.primary_enum != null || card.primary_enum != undefined){
                            numbers.push(card.primary_enum);
                        }
                    }
                    if(Array.isArray(card.secondary_enum) && card.secondary_enum.length > 0){
                        for (var i = card.secondary_enum.length - 1; i >= 0; i--) {
                            if(card.secondary_enum[i] != undefined && card.secondary_enum[i] != '' && card.secondary_enum[i] != null){
                                numbers.push(card.secondary_enum[i]);
                            }
                        }
                    }
                    else{
                        if(card.secondary_enum != '' || card.secondary_enum != null){
                            if(card.secondary_enum != undefined && card.secondary_enum != '' && card.secondary_enum != null){
                                numbers.push(card.secondary_enum);
                            }
                        }
                    }

                    if(numbers.length > 0){
                        $('#national_numbers').html(`<li>+`+numbers[0]+`</li>`);

                        if(jQuery.inArray("899"+$('#change-card').val(), numbers) !== -1){
                            if(!$('#skype_active').prop('checked')){
                                $('#skype_active').trigger('click');
                            }
                            if(!$('#viber_active').prop('checked')){
                                $('#viber_active').trigger('click');
                            }
                            // $('#skype_active').attr('checked', 'checked');
                            // $('#viber_active').attr('checked', 'checked');
                        }
                        else{
                            if($('#skype_active').prop('checked')){
                                $('#skype_active').trigger('click');
                            }
                            if($('#viber_active').prop('checked')){
                                $('#viber_active').trigger('click');
                            }
                            // $('#skype_active').removeAttr('checked');
                            // $('#viber_active').removeAttr('checked');
                        }
                    }
                    else{
                        $('#national_numbers').html(`<li>There is no numbers seted.</li>`);
                        if($('#skype_active').prop('checked')){
                            $('#skype_active').trigger('click');
                        }
                        if($('#viber_active').prop('checked')){
                            $('#viber_active').trigger('click');
                        }
                        // $('#skype_active').removeAttr('checked');
                        // $('#viber_active').removeAttr('checked');
                    }
                }
                else{
                    $('#national_numbers').html(`<li>There is no numbers seted.</li>`);
                }
            });
        }

        /**
         * Manage NAtion numbers
         */
        function manage_national_numbers(command, card, number) {
            var data = {'api_name' : command, 'card' : card, 'enum' : number};
            call_api(data, function(r){
                if(r.status == 200){
                    set_national_numbers(card);
                }
                else{
                    showMessage(r.status,r.message);
                }
            });
        }

        /**
         * Manage GPRS service status
         */
        function manage_gprs_service_status(card, status = 'c') {
            var data = {'api_name' : 'gprs_service_status', 'card' : card, 'block' : status};
            call_api(data, function(r){
                if(r.status == 200){
                    var result = JSON.parse(r.result).result;
                    if(result.GPRS == "enabled"){
                        $('#gprs_active').attr('checked', 'checked');
                    }
                    else{
                        $('#gprs_active').removeAttr('checked');
                    }
                }
                else{
                    showMessage(r.status,r.message);
                }
            });
        }

    </script>
    <script>
    (function($){
        $(window).on("load",function(){
            $(".add-remove-list-block").mCustomScrollbar();
        });
    })(jQuery);
</script>
@endpush

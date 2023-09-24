@extends('layouts.dashboard')

@section('content')
<div id="page-content-wrapper" class="geolocalization">
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
    <div class="localisation-block">
      <div id="map"></div>
    </div>
    <div class="no-location">
      <h2>Geolocation Service Status is disable</h2>
      <form action="javascript:;" role="form" id="frm-location" class="form-step">
        <div class="form-group">
          <div class='input-group date' id='date-activation'>
              <input type='text' class="form-control" name="service_date" id="service_date" placeholder="Date of service activation" data-error-container="#error-service-date" />
              <span class="input-group-addon">
              </span>
          </div>
          <span id="error-service-date"></span>
        </div>
        <div class="form-group">
            <select name="activation_period" id="activation_period" class="custom" data-jcf='{"wrapNative": false, "wrapNativeOnMobile": false, "fakeDropInBody": false, "useCustomScroll": false}' data-error-container="#error-activation-period">
              <option value="">Activation period (in months)</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>
            <span id="error-activation-period"></span>
        </div>
        <button type="submit" class="simple-btn full">Submit</button>
      </form>
    </div>
</div>
@endsection

@push('scripts')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-RflCDDa2LEXGkPIVCjyZnotaVP7_fXA&callback=initMap" type="text/javascript"></script>
<script type="text/javascript">
    $(".no-location, .localisation-block").hide();
    var lat = 19.4254133;
    var lng = -99.1776649;
    $(window).resize(function(){
        initMap();
    });
    function initMap() {
        var mapDiv = document.getElementById('map');
        var latlng= new google.maps.LatLng(lat, lng);
        var map = new google.maps.Map(mapDiv, {
          center: latlng,
          zoom: 15,
          mapTypeId: google.maps.MapTypeId.MAP,
          disableDefaultUI: true,
          draggable: true,
          scrollwheel: true,
          navigationControl: true,
          mapTypeControl: true,
          scaleControl: true
        });

        var marker = new google.maps.Marker({
            position: latlng,
            icon: 'images/map-marker-small.png'
        });
        marker.setMap(map);
    }

    /**
   * Set balance and history of selected card
   */
  if($("#change-card").val() != '' && $("#change-card").val() != null){
      set_location($('#change-card').val());
  }

  /**
   * Set balance and history on change of card
   */
  $("#change-card").change(function(){
      set_location($('#change-card').val());
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
          $(".no-location").show();
        }
        else{
          data = {'api_name' : 'geolocation', 'card' : card};
          call_api(data, function(r){
            if(r.status == 200){
              var result = JSON.parse(r.result);
              lat = result.latitude;
              lng = result.longitude;
              initMap();
              $(".localisation-block").show();
            }
            else{
              showMessage(r.status,r.message);
              $(".no-location").show();
            }
          });
        }
      }
      else{
          showMessage(r.status,r.message);
          $(".no-location").show();
      }
    });
  }

  $(function(){
    $('#date-activation').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    /**
     * Location service validation rules
     */
    $("#frm-location").validate({
        rules: {
            service_date:{
              required:true
            },
            activation_period:{
              required:true
            },
        },
        messages: {
            service_date:{
              required:"@lang('validation.required',['attribute'=>'service activation'])",
            },
            activation_period:{
              required:"@lang('validation.required',['attribute'=>'activation period'])",
            },
        },
        errorClass: 'help-block',
        errorElement: 'span',
        invalidHandler: function (event, validator) {
            $('#frm-location').addClass('form-error');
            $('.alert-danger', $('#frm-location')).show();
        },
        highlight: function (element) {
          $('#frm-location').addClass('form-error');
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
            $('#frm-location').removeClass('form-error');
            form.submit();
        }
    });

    $('#frm-location').submit(function(){
      if($(this).valid()){
        data = {'api_name' : 'active_geolocation_service', 'card' : $('#change-card').val(), 'from' : $('#frm-location #service_date').val(), 'timeframes' : $('#frm-location #activation_period').val(), 'packetid' : 1};
        call_api(data, function(r){
          if(r.status == 200){
            showMessage(r.status, "Geolocation service will start from selected date.")
            set_location($('#change-card').val());
          }
          else{
            showMessage(r.status,r.message);
            $(".no-location").show();
          }
        });
        return true;
      }
      else{
        return false;
      }
    });
  });
</script>
@endpush

@extends('layouts.dashboard')

@section('content')
<div id="page-content-wrapper">
    <div class="container-fulid">
        <div class="gprs-package-section">
            <div class="gprs-package-header">
                <h3>Select a number then activate the GPRS Package</h3>
                {{-- 
                <select id="change-country" class="custom select2 jcf-ignore">
                    @foreach($countries as $value)
                        <option value="{{ $value }}" @if($value=="United Arab Emirate") selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
                --}}
                <select id="change-card" class="custom select2 jcf-ignore">
                    @forelse(Auth::user()->cards as $card)
                        <option value="{{ $card->card_number }}">+{{ $card->card_number }}</option>
                    @empty
                        <option value="" selected disabled>No card available</option>
                    @endforelse
                </select>
                <div class="clearfix"></div>
            </div>
            <div id="packages" class="row">
                @forelse($gprs_packages as $package)
                    <div class="col-lg-4 col-md-6">
                        <div class="shadow-box package">
                            <h2 class="yellow">{{ $package->price }} EUR</h2>
                            <h2>{{ $package->name }}</h2>
                            <ul class="list-inline package-feature-list">
                                <li>Duration</li>
                                <li>{{ $package->duration . (($package->duration == 1) ? ' day' : ' days')  }}</li>
                                <li>Data</li>
                                <li>{{ $package->data }} MB</li>
                            </ul>
                            <a href="#" data-packetid="{{ $package->code }}" class="simple-btn yellow active-packet">Activate</a>
                        </div>
                    </div>
                @empty
                    <div>
                        <p>There is no packages for selected country.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
<!-- package Modal -->
<div id="package-modal" class="modal fade common-modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <h2>Are you sure want to active this package?<h2>
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
<script type="text/javascript">
    $('#change-country').change(function(){
        var action = "{{ route('get_packages') }}";
        $.ajax({
            url: action,
            type: 'POST',
            dataType: 'json',
            beforeSend: addOverlay,
            data: {
                _token: $('meta[name="csrf_token"]').attr('content'),
                country: $('#change-country').val(),
            },
            success: function(r){
                if(r.status == 200){
                    packages = r.packages;
                    $('#packages').html('');
                    for (var i = 0; i < packages.length; i++) {
                        $('#packages').append(`<div class="col-lg-4 col-md-6">
                                                    <div class="shadow-box package">
                                                        <h2 class="yellow">`+packages[i].price+` EUR</h2>
                                                        <h2>`+packages[i].name+`</h2>
                                                        <ul class="list-inline package-feature-list">
                                                            <li>Duration</li>
                                                            <li>`+packages[i].duration + ((packages[i].duration == 1) ? ' day' : ' days')+`</li>
                                                            <li>Data</li>
                                                            <li>`+packages[i].data+` MB</li>
                                                        </ul>
                                                        <a href="#" data-packetid="`+packages[i].code+`" class="simple-btn yellow active-packet">Activate</a>
                                                    </div>
                                                </div>`);
                    }
                }
                else{
                    showMessage(r.status, r.message);
                }
            },
            complete: removeOverlay
        });
    });

    $(document).on('click', '.active-packet', function(){
        $("#package-modal .btn-confirm").attr('data-packetid', $(this).data('packetid'));
        $("#package-modal").modal("show");
    });

    $("#package-modal").on('hide.bs.modal', function () {
        $("#package-modal .btn-confirm").removeAttr('data-packetid');
    });

    $("#package-modal .btn-confirm").click(function(){
        var data = {"api_name": "active_discount_package", 'card': $('#change-card').val(), "packettype": "dailygprs", "packetid": $(this).attr('data-packetid')};
        call_api(data, function(r){
            if(r.status == 200){
                showMessage(r.status,"GPRS Package activated successfully.");
            }
            else{
                if(r.message == "Packet change terms were not met"){
                    r.message = "Your package has already subscribed, you are not allowed to subscribe for multiple packages";
                }
                showMessage(r.status,r.message);
            }
        });
    });
</script>
@endpush
@extends('layouts.dashboard')

@section('content')
		<div id="page-content-wrapper">

            <!-- <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a> -->
            <div class="data-package">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#classic">CLASSIC</a></li>
                  <li ><a data-toggle="tab" href="#data-package">SPECIAL DATA PACKAGES</a></li>
                </ul>
                <div class="tab-content">
                    <div id="classic" class="tab-pane fade in active">
                  	<section class="zone-container" id="page-content-wrapper">
	                    <article class="container-fluid">
							<div class="row">
								<div class="col-md-6 col-lg-4 zone-block">
									<div class="shadow-box">
										<div class="zone-header">
											<div class="row">
												<div class="col-sm-5">
													<h2>Zone A</h2>
												</div>
											</div>
										</div>
										<div class="zone-body">
											<div class="row">
												<div class="col-sm-6">
													<ul class="list-unstyled zone-list">
														@for($i = 0; $i < (count($zones[0]) / 2); $i++)
															<li>{{ $zones[0][$i] }}</li>
														@endfor
													</ul>	
												</div>
												<div class="col-sm-6">
													<ul class="list-unstyled zone-list">
														@for($i = (count($zones[0]) / 2); $i < count($zones[0]); $i++)
															<li>{{ $zones[0][$i] }}</li>
														@endfor
													</ul>
												</div>
											</div>
										</div>
										<div class="zone-footer">
											<a href="{{ route('dashboard.gprs_package', 1) }}" class="btn">I'm roaming in this zone</a>
										</div>
									</div>
								</div>
								{{-- <div class="col-md-6 col-lg-4 zone-block">
									<div class="shadow-box">
										<div class="zone-header">
											<div class="row">
												<div class="col-sm-5">
													<h2>Zone 2</h2>
												</div>
												<div class="col-sm-7">
													<h6>Includes Zone 1 + Countries listed below</h6>
												</div>
											</div>
										</div>
										<div class="zone-body">
											<div class="row">
												<div class="col-sm-6">
													<ul class="list-unstyled zone-list">
														@for($i = 0; $i < (count($zones[1]) / 2); $i++)
															<li>{{ $zones[1][$i] }}</li>
														@endfor
													</ul>	
												</div>
												<div class="col-sm-6">
													<ul class="list-unstyled zone-list">
														@for($i = (count($zones[1]) / 2); $i < count($zones[1]); $i++)
															<li>{{ $zones[1][$i] }}</li>
														@endfor
													</ul>
												</div>
											</div>
										</div>
										<div class="zone-footer">
											<a href="{{ route('dashboard.gprs_package', 2) }}" class="btn">I'm roaming in this zone</a>
										</div>
									</div>
								</div> --}}
								<div class="col-md-6 col-lg-4 zone-block">
									<div class="shadow-box">
										<div class="zone-header">
											<div class="row">
												<div class="col-sm-5">
													<h2>Zone B</h2>
												</div>
												<div class="col-sm-7">
													<h6>Includes Zone A + Countries listed below</h6>
												</div>
											</div>
										</div>
										<div class="zone-body">
											<div class="row">
												<div class="col-sm-6">
													<ul class="list-unstyled zone-list">
														@for($i = 0; $i < (count($zones[2]) / 2); $i++)
															<li>{{ $zones[2][$i] }}</li>
														@endfor
													</ul>	
												</div>
												<div class="col-sm-6">
													<ul class="list-unstyled zone-list">
														@for($i = (count($zones[2]) / 2); $i < count($zones[2]); $i++)
															<li>{{ $zones[2][$i] }}</li>
														@endfor
													</ul>
												</div>
											</div>
										</div>
										<div class="zone-footer">
											<a href="{{ route('dashboard.gprs_package', 3) }}" class="btn">I'm roaming in this zone</a>
										</div>
									</div>
								</div>
							</div>
						</article>
					</section>
                </div>
                <div id="data-package" class="tab-pane fade">
                	<div class="gprs-package-header">
		                <select id="change-card" class="custom select2 jcf-ignore">
		                    @forelse(Auth::user()->cards as $card)
		               	         <option value="{{ $card->card_number }}">+{{ $card->card_number }}</option>
		                    @empty
		                        <option value="" selected disabled>No card available</option>
		                    @endforelse
		                </select>
                		<div class="clearfix"></div>
            		</div>
                    <ul class="data-products">
                    	@forelse($special_packages as $package)
                    	 <li class="text-center">
                            <h3>EUR {{ sprintf("%0.2f", $package->price) }}</h3>
                            <h4 class="text-center">{{ $package->name }}</h4>
                            @if($package->name == "Europe PLUS Data Package")
            					<p>Activation Fee of EUR 1.00</p>
            				@else
		        				@if(!empty($package->data))
		                            <p>{{ $package->data }} MB for EUR {{ sprintf("%0.2f",$package->price) }}</p>
		                        @endif
                			@endif
                            {{-- <a href="#" class="simple-btn round">Purchase</a> --}}
                            <a href="#" data-packetid="{{ $package->code }}" class="simple-btn round active-packet">Purchase</a>
                             <ul class="country-name">
                                <li>{{ $package->detail }}</li>
                            </ul>
                        </li>
                    	 @empty
		                    <li>
		                        <p>There is no packages for selected country.</p>
		                    </li>
		                @endforelse
                    </ul>
                  </div>
                </div>
            </div>
        </div>
       <div id="package-modal" class="modal fade common-modal" role="dialog">
		    <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			      </div>
			      <div class="modal-body">
			        <h2>Are you sure want to Purchase this package?<h2>
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
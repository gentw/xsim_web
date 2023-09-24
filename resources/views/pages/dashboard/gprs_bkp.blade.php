@extends('layouts.dashboard')

@section('content')
		<section class="zone-container" id="page-content-wrapper">
			<article class="container-fluid">
				<div class="row">
					<div class="col-md-6 col-lg-4 zone-block">
						<div class="shadow-box">
							<div class="zone-header">
								<div class="row">
									<div class="col-sm-5">
										<h2>Zone 1</h2>
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
					<div class="col-md-6 col-lg-4 zone-block">
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
					</div>
					<div class="col-md-6 col-lg-4 zone-block">
						<div class="shadow-box">
							<div class="zone-header">
								<div class="row">
									<div class="col-sm-5">
										<h2>Zone 3</h2>
									</div>
									<div class="col-sm-7">
										<h6>Includes Zone 1 + Zone 2 + Countries listed below</h6>
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

@endsection

@push('scripts')

@endpush
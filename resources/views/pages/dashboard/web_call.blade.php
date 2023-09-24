@extends('layouts.dashboard')

@section('content')

<div id="page-content-wrapper" class="send-sms web-call">
	<div class="row">
		<div class="col-md-6">
			<h1>Webcall</h1>
			<p>Here you can call an XXSIM for free, no matter where the XXSIM is located.</p>
			<div class="points">
				<h5>On this page, you can place a webcall to any XXSIM for free.</h5>
				<p>TO CALL:</p>
				<ol>
					<li>
						Enter the code in the first field
					</li>
					<li>
						Enter the XXSIM phone number in the second field.
					</li>
					<li>
						Hit "Call"
					</li>
				</ol>
			</div>
			<h2>Call as long as you want. It's free for the caller.</h2>
		</div>
		<div class="col-md-6">
			<div class="shadow-box text-center">
				<div class="form-vertical">
					<form>
						<label>ENTER NUMBER</label>
						<div class="form-group">
							<input type="text" name="to-number" class="form-control" placeholder="Enter Number">
						</div>
						<button type="submit" class="btn simple-btn yellow full">Call</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
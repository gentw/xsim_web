<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
</head>
<body>
	<div>
		<div dir="ltr">
			<div>
				<div dir="ltr">
					<div>
						<div dir="ltr">
							<table width="98%" cellpadding="10">
								<tbody>
									<tr>
										<td colspan="2">
											<table width="100%">
													<tr>
														<td rowspan="3">
															<img src="{{ asset('admin/images/logo.png') }}">
														</td>
														<td dir="rtl">by Egraphic DMCC<br>Dubai, UAE<br>email: info@xxsim.com</td>
													</tr>
													<tr>
														<td style="padding-top: 40px;"></td>
													</tr>
													<tr>
														<td dir="rtl">{!!(!empty($address) ? ucwords($address) . '<br>' : '') . (!empty($city) ? ucwords($city) . '<br>' : '') . (!empty($state) ? ucwords($state) . '<br>' : '') . (!empty($zip) ? $zip . '<br>' : '') . (!empty($country) ? $country : '') !!}</td>
													</tr>
											</table>	
										</td>
									</tr>
									<!-- <tr>
										<td colspan="2"><b> Invoice #: </b> {{ date('Y') . '/' . date('m') . '/' . $transaction_id }} </td>
										<td>  </td>
									</tr> -->
									<tr>
										<td colspan="2"><b> Transaction ID: </b> {{ $transaction_id }} </td>
									</tr>
									<tr>
										<td colspan="2"><b> Order Date: </b> {{ date('Y-m-d') }} </td>
									</tr>
								</tbody>
							</table>
							<br><br>
							<table width="98%" rules="rows" cellpadding="10">
								<thead>
									<tr>
										<th align="center">Pos</th>
										<th align="center">Item</th>
										<th align="center">Qty</th>
										<th align="center">Price</th>
										<th align="center">VAT</th>
										<th align="center">Amount</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td align="center">1</td>
										<td align="center">{{ $item }}</td>
										<td align="center">{{ $qty }}</td>
										<td align="center">{{ $price }}</td>
										<td align="center">0.00%</td>
										<td align="center">{{ $qty * $price }}</td>
									</tr>
									@if(!empty($qty_32))
									<tr>
										<td align="center">1</td>
										<td align="center">25% off with &euro; 25 credit - &euro; 32</td>
										<td align="center">{{ $qty_32 }}</td>
										<td align="center">32</td>
										<td align="center">0.00%</td>
										<td align="center">{{ $qty_32 * 32 }}</td>
									</tr>
									@endif
									@if(!empty($qty_50))
									<tr>
										<td align="center">1</td>
										<td align="center">Free SIM with &euro; 50 credit - &euro; 50</td>
										<td align="center">{{ $qty_50 }}</td>
										<td align="center">50</td>
										<td align="center">0.00%</td>
										<td align="center">{{ $qty_50 * 50 }}</td>
									</tr>
									@endif
									<tr>
										<td dir="rtl" colspan="5">Net Amount</td>
										<td align="center">&euro;{{ $total_amount }}</td>
									</tr>
									<tr>
										<td dir="rtl" colspan="5"><b>Total amount</b></td>
										<td align="center">&euro; {{ $total_amount }}</td>
									</tr>
								</tbody>
							</table>

						</div>
					</div>
					<p style="color: red; width: 600px; font-weight: 600">You have to register on our website to activate your XXSIM and buy airtime. Please visit <a href="{{ env('APP_URL') }}" style="color: red">{{ env('APP_URL') }}</a> and click "Register" at top right</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
@extends('admin.layout.app')

@section('breadcrumb')
    {!! Breadcrumbs::render('view_order', $order) !!}
@endsection

@push('page_title_icon')
<i class="fa fa-shopping-cart"></i>
@endpush

@section('content')
 <div class="row ">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-shopping-cart font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">View Card Order</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row form-group">
                    <label for="carrier" class="col-md-2 control-label bold">User : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($order->user_id) ? $order->user->contact->firstname . ' ' . $order->user->contact->lastname : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="country" class="col-md-2 control-label bold">Regular SIM Quantity : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($order->qty_regular) ? $order->qty_regular : '0' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="operator" class="col-md-2 control-label bold">25% off SIM Quantity : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($order->qty_32) ? $order->qty_32 : '0' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="network_type" class="col-md-2 control-label bold">Free SIM Quantity : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($order->qty_50) ? $order->qty_50 : '0' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="network" class="col-md-2 control-label bold">Status : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($order->status) ? ucwords($order->status) : 'N/A' }}</label>
                    </div>
                </div>
                @if(isset($order->coupon->title))
                <div class="row form-group">
                    <label for="network" class="col-md-2 control-label bold">Coupon : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($order->coupon->title) ? ucwords($order->coupon->title) : 'N/A' }}</label>
                    </div>
                </div>
                @endif
                
                <div class="row form-group">
                    <div class="col-md-10">
                        <a href="{{route('admin.order.index')}}" class="btn red">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: SAMPLE FORM PORTLET -->
    </div>
</div>
@endsection

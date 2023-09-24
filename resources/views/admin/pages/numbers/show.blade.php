@extends('admin.layout.app')

@section('breadcrumb')
    {!! Breadcrumbs::render('view_number', $number) !!}
@endsection

@push('page_title_icon')
<i class="fa fa-phone"></i>
@endpush

@section('content')
 <div class="row ">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-phone font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">View National Number</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row form-group">
                    <label for="carrier" class="col-md-2 control-label bold">Country : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($number->country) ? $number->country : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="country" class="col-md-2 control-label bold">Number : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($number->number) ? $number->number : '0' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="operator" class="col-md-2 control-label bold">Setup Fee : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($number->setup_fee) ? $number->setup_fee : '0' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="network_type" class="col-md-2 control-label bold">Monthly Fee : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($number->monthly_fee) ? $number->monthly_fee : '0' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="network" class="col-md-2 control-label bold">Status : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ $number->allocated ? 'Yes' : 'No' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="network" class="col-md-2 control-label bold">Active : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ $number->active ? 'Yes' : 'No' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-10">
                        <a href="{{route('admin.number.index')}}" class="btn red">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: SAMPLE FORM PORTLET -->
    </div>
</div>
@endsection

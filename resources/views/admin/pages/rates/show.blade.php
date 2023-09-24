@extends('admin.layout.app')

@section('breadcrumb')
    {!! Breadcrumbs::render('view_rate', $rate) !!}
@endsection

@push('page_title_icon')
<i class="fa fa-money"></i>
@endpush

@section('content')
 <div class="row ">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-money font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">View Call Rate</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row form-group">
                    <label for="carrier" class="col-md-2 control-label bold">Carrier : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->carrier) ? $rate->carrier : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="country" class="col-md-2 control-label bold">Country : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->country) ? $rate->country : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="operator" class="col-md-2 control-label bold">Operator : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->operator) ? $rate->operator : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="network_type" class="col-md-2 control-label bold">Network Type : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->network_type) ? $rate->network_type : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="network" class="col-md-2 control-label bold">Network : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->network) ? $rate->network : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="abbreviation" class="col-md-2 control-label bold">Abbreviation : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->abbreviation) ? $rate->abbreviation : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="code" class="col-md-2 control-label bold">Code : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->code) ? $rate->code : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="link_1" class="col-md-2 control-label bold">Link 1 : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->link_1) ? $rate->link_1 : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="link_2" class="col-md-2 control-label bold">Link 2 : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->link_2) ? $rate->link_2 : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="link_3" class="col-md-2 control-label bold">Link 3 : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->link_3) ? $rate->link_3 : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="gprs" class="col-md-2 control-label bold">GPRS : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->gprs) ? 'Yes' : 'No' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="net_3g" class="col-md-2 control-label bold">3G : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->net_3g) ? 'Yes' : 'No' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="preferred" class="col-md-2 control-label bold">Preferred : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->preferred) ? 'Yes' : 'No' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="active" class="col-md-2 control-label bold">Active : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->active) ? 'Yes' : 'No' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="sms_in_rate" class="col-md-2 control-label bold">Incoming SMS Rate : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->sms_in_rate) ? $rate->sms_in_rate : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="sms_out_rate" class="col-md-2 control-label bold">Outgoing SMS Rate : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->sms_out_rate) ? $rate->sms_out_rate : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="xxsim_sms_rate" class="col-md-2 control-label bold">XXSim SMS Rate : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->xxsim_sms_rate) ? $rate->xxsim_sms_rate : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="zone" class="col-md-2 control-label bold">Zone : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->zone) ? $rate->zone : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="zone_rate" class="col-md-2 control-label bold">Zone Rate : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->zone_rate) ? $rate->zone_rate : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="gprs_rate" class="col-md-2 control-label bold">GPRS Rate : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->gprs_rate) ? $rate->gprs_rate : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="call_in_rate" class="col-md-2 control-label bold">Incoming Call Rate : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->call_in_rate) ? $rate->call_in_rate : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="call_out_rate" class="col-md-2 control-label bold">Outgoing Call Rate : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->call_out_rate) ? $rate->call_out_rate : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="extra_rate" class="col-md-2 control-label bold">Extra Rate : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->extra_rate) ? $rate->extra_rate : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="xxsim_call_rate" class="col-md-2 control-label bold">XXSim Call Rate : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->xxsim_call_rate) ? $rate->xxsim_call_rate : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="call_xxsim_to_xxsim" class="col-md-2 control-label bold">XXSim To XXSim Call Rate : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->call_xxsim_to_xxsim) ? $rate->call_xxsim_to_xxsim : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="sms_xxsim_to_xxsim" class="col-md-2 control-label bold">XXSim To XXSim SMS Rate : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->sms_xxsim_to_xxsim) ? $rate->sms_xxsim_to_xxsim : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="voicemail" class="col-md-2 control-label bold">Voicemail Rate : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->voicemail) ? $rate->voicemail : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="comment" class="col-md-2 control-label bold">Comment : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($rate->comment) ? $rate->comment : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-10">
                        <a href="{{route('admin.rate.index')}}" class="btn red">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: SAMPLE FORM PORTLET -->
    </div>
</div>
@endsection

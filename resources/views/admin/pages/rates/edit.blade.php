@extends('admin.layout.app')

@section('breadcrumb')
{!! Breadcrumbs::render('edit_rate', $rate) !!}
@endsection

@push('page_title_icon')
<i class="fa fa-money"></i>
@endpush

@push('page_css')
<style type="text/css">
    select{
        text-indent: 28px;
        cursor: pointer;
    }
</style>
@endpush

@section('content')
 <div class="row ">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-money font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">Edit Call rate</span>
                </div>
            </div>
            <div class="portlet-body">
                <form id="frmstore" class="form-horizontal" role="form" method="POST" action="{{ route('admin.rate.update', $rate->id) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group{{ $errors->has('carrier') ? ' has-error' : '' }}">
                        <label for="carrier" class="col-md-2 control-label">Carrier</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-font"></i>
                                <input type="text" class="form-control" name="carrier" id="carrier" placeholder="Enter Carrier" maxlength="255" value="{{ old('carrier', $rate->carrier) }}">
                                @if ($errors->has('carrier'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('carrier') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                        <label for="country" class="col-md-2 control-label">Country{!! $mend_sign !!}</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-globe"></i>
                                <select class="form-control" name="country" id="country" data-error-container="#error-country">
                                    <option value="" selected disabled>Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->name }}" @if(old('country', $rate->country) == $country->name) selected @endif>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                <span id="error-country"></span>
                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('operator') ? ' has-error' : '' }}">
                        <label for="operator" class="col-md-2 control-label">Operator</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-font"></i>
                                <input type="text" class="form-control" name="operator" id="operator" placeholder="Enter Operator" maxlength="255" value="{{ old('operator', $rate->operator) }}">
                                @if ($errors->has('operator'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('operator') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('network_type') ? ' has-error' : '' }}">
                        <label for="network_type" class="col-md-2 control-label">Network Type</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-font"></i>
                                <input type="text" class="form-control" name="network_type" id="network_type" placeholder="Enter Network Type" maxlength="255" value="{{ old('network_type', $rate->network_type) }}">
                                @if ($errors->has('network_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('network_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('network') ? ' has-error' : '' }}">
                        <label for="network" class="col-md-2 control-label">Network</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-font"></i>
                                <input type="text" class="form-control" name="network" id="network" placeholder="Enter Network" maxlength="255" value="{{ old('network', $rate->network) }}">
                                @if ($errors->has('network'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('network') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('abbreviation') ? ' has-error' : '' }}">
                        <label for="abbreviation" class="col-md-2 control-label">Abbreviation</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-font"></i>
                                <input type="text" class="form-control" name="abbreviation" id="abbreviation" placeholder="Enter Abbreviation" maxlength="255" value="{{ old('abbreviation', $rate->abbreviation) }}">
                                @if ($errors->has('abbreviation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('abbreviation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                        <label for="code" class="col-md-2 control-label">Code</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-font"></i>
                                <input type="text" class="form-control" name="code" id="code" placeholder="Enter Code" maxlength="255" value="{{ old('code', $rate->code) }}">
                                @if ($errors->has('code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('link_1') ? ' has-error' : '' }}">
                        <label for="link_1" class="col-md-2 control-label">Link 1</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-external-link"></i>
                                <input type="text" class="form-control" name="link_1" id="link_1" placeholder="Enter Link" maxlength="255" value="{{ old('link_1', $rate->link_1) }}">
                                @if ($errors->has('link_1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link_1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('link_2') ? ' has-error' : '' }}">
                        <label for="link_2" class="col-md-2 control-label">Link 2</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-external-link"></i>
                                <input type="text" class="form-control" name="link_2" id="link_2" placeholder="Enter Link" maxlength="255" value="{{ old('link_2', $rate->link_2) }}">
                                @if ($errors->has('link_2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link_2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('link_3') ? ' has-error' : '' }}">
                        <label for="link_3" class="col-md-2 control-label">Link 3</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-external-link"></i>
                                <input type="text" class="form-control" name="link_3" id="link_3" placeholder="Enter Link" maxlength="255" value="{{ old('link_3', $rate->link_3) }}">
                                @if ($errors->has('link_3'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link_3') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('gprs') ? ' has-error' : '' }}">
                        <label for="gprs" class="col-md-2 control-label">GPRS</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-search"></i>
                                <select class="form-control" name="gprs" id="gprs">
                                    <option value="1" @if(old('gprs', $rate->gprs) == 1) selected @endif>Yes</option>
                                    <option value="0" @if(old('gprs', $rate->gprs) == 0) selected @endif>No</option>
                                </select>
                                @if ($errors->has('gprs'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gprs') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('net_3g') ? ' has-error' : '' }}">
                        <label for="net_3g" class="col-md-2 control-label">3G</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-search"></i>
                                <select class="form-control" name="net_3g" id="net_3g">
                                    <option value="1" @if(old('net_3g', $rate->net_3g) == 1) selected @endif>Yes</option>
                                    <option value="0" @if(old('net_3g', $rate->net_3g) == 0) selected @endif>No</option>
                                </select>
                                @if ($errors->has('net_3g'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('net_3g') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('preferred') ? ' has-error' : '' }}">
                        <label for="preferred" class="col-md-2 control-label">Preferred</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-search"></i>
                                <select class="form-control" name="preferred" id="preferred">
                                    <option value="1" @if(old('preferred', $rate->preferred) == 1) selected @endif>Yes</option>
                                    <option value="0" @if(old('preferred', $rate->preferred) == 0) selected @endif>No</option>
                                </select>
                                @if ($errors->has('preferred'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('preferred') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('active') ? ' has-error' : '' }}">
                        <label for="active" class="col-md-2 control-label">Active</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-search"></i>
                                <select class="form-control" name="active" id="active">
                                    <option value="1" @if(old('active', $rate->active) == 1) selected @endif>Yes</option>
                                    <option value="0" @if(old('active', $rate->active) == 0) selected @endif>No</option>
                                </select>
                                @if ($errors->has('active'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('active') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('sms_in_rate') ? ' has-error' : '' }}">
                        <label for="sms_in_rate" class="col-md-2 control-label">Incoming SMS Rate</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-money"></i>
                                <input type="text" class="form-control" name="sms_in_rate" id="sms_in_rate" placeholder="Enter Incoming SMS rate" value="{{ old('sms_in_rate', $rate->sms_in_rate) }}">
                                @if ($errors->has('sms_in_rate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sms_in_rate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('sms_out_rate') ? ' has-error' : '' }}">
                        <label for="sms_out_rate" class="col-md-2 control-label">Outgoing SMS Rate</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-money"></i>
                                <input type="text" class="form-control" name="sms_out_rate" id="sms_out_rate" placeholder="Enter Outgoing SMS rate" value="{{ old('sms_out_rate', $rate->sms_out_rate) }}">
                                @if ($errors->has('sms_out_rate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sms_out_rate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('xxsim_sms_rate') ? ' has-error' : '' }}">
                        <label for="xxsim_sms_rate" class="col-md-2 control-label">XXSim SMS Rate</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-money"></i>
                                <input type="text" class="form-control" name="xxsim_sms_rate" id="xxsim_sms_rate" placeholder="Enter XXSim SMS rate" value="{{ old('xxsim_sms_rate', $rate->xxsim_sms_rate) }}">
                                @if ($errors->has('xxsim_sms_rate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('xxsim_sms_rate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('zone') ? ' has-error' : '' }}">
                        <label for="zone" class="col-md-2 control-label">Zone</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-street-view"></i>
                                <input type="text" class="form-control" name="zone" id="zone" placeholder="Enter Zone" value="{{ old('zone', $rate->zone) }}">
                                @if ($errors->has('zone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('zone_rate') ? ' has-error' : '' }}">
                        <label for="zone_rate" class="col-md-2 control-label">Zone Rate</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-money"></i>
                                <input type="text" class="form-control" name="zone_rate" id="zone_rate" placeholder="Enter Zone rate" value="{{ old('zone_rate', $rate->zone_rate) }}">
                                @if ($errors->has('zone_rate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zone_rate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('gprs_rate') ? ' has-error' : '' }}">
                        <label for="gprs_rate" class="col-md-2 control-label">GPRS Rate</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-money"></i>
                                <input type="text" class="form-control" name="gprs_rate" id="gprs_rate" placeholder="Enter GPRS rate" value="{{ old('gprs_rate', $rate->gprs_rate) }}">
                                @if ($errors->has('gprs_rate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gprs_rate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('call_in_rate') ? ' has-error' : '' }}">
                        <label for="call_in_rate" class="col-md-2 control-label">Incoming Call Rate</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-money"></i>
                                <input type="text" class="form-control" name="call_in_rate" id="call_in_rate" placeholder="Enter Incoming call rate" value="{{ old('call_in_rate', $rate->call_in_rate) }}">
                                @if ($errors->has('call_in_rate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('call_in_rate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('call_out_rate') ? ' has-error' : '' }}">
                        <label for="call_out_rate" class="col-md-2 control-label">Outgoing Call Rate</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-money"></i>
                                <input type="text" class="form-control" name="call_out_rate" id="call_out_rate" placeholder="Enter Outgoing call rate" value="{{ old('call_out_rate', $rate->call_out_rate) }}">
                                @if ($errors->has('call_out_rate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('call_out_rate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('extra_rate') ? ' has-error' : '' }}">
                        <label for="extra_rate" class="col-md-2 control-label">Extra Rate</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-money"></i>
                                <input type="text" class="form-control" name="extra_rate" id="extra_rate" placeholder="Enter Extra rate" value="{{ old('extra_rate', $rate->extra_rate) }}">
                                @if ($errors->has('extra_rate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('extra_rate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('xxsim_call_rate') ? ' has-error' : '' }}">
                        <label for="xxsim_call_rate" class="col-md-2 control-label">XXSim Call Rate</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-money"></i>
                                <input type="text" class="form-control" name="xxsim_call_rate" id="xxsim_call_rate" placeholder="Enter XXSim call rate" value="{{ old('xxsim_call_rate', $rate->xxsim_call_rate) }}">
                                @if ($errors->has('xxsim_call_rate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('xxsim_call_rate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('call_xxsim_to_xxsim') ? ' has-error' : '' }}">
                        <label for="call_xxsim_to_xxsim" class="col-md-2 control-label">XXSim To XXSim Call Rate</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-money"></i>
                                <input type="text" class="form-control" name="call_xxsim_to_xxsim" id="call_xxsim_to_xxsim" placeholder="Enter XXSim to XXSim call rate" value="{{ old('call_xxsim_to_xxsim', $rate->call_xxsim_to_xxsim) }}">
                                @if ($errors->has('call_xxsim_to_xxsim'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('call_xxsim_to_xxsim') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('sms_xxsim_to_xxsim') ? ' has-error' : '' }}">
                        <label for="sms_xxsim_to_xxsim" class="col-md-2 control-label">XXSim To XXSim SMS Rate</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-money"></i>
                                <input type="text" class="form-control" name="sms_xxsim_to_xxsim" id="sms_xxsim_to_xxsim" placeholder="Enter XXSim to XXSim SMS rate" value="{{ old('sms_xxsim_to_xxsim', $rate->sms_xxsim_to_xxsim) }}">
                                @if ($errors->has('sms_xxsim_to_xxsim'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sms_xxsim_to_xxsim') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('voicemail') ? ' has-error' : '' }}">
                        <label for="voicemail" class="col-md-2 control-label">Voicemail Rate</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-money"></i>
                                <input type="text" class="form-control" name="voicemail" id="voicemail" placeholder="Enter Voicemail rate" value="{{ old('voicemail', $rate->voicemail) }}">
                                @if ($errors->has('voicemail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('voicemail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('comment') ? ' has-error' : '' }}">
                        <label for="comment" class="col-md-2 control-label">Comment</label>
                        <div class="col-md-4">
                            <div class="input-icon">
                                <i class="fa fa-comments"></i>
                                <textarea class="form-control" name="comment" id="comment" placeholder="Enter comment..." rows="5">{{ old('comment', $rate->comment) }}</textarea>
                                @if ($errors->has('comment'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <button type="submit" class="btn green">Submit</button>
                            <a href="{{route('admin.rate.index')}}" class="btn red">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- End: SAMPLE FORM PORTLET -->
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $('#frmstore').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        rules: {
            country: {
                required: true,
            },
            link_1:{
                url: true,
            },
            link_2:{
                url: true,
            },
            link_3:{
                url: true,
            },
            sms_in_rate:{
                number: true,
                min: 0,
            },
            sms_out_rate:{
                number: true,
                min: 0,
            },
            xxsim_sms_rate:{
                number: true,
                min: 0,
            },
            zone:{
                digits: true,
                min: 0,
            },
            zone_rate:{
                number: true,
                min: 0,
            },
            gprs_rate:{
                number: true,
                min: 0,
            },
            call_in_rate:{
                number: true,
                min: 0,
            },
            call_out_rate:{
                number: true,
                min: 0,
            },
            extra_rate:{
                number: true,
                min: 0,
            },
            xxsim_call_rate:{
                number: true,
                min: 0,
            },
            call_xxsim_to_xxsim:{
                number: true,
                min: 0,
            },
            sms_xxsim_to_xxsim:{
                number: true,
                min: 0,
            },
            voicemail:{
                number: true,
                min: 0,
            },
        },

        messages: {
            country: {
                required: "@lang('validation.required', ['attribute'=>'country'])",
            },
        },

        invalidHandler: function (event, validator) { //display error alert on form submit   
            $('.alert-danger', $('#frmRegister')).show();
            $('#frmRegister').addClass('form-error');
        },

        highlight: function (element) { // hightlight error inputs
            $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },
        success: function (label) {
            label.closest('.form-group').removeClass('has-error');
            label.remove();
        },

        errorPlacement: function (error, element) {
            if (element.attr("data-error-container")) {
                error.appendTo(element.attr("data-error-container"));
            } else {
                error.insertAfter(element);
            }
        },

        submitHandler: function (form) {
            $('#frmRegister').removeClass('form-error');
            form.submit();
        }
    });

    $(document).on('submit','#frmstore',function(){
        if($("#frmstore").valid()){
            return true;
        }else{
            return false;
        }
    });
});

</script>
@endpush

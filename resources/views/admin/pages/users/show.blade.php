@extends('admin.layout.app')

@section('breadcrumb')
    {!! Breadcrumbs::render('view_user', $user) !!}
@endsection

@push('page_title_icon')
<i class="fa fa-users"></i>
@endpush

@section('content')
 <div class="row ">
    <div class="col-md-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user font-green"></i>
                    <span class="caption-subject font-green sbold uppercase">View User</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row form-group">
                    <label for="name" class="col-md-2 control-label bold">User Name : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($user->contact->firstname) ? $user->contact->firstname : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="name" class="col-md-2 control-label bold">User Surname : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($user->contact->lastname) ? $user->contact->lastname : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="name" class="col-md-2 control-label bold">Email : </label>
                    <div class="col-md-4">
                        <label class="control-label">{!! !empty($user->contact->email) ? '<a href="mailto:' . $user->contact->email . '" >' . $user->contact->email . '</a>' : 'N/A' !!}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="name" class="col-md-2 control-label bold">Current Phone Number : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($user->contact->phone) ? $user->contact->phone : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="name" class="col-md-2 control-label bold">Current Mobile Number : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($user->contact->mobile) ? $user->contact->mobile : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="name" class="col-md-2 control-label bold">Date Of Birth : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($user->birthsdate) ? date('Y-m-d', strtotime($user->birthsdate)) : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="name" class="col-md-2 control-label bold">Address : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($user->contact->address) ? $user->contact->address : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="name" class="col-md-2 control-label bold">Zip code : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($user->contact->zip) ? $user->contact->zip : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="name" class="col-md-2 control-label bold">City : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($user->contact->city) ? $user->contact->city : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="name" class="col-md-2 control-label bold">Country : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($user->contact->country) ? $user->contact->country->name : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="name" class="col-md-2 control-label bold">Currency : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($user->contact->currency) ? $user->contact->currency : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="name" class="col-md-2 control-label bold">Type of document : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($user->contact->document) ? $user->contact->document : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="name" class="col-md-2 control-label bold">Document Number : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($user->contact->document_no) ? $user->contact->document_no : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <label for="name" class="col-md-2 control-label bold">Company : </label>
                    <div class="col-md-4">
                        <label class="control-label">{{ !empty($user->contact->business_name) ? $user->contact->business_name : 'N/A' }}</label>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-10">
                        <a href="{{route('admin.user.index')}}" class="btn red">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: SAMPLE FORM PORTLET -->
    </div>
</div>
@endsection

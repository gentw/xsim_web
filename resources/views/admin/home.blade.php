@extends('admin.layout.app')

@section('breadcrumb')
{!! Breadcrumbs::render('dashboard') !!}
@endsection

@section('content')
<div class="row margin-top-10">
    <div class="row widget-row">
      <div class="col-md-3">
        <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 bordered">
            <a class="dashboard-stat-v2" href="{{ route('admin.user.index') }}">
              <h4 class="widget-thumb-heading">Total Users</h4>
              <div class="widget-thumb-wrap">
                  <i class="widget-thumb-icon bg-green fa fa-bar-chart"></i>
                  <div class="widget-thumb-body">
                      <span class="widget-thumb-subtitle"></span>
                      <span class="widget-thumb-body-stat" data-counter="counterup" >{{ $count['user'] }}</span>
                  </div>
              </div>
            </a>
        </div>
      </div>
    </div>
</div>
@endsection

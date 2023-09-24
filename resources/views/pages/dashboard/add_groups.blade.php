@foreach($groups as $group)
<li>
    <div class="group-name">{{ $group->corp_remark }}</div>
    <a href="#" data-group="{{ $group->corp_group }}" class="icon edit-group"><img src="{{ asset('dashboard/images/edit-big.png') }}" alt="edit" /></a>
    <input type="text" class="form-control min-rate" placeholder="Minimum amount balance" />
    <input type="text" class="form-control max-rate" placeholder="Maximum amount balance" />
    <button data-group="{{$group->corp_group}}" class="change-group-rate" type="buttton"><img src="{{ asset('dashboard/images/right-mark.png') }}" alt="edit" /></button>
    <div class="add add-cards" data-group="{{ $group->corp_group }}"><img src="{{ asset('dashboard/images/add-group.png') }}" alt="add"></div>
    <div class="clearfix"></div>
    <ul id="card-list-{{ $group->corp_group }}" data-group="{{ $group->corp_group }}" class="inner-list">
        <img src="{{ asset('global/images/loader.gif') }}">
    </ul>
</li>
@endforeach
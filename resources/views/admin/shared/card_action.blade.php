@if (in_array('add', $permissions) || in_array('delete', $permissions))
	@if (in_array('add', $permissions))
		<a href="{{ route($routeName.'.add_balance', $id) }}" title="View" class="btn btn-success btn-xs">Add Balance</a>
		<a href="{{ route($routeName.'.add_number', $id) }}" title="View" class="btn btn-info btn-xs">Add National Number</a>
	@endif
	@if (in_array('delete', $permissions) && $remove)
		<a href="{{ route($routeName.'.remove_number_list', $id) }}" data-enumNumber="{{$enumNumber}}" title="View" class="btn btn-danger btn-xs">Remove National Number</a>
	@endif
    @if (in_array('delete', $permissions))
        <a href="{{ route($routeName.'.remove_card', [$user_id,$card]) }}" data-enumNumber="{{$enumNumber}}" title="View" class="btn btn-danger btn-xs remove-card">Remove Card</a>
    @endif
	@if (in_array('edit', $permissions))
		<a href="{{ route($routeName.'.change_validity', $id) }}" title="View" class="btn btn-warning btn-xs">Change Validity</a>
	@endif
@endif

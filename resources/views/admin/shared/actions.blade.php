@if (in_array('view', $permissions) || in_array('edit', $permissions) || in_array('delete', $permissions))
	@if (in_array('view', $permissions))
		<a href="{{ route($routeName.'.show', $id) }}" title="View" class="btn btn-success btn-xs">View</a>
	@endif
	@if (in_array('edit', $permissions))
		<a href="{{ route($routeName.'.edit', $id) }}" title="Edit" class="btn btn-warning btn-xs">Edit</a>
	@endif
	@if (in_array('delete', $permissions))
		<a title="Delete" href="{{ route($routeName.'.destroy', $id) }}" class="btn btn-danger btn-xs act-delete">Delete</a>
	@endif
	@if (in_array('view', $permissions) && !empty($user) && $user)
		<a href="{{ route($routeName.'.cards', $id) }}" title="View" class="btn btn-info btn-xs">Cards</a>
	@endif
@endif
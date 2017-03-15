<ul class="list-group">
@foreach($user->appointments->sortBy('datetime') as $app)
	<li class="list-group-item">
		<div class="col-md-2 app-list-col">
			Dr. Wong Chung
		</div>
		<div class="col-md-2 app-list-col">
			{{ $app->a_date }}
		</div>
		<div class="col-md-1 app-list-col">
			{{ $app->a_time }}
		</div>
		<div class="col-md-4 app-list-col">
			{{ $app->a_details }}
		</div>
		<div class="col-md-1 app-list-col">
			<a href="/user/{{ $app->user->id }}/appointments/{{ $app->id }}/">View</a>
		</div>
		<div class="col-md-1 app-list-col">
			Edit
		</div>
		<div class="col-md-1 app-list-col last">
			Delete
		</div>
	
	</li>
@endforeach
</ul>
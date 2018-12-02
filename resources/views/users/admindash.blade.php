@extends('partitions.master')

@section('title','Best Bid')

@section('body')
<div class="panel panel-default">
	<div class="panel-heading">
		<p class="text-center">Users </p>
	</div>
	<div class="panel-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
				<tr>
					<td>{{ $user->firstname }}</td>
					<td>{{ $user->lastname }}</td>
					<td>{{ $user->email }}</td>
					<td>{{ $user->bannedText }}</td>
					<td><a href="{{ url('/profile/'.$user->id) }}" class="btn btn-primary">View Profile</button></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
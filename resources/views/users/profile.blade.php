@extends('partitions.master')

@section('title','Profile')

@section('body')

<div class="container">
	@include('users.profile-navbar')
	@if(Session::has('message'))
	<div class="alert alert-info">
		{{ Session::get('message') }}
	</div>
	@endif
	<div class="panel panel-default">
		<div class="panel-heading">
			<p class="text-center">Personal Information </p>
		</div>
		<div class="modal-body">
			<form action="{{ url('/profile') }}" method="post">
				{{ csrf_field() }}
				<input type="hidden" id="userid" name="userid">
				<div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
					First Name
					<input name="firstname" class="form-control" type="text" value="{{ auth()->user()->firstname }}" id="firstname">
					@if ($errors->has('firstname'))
					<span class="help-block">
						<strong>{{ $errors->first('firstname') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
					Last Name
					<input name="lastname" class="form-control" type="text" value="{{ auth()->user()->lastname }}" id="lastname">
					@if ($errors->has('lastname'))
					<span class="help-block">
						<strong>{{ $errors->first('lastname') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
					Address
					<input name="address" class="form-control" type="text" value="{{ auth()->user()->address}}" id="address">
					@if ($errors->has('address'))
					<span class="help-block">
						<strong>{{ $errors->first('address') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					Email-Address
					<input name="email" class="form-control" type="text" value="{{ auth()->user()->email }}" id="email">
					@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
					Contact Number
					<input name="contact" class="form-control" type="text" value="{{ auth()->user()->contact}}" id="contact">
					@if ($errors->has('contact'))
					<span class="help-block">
						<strong>{{ $errors->first('contact') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					<input type="submit" name="submit" value="Submit" class="btn btn-success">
				</div>
			</form>
			<button id="changePasswordBtn" class="btn btn-warning">Change Password</button>
		</div>
	</div>

	<div id="changePasswordPanel" class="panel panel-default">
		<div class="panel-heading">Change Password</div>
		<div class="panel-body">
			<form action="{{ url('/profile/password') }}" method="post">
				{{ csrf_field() }}
				<div class="form-group" {{ $errors->has('oldpassword') ? ' has-error' : '' }}">
					Old Password
					<input class="form-control" type="password" name="oldpassword" id="oldpassword">
					@if ($errors->has('oldpassword'))
					<span class="help-block">
						<strong>{{ $errors->first('oldpassword') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group" {{ $errors->has('newpassword') ? ' has-error' : '' }}">
					New Password
					<input class="form-control" type="password" name="newpassword" id="newpassword">
					@if ($errors->has('newpassword'))
					<span class="help-block">
						<strong>{{ $errors->first('newpassword') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group" {{ $errors->has('newpassword_confirmation') ? ' has-error' : '' }}">
					Confirm New Password
					<input class="form-control" type="password" name="newpassword_confirmation" id="newpassword_confirmation">
					@if ($errors->has('newpassword_confirmation'))
					<span class="help-block">
						<strong>{{ $errors->first('newpassword_confirmation') }}</strong>
					</span>
					@endif
				</div>
				<div class="form-group">
					<input type="submit" name="submit" value="Change Password" class="btn btn-success">
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#changePasswordPanel').toggle();
		$('#changePasswordBtn').click(function(){
			$('#changePasswordPanel').toggle();
			location.href = "#";
			location.href = "#changePasswordPanel";
		});
	});
</script>
@endsection
@if(Auth::check())
<div id="notifications" class="modal notificationModal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title text-center">Notifications</h4>
			</div>
			<div class="modal-body">
				@foreach(auth()->user()->latestNotifications() as $notification)
				@if(!$notification->seen)
				<div class="bg-success">
					@endif
					@if($notification->type=="winner")
					You have won an auction! <a href="{{ url('/auction/'.$notification->auction->id) }}" class="btn btn-primary">View Auction</a>
					@elseif($notification->type=="seller")
					You auction has a winner! <a href="{{ url('/auction/'.$notification->auction->id) }}" class="btn btn-primary">View Auction</a>
					@else
					You auction has ended with no bids! <a href="{{ url('/auction/'.$notification->auction->id) }}" class="btn btn-primary">View Auction</a>
					@endif
					@if(!$notification->seen)
				</div>
				@endif
				<hr>
				@endforeach
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	$('#notifications').on('shown.bs.modal',function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.post("{{ url('/notification/update') }}",{
			user_id: "{{ auth()->user()->id }}"
		},function(data,status){
			console.log('notifications updated');
		});
	});
</script>
@endif
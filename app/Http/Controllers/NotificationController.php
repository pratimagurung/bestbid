<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;

class NotificationController extends Controller
{
	public function update(Request $request){
		$notifications = Notification::where('user_id',$request->user_id)->where('seen',0)->get();
		if(count($notifications)){
			foreach ($notifications as $notification) {
				$notification->seen = 1;
				$notification->update();
			}
		}
		return response()->json([],200);
	}
}

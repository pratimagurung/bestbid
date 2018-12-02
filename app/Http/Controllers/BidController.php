<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Auction;
use App\Bid;

class BidController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

	public function addBid(Request $request){
		$this->validate($request,[
			'bidAmount' => 'required|between:1,999999.99'
		]);
		$currentAuction = Auction::find($request->auction_id);
		$minimumPrice = $currentAuction->current_price + $currentAuction->bidincrement;
		if($request->bidAmount<$minimumPrice){
			$request->session()->flash('message', 
			'Your Bid Price is less than the Minimum Bid Price!');
			return redirect()->back();
		}
		$bid = new Bid;
		$bid->amount = $request->bidAmount;
		$bid->datetime = \Carbon\Carbon::now();
		$bid->user_id = auth()->user()->id;
		$bid->auction_id = $request->auction_id;
		$bid->save();
		$request->session()->flash('message', 'Your Bid Has Been Placed!!');
		return redirect()->back();
	}
}

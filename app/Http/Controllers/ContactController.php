<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auction;
use App\Mail\YouHaveWonAnAuction;
use App\Mail\YourAuctionHaveWinner;
use Mail;

class ContactController extends Controller
{
    public function showContactWinnerForm($auctionid){
    	$auction = Auction::find($auctionid);
    	return view('contacts.contactwinner',compact('auction'));
    }

    public function showContactSellerForm($auctionid){
        $auction = Auction::find($auctionid);
        return view('contacts.contactseller',compact('auction'));
    }

    public function contactWinner(Request $request){
    	$auction = Auction::find($request->auction);
    	Mail::to($auction->auction_winner->email)->send(new YouHaveWonAnAuction($request->message,$auction));
    	$request->session()->flash('message','Mail sent to the winner.');
    	return redirect('/auction/'.$request->auction);
    }

    public function contactSeller(Request $request){
    	$auction = Auction::find($request->auction);
    	Mail::to($auction->auction_seller->email)->send(new YourAuctionHaveWinner($request->message,$auction));
    	$request->session()->flash('message','Mail sent to the seller.');
    	return redirect('/auction/'.$request->auction);
    }
}

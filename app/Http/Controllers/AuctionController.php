<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Auction;
use App\Product;

class AuctionController extends Controller
{
	public function addAuction(Request $request){
		$this->validate($request,[
			'name' => 'required|min:2',
			'productid' => 'required',
			'auctionstartdate' => 'required|date',
			'auctionenddate' => 'required|date',
			'startprice' => 'required|between:1,999999.99',
			'bidincrement' => 'required|between:1,1000.99'
		]);

		$starthour = $request->starthour;
		$endhour = $request->endhour;
		if($request->startampm=="PM" && $starthour<12){
			$starthour = $request->starthour+12;
		}
		if($request->endampm=="PM" && $endhour<12){
			$endhour = $request->endhour+12;
		}
		//string length
		$startminute = $request->startminute;
		if(strlen((string) $startminute)<2){
			$startminute = '0'.$startminute;
		}

		$endminute = $request->endminute;
		if(strlen((string) $endminute)<2){
			$endminute = '0'.$endminute;
		}

		$startdate = $request->auctionstartdate.' '.$starthour.':'.$startminute.':00';
		$enddate = $request->auctionenddate.' '.$endhour.':'.$endminute.':00';
		//string to time
		if(strtotime($enddate)<strtotime($startdate) || strtotime($startdate)<time()){
			$request->session()->flash('message', 'Invalid Start or End Date/Time.');
			return redirect()->back();
		}
		//product auction ma xa ki nai check gareko (restart auction)
		$product = Product::find($request->productid);
		if($product->is_in_auction){
			$auction = $product->auction;
			$auction->auctionname = $request->name;
			$auction->startdate = $startdate;
			$auction->enddate = $enddate;
			$auction->startprice = $request->startprice;
			$auction->bidincrement = $request->bidincrement;
			$auction->save();
			$auction->notifications()->delete();
			$request->session()->flash('message', 'Auction will be started at 
			'.$auction->startdate.' and will end at '.$auction->enddate);
			return redirect()->back();
		}
		//tyo product auction ma xaena vane naya auction banxa
		$auction = new Auction;
		$auction->auctionname = $request->name;
		$auction->startdate = $startdate;
		$auction->enddate = $enddate;
		$auction->startprice = $request->startprice;
		$auction->bidincrement = $request->bidincrement;
		$auction->auctionstate = 'open';
		$auction->product_id = $request->productid;
		$auction->user_id = auth()->user()->id;
		$auction->save();
		$request->session()->flash('message', 'Auction will be started at
		 '.$auction->startdate.' and will end at '.$auction->enddate);
		return redirect()->back();
	}

	public function showAuction($auctionId){
		$auction = Auction::find($auctionId);
		return view('auctions.auction',compact('auction'));// data pass garni 
	}
	//carbon date time set garna 
	public function showAuctionGallery(){
		$auctions = Auction::where('enddate','>',\Carbon\Carbon::now())->paginate(2);
		return view('auctions.auctiongallery',compact('auctions'));
	}

	public function showBuyItNow(){
		$auctions = Auction::paginate(2);
		return view('auctions.buyitnow',compact('auctions'));
	}

	public function showStartingSoon(){
		$auctions = Auction::where('startdate','>',\Carbon\Carbon::now())->paginate(2);
		return view('auctions.startingsoon',compact('auctions'));
	}

	public function showEndingSoon(){
		$auctions = Auction::where('enddate','>=',\Carbon\Carbon::now())->where('enddate','<=',\Carbon\Carbon::now()->minute(date('i')+30))->paginate(2);
		return view('auctions.endingsoon',compact('auctions'));
	}

	public function onGoingAuctions(){
		return Auction::where('enddate','>',\Carbon\Carbon::now())->where('startdate','<',\Carbon\Carbon::now())->get();
	}

	public function search(Request $request){
		$searchTerm = $request->get('searchTerm');
		$auctions = Auction::where('auctionname','LIKE','%'.$searchTerm.'%')->paginate(2);
		return view('auctions.searchauction',compact('auctions'));
	}

	public function index(){
		$auctions = $this->onGoingAuctions();
		return view('auctions.index',compact('auctions'));
	}

	public function deleteAuction(Request $request){
		$auction = Auction::find($request->auction_id);
		if(auth()->user()->id==$auction->user_id){
			$auction->notifications()->delete();
			$auction->delete();
			$request->session()->flash('message', 'Auction has been deleted');
			return redirect('/products');
		}
		abort(404);
	}

}

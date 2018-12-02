<?php

namespace App; //virtual folder

// uses Eloquent Model - when a model is related to a table. it inherits all the attributes of the table.

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
	protected $dates = ['startdate','enddate'];
	protected $appends = ['remaining_time','is_active','current_price','auction_winner','has_winner','auction_seller','is_in_future'];

	public function category(){
		return $this->hasManyThrough('App\Category','App\Product');
	}

	public function notifications(){
		return $this->hasMany(Notification::class);
	}

	public function bids(){
		return $this->hasMany(Bid::class);
	}

	public function product(){
		return $this->belongsTo(Product::class);
	}

	public function user(){
		return $this->belongsTo(User::class);
	}

	public function getRemainingTimeAttribute(){
		return strtotime($this->enddate) - time();
	}

	public function getIsActiveAttribute(){
		return $this->remaining_time>0;
	}

	public function getCurrentPriceAttribute(){
		if(count($this->bids)==0){
			return $this->startprice;
		}
		return $this->bids->last()->amount;
	}

	public function getAuctionWinnerAttribute(){
		if(count($this->bids)){
			return $this->bids->last()->user;
		}
		return null;
	}

	public function getAuctionSellerAttribute(){
		return $this->product->user;
	}

	public function getHasWinnerAttribute(){
		if(count($this->auction_winner)){
			return true;
		}
		return false;
	}

	public function getIsInFutureAttribute(){
		return strtotime($this->startdate)>time();
	}
}

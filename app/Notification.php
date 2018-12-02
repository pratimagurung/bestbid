<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

	protected $appends = ['type'];

	public function user(){
		return $this->belongsTo(User::class);
	}
	
	public function auction(){
		return $this->belongsTo(Auction::class);
	}

	public function getTypeAttribute(){
		if($this->auction->has_winner){
			if($this->auction->auction_winner->id==$this->user_id){
				return "winner";
			}
			return "seller";
		}
		else{
			return "sellernowinner";
		}
	}
}

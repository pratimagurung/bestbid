<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

	protected $appends = ['is_in_auction'];

    public function category(){
    	return $this->belongsTo(Category::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function auction(){
        return $this->hasOne(Auction::class);
    }

    public function getIsInAuctionAttribute(){
    	if(count(Auction::where('product_id','=',$this->id)->get())){
    		return true;
    	}
    	return false;
    }

}

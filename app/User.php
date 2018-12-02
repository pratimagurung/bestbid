<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'firstname', 'lastname', 'email', 'address','contact', 'gender', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['is_admin','is_banned','ban_reason','notification_count'];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function notifications(){
        return $this->hasMany(Notification::class);
    }

    public function bids(){
        return $this->hasMany(Bid::class);
    }
    
    public function auctions(){
        return $this->hasMany(Auction::class);
    }
    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function getIsAdminAttribute(){
        $data = DB::table('admins')->where('user_id','=',$this->id)->first();
        return count($data);
    }

    public function getIsBannedAttribute(){
        $data = DB::table('bannedusers')->where('user_id','=',$this->id)->first();
        return count($data);
    }

    public function getBanReasonAttribute(){
        $data = DB::table('bannedusers')->where('user_id',$this->id)->first();
        if(count($data)){
            return $data->reason;            
        }
        return "none";
    }

    public function getBannedTextAttribute(){
        if($this->is_banned){
            return "Banned";
        }
        return "Not Banned";
    }

    public function latestNotifications(){
        return $this->notifications()->orderBy('id','desc')->limit(10)->get();
    }

    public function getNotificationCountAttribute(){
        return $this->notifications()->where('seen','0')->count();
    }
}

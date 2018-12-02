<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;

class UserController extends Controller
{
	public function showProfile(){
		$user = auth()->user();
		return view('users.profile',compact('user'));
	}

	public function showUserProfile($id){
		$user = User::find($id);
		return view('users.userprofile',compact('user'));
	}

	public function showAllUsers(){
		$users = User::paginate(10);
		return view('users.admindash',compact('users'));
	}

	public function editProfile(Request $request){
		$this->validate($request,[
			'firstname' => 'required',
			'lastname' => 'required',
			'address' => 'required',
			'email' => 'required|email',
			'contact' => 'required'
		]);
		$user = auth()->user();
		$user->firstname = $request->firstname;
		$user->lastname = $request->lastname;
		$user->address = $request->address;
		$user->email = $request->email;
		$user->contact = $request->contact;
		$user->save();
		$request->session()->flash('message','Profile successfully updated.');
		return redirect()->back();
	}

	public function changePassword(Request $request){
		$this->validate($request,[
			'oldpassword' => 'required',
			'newpassword' => 'required|min:6|confirmed'
		]);
		$user = auth()->user();
		$hashedPassword = $user->password;
		if(Hash::check($request->oldpassword, $hashedPassword)){
			$user->password = Hash::make($request->newpassword);
			$request->session()->flash("message","Password successfully changed.");
			return redirect()->back();
		}
		$request->session()->flash("message","Old password didn't match");
		return redirect()->back();
	}

	public function banUser(Request $request){
		DB::table('bannedusers')->insert([
			'user_id' => $request->userid,
			'status' => 'banned',
			'reason' => $request->reason
		]);
		$request->session()->flash("message","User has been banned");
		return redirect()->back();
	}

		public function unbanUser(Request $request){
		DB::table('bannedusers')->where('user_id',$request->userid)->delete();
		$request->session()->flash("message","User has been unbanned");
		return redirect()->back();
	}

	public function myAuctions(){
		return view('auctions.myauction');
	}

		public function myBids(){
		return view('bids.mybids');
	}

	public function allUser(){
 	if(!auth()->user()->is_admin){
 		abort(404);
 	}
 	$dt = Carbon::create(date('Y'),date('m'),date('d'),0);
 	$users = User::where('created_at','>=',$dt->subMonth())->get();
 	return view('admin.admin',compact('users'));
 }

}

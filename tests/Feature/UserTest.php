<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use DB;

class UserTest extends TestCase
{
	use RefreshDatabase;

	public function test_registration_form(){
		$this->get('/register')->assertSee('Register');
	}

	public function test_login_form(){
		$this->get('/login')->assertSee('Login');
	}

	public function test_user_banned(){
		$user = factory(\App\User::class)->create();
		DB::table('bannedusers')->insert(['user_id' => $user->id, 'status'=> '1', 'reason' => 'Testing']);
		$this->assertTrue(1==$user->is_banned);
	}

	public function test_user_admin(){
		$user = factory(\App\User::class)->create();
		DB::table('admins')->insert(['user_id' => $user->id, 'role'=> 'admin']);
		$this->assertTrue(1==$user->is_admin);
	}

}

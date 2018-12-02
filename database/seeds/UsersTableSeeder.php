<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$user = new App\User;
    	$user->firstname = 'Pratima';
    	$user->lastname = 'Gurung';
    	$user->password = bcrypt('000111');
    	$user->email = 'prettygrg@gmail.com';
    	$user->address = 'KTM';
    	$user->contact = '9872525252';
    	$user->gender = 'Female';
    	$user->save();

    	DB::table('admins')->insert([
    		'role' => 'admin',
    		'user_id' => $user->id
    	]);
    }
}

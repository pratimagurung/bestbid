<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$categories = array(
    		array('categoryname' => 'Art'),
    		array('categoryname' => 'Computers & Electronics'),
    		array('categoryname' => 'Jewellery & Gemstones'),
    		array('categoryname' => 'Fashion'),
    		array('categoryname' => 'Books/Movies/Music'),
    		array('categoryname' => 'Musical Instruments'),
    		array('categoryname' => 'Wedding'),
    		array('categoryname' => 'Toys/Dolls/Games'),
    		array('categoryname' => 'Transportation'),
    		array('categoryname' => 'Sports'),
    		array('categoryname' => 'Tableware and Kitchenware'),
    	);
    	DB::table('categories')->insert($categories);
    }
}

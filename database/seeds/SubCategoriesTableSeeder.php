<?php

use Illuminate\Database\Seeder;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategories = array(
    		array('name' => 'Handicraft','category_id' => 1),
    		array('name' => 'Drawings','category_id' => 1),
    		array('name' => 'Paintings','category_id' => 1),
    		array('name' => 'Computers','category_id' => 2),
    		array('name' => 'Home Electronics','category_id' => 2),
    		array('name' => 'Mobile Phones','category_id' => 2),
    		array('name' => 'Bracelets','category_id' => 3),
    		array('name' => 'Earrings','category_id' => 3),
    		array('name' => 'Necklaces','category_id' => 3),
    		array('name' => 'Pendants','category_id' => 3),
    		array('name' => 'Rings','category_id' => 3),
            array('name' => 'Watches','category_id' => 3),
    		array('name' => 'Childrens','category_id' => 4),
    		array('name' => 'Mens','category_id' => 4),
    		array('name' => 'Womens','category_id' => 4),
            array('name' => 'Shoes','category_id' => 4),
            array('name' => 'Bags','category_id' => 4),
    		array('name' => 'Books','category_id' => 5),
    		array('name' => 'Movies','category_id' => 5),
    		array('name' => 'Music','category_id' => 5),
    		array('name' => 'Guitars & Basses','category_id' => 6),
    		array('name' => 'Banjos','category_id' => 6),
    		array('name' => 'Orchestral','category_id' => 6),
    		array('name' => 'Dresses','category_id' => 7),
    		array('name' => 'Mens Formal Wear','category_id' => 7),
    		array('name' => 'Dolls','category_id' => 8),
    		array('name' => 'Toys','category_id' => 8),
    		array('name' => 'Games','category_id' => 8),
    		array('name' => 'Cars','category_id' => 9),
    		array('name' => 'Motorcycle','category_id' => 9),
    		array('name' => 'Sporting Equipment','category_id' => 10),
    		array('name' => 'Dinnerware','category_id' => 11),
    		array('name' => 'Glassware','category_id' => 11),
    		array('name' => 'Cookware','category_id' => 11),
    		array('name' => 'Tea & Coffee Accessories','category_id' => 11),
    	);
    	DB::table('sub_categories')->insert($subcategories);
    }
}

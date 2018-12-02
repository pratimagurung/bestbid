<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/','AuctionController@index');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//product route
Route::get('/product','ProductController@showProductAddForm')->middleware('auth');
Route::post('/product','ProductController@addProduct')->middleware('auth');
Route::get('/products','ProductController@viewMyProducts')->middleware('auth');

//auction route
Route::post('/auction','AuctionController@addAuction')->middleware('auth');
Route::get('/auction/{auction}','AuctionController@showAuction');
Route::get('/auction-gallery','AuctionController@showAuctionGallery');
Route::post('/auction/delete','AuctionController@deleteAuction')->middleware('auth');

//bid routes
Route::post('/bid','BidController@addBid')->middleware('auth');

//buy it now
Route::get('/buy-it-now','AuctionController@showBuyItNow');

//startingsoon
Route::get('/startingsoon','AuctionController@showStartingSoon');

//endingsoon
Route::get('/endingsoon','AuctionController@showEndingSoon');

//search
Route::get('/search','AuctionController@search');

//category
Route::get('/category','CategoryController@showCategoryAddForm')->middleware('auth');
Route::post('/category','CategoryController@addCategory');
Route::get('/category/{id}','SubCategoryController@getSubCategories');
Route::get('/show-category/{categoryname}','CategoryController@showAuctionsInCategory');
Route::post('/category/delete','CategoryController@delete');
Route::post('/category/edit','CategoryController@edit');

//subcategory
Route::post('/subcategory','SubCategoryController@addSubCategory');
Route::get('/show-category/{categoryname}/{subcategoryname}','SubCategoryController@showAuctionsInSubCategory');
Route::post('/subcategory/delete','SubCategoryController@delete');
Route::post('/subcategory/edit','SubCategoryController@edit');

//contact
Route::get('/contact/winner/{auctionid}','ContactController@showContactWinnerForm');
Route::get('/contact/seller/{auctionid}','ContactController@showContactSellerForm');
Route::post('/contact/winner','ContactController@contactWinner')->middleware('auth');
Route::post('/contact/seller','ContactController@contactSeller')->middleware('auth');

//profile
Route::get('/profile','UserController@showProfile')->middleware('auth');
Route::get('/profile/auctions','UserController@myAuctions')->name('myauctions')->middleware('auth');
Route::get('/profile/bids','UserController@myBids')->name('mybids')->middleware('auth');
Route::get('/profile/{id}','UserController@showUserProfile')->middleware('auth');
Route::post('/profile','UserController@editProfile')->middleware('auth');
Route::post('/profile/password','UserController@changePassword')->middleware('auth');

//admin
Route::get('/admindash/users','UserController@showAllUsers')->middleware('auth');
Route::post('/ban-user','UserController@banUser');
Route::post('/unban-user','UserController@unbanUser');

//notification
Route::post('/notification/update','NotificationController@update')->middleware('auth');
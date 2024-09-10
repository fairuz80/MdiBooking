<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//auth route for both 
Route::group(['middleware' => ['auth']], function() { 

    // User

    Route::get('/User/listUser', 'UserController@showUser')->name('list.User');

    Route::get('/User/createUserExcel', 'UserController@createUserExcel')->name('excel.User');

    Route::post('/User/saveUserExcel', 'UserController@saveUserExcel')->name('excel.Save');

    Route::get('/User/createUser', 'UserController@createUser')->name('create.User');

    Route::post('/User/storeUser', 'UserController@storeUser')->name('store.User');

    Route::get('/User/{id}/editUserPass', 'UserController@editUserPass')->name('edit.Pass');

    Route::get('/User/{id}/editUserBio', 'UserController@editUserBio')->name('edit.Bio');

    Route::post('/User/updateUserPass', 'UserController@updateUserPass')->name('update.Pass');

    Route::post('/User/updateUserBio', 'UserController@updateUserBio')->name('update.Bio');

    Route::get('/User/{id}/deleteUser', 'UserController@destroyUser')->name('delete.User');

    /* Route::get('/User/profile', 'UserController@profile')->name('daftar.profile');

    Route::post('/User/profile', 'UserController@profile1')->name('daftar.profile1'); */

    // ebooking

    Route::get('/Booking/listBooking', 'EbookinController@show')->name('list.booking');

    Route::get('/Booking/createBooking', 'EbookinController@create')->name('create.booking');

    Route::post('/Booking/storeBooking', 'EbookinController@store')->name('store.booking');

    Route::get('/Booking/{id}/pengesahanBKP', 'EbookinController@pengesahanBKP')->name('pengesahanBKP.booking');

    Route::post('/Booking/pengesahanBKP', 'EbookinController@pengesahanBKP2')->name('pengesahanBKP2.booking');

    Route::get('/Booking/{id}/editBooking', 'EbookinController@edit')->name('edit.booking');

    Route::post('/Booking/editBooking', 'EbookinController@update')->name('update.booking');

    Route::get('/Booking/{id}/changeBooking', 'EbookinController@changeEdit')->name('change1.booking');

    Route::post('/Booking/changeBooking', 'EbookinController@changeUpdate')->name('change2.booking');

    Route::get('/Booking/{id}/deleteBooking', 'EbookinController@destroy')->name('destroy.booking');

    Route::get('/Booking/indexBooking', 'EbookinController@index')->name('index.booking');

    Route::get('/Booking/searchIDBooking', 'EbookinController@searchIDbooking')->name('searchID.booking');

    Route::get('/Booking/reportBooking', 'EbookinController@reportbooking')->name('report.booking');

    Route::get('/Booking/calenderEvent', 'EbookinController@calenderEvent')->name('calender.booking');

    Route::get('calenderEvent', 'EbookinController@calenderEvent');

    Route::get('/Booking/{id}/pdfBooking', 'EbookinController@pdfbooking')->name('pdf.booking');

    /* Route::get('/takwim/{id}/print', 'TakwimController@print')->name('print.takwim');

    Route::get('/takwim/{id}/kongsi', 'TakwimController@kongsi')->name('kongsi.takwim');

    Route::get('/takwim/{id}/sendtakwim', 'EbookingController@send')->name('send.takwim');

    Route::post('/takwim/sendtakwim', 'EbookingController@hantar')->name('hantar.takwim'); */


    // Room

    Route::get('/Room/listRoom', 'RoomController@showRoom')->name('list.Room');

    Route::get('/Room/createRoom', 'RoomController@createRoom')->name('create.Room');

    Route::post('/Room/storeRoom', 'RoomController@storeRoom')->name('store.Room');

    Route::get('/Room/{id}/editRoom', 'RoomController@editRoom')->name('edit.Room');

    Route::post('/Room/updateRoom', 'RoomController@updateRoom')->name('update.Room');

    Route::get('/Room/statistik', 'RoomController@statistik')->name('statistik.Room');
    
    Route::get('/Room/{id}/deleteRoom', 'RoomController@destroyRoom')->name('delete.Room');

    
});
require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Notifications\EmailNotification;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\User_PostController;
use App\Http\Controllers\Dashboard\CategoiresController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\ClientController;
// use App\Http\Controllers\Dashboard\Client\OrdertController;
use App\Http\Controllers\Dashboard\OrderController;
// use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CabinetController;
use App\Http\Controllers\Dashboard\TableController;

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
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
function () {

    Route::get('/send-notification',function(){
        // $user = User::find(2);
        // $user->notify(new EmailNotification());
        // Notification::send($user, new EmailNotification());
        $users = User::all();
        foreach($users as $user){
           Notification::send($user, new EmailNotification('Nazmul','Web Journey')); 
        }
        return redirect()->back();
    });


   
    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

    Route::get("/index" , [DashboardController::class, "index"])->name('index');

Route::resource('users', User_PostController::class)->except(['show']);




 //category routes
 Route::resource('categories', CategoiresController::class)->except(['show']);


 Route::resource('products', ProductController::class);
 Route::get('update/{id}', [App\Http\Controllers\Dashboard\ProductController::class, 'edite_order'])->name('update');

            //client routes
            Route::resource('clients', ClientController::class)->except(['show']);
            Route::resource('clients.orders', '\App\Http\Controllers\Dashboard\Client\OrdertController')->except(['show']);

            //order routes
            Route::resource('orders', OrderController::class);
            Route::get('/orders/{order}/products', [OrderController::class ,"products"])->name('orders.products');


            //user routes
            // Route::resource('users', UserController::class)->except(['show']);


            Route::resource('Cabinet', CabinetController::class);


            Route::resource('Table', TableController::class)->except(['show']);

});//end of dasboard routes
});

// });


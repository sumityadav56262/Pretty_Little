<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/saller', [SallerController::class,'profile']);
Route::get('/saller/viewProduct', [SallerController::class,'product_list']);
Route::get('/saller/insertPage', [SallerController::class,'InsertPage']);
Route::get('/saller/RegisterPage',[SallerController::class,"register_view"]);
Route::get('/saller/LoginPage',[SallerController::class,"login_view"]);
Route::get('/admin',[SallerController::class,"print"]);
Route::post('/saller/register',[SallerController::class,"register"]);
Route::post('/saller/login',[SallerController::class,"login"]);
Route::get('/saller/LogOut',[SallerController::class,"logout"]);
Route::post('/saller/insertProduct',[SallerController::class,"insertProduct"]);
Route::get('/saller/orders',[SallerController::class,"orders"]);
Route::post('/saller/delete',[SallerController::class,"deleteItem"]);

// This saction is for user interaction
Route::get('/productview/{id}',[MainController::class,"showproduct"]);
Route::get('/',[MainController::class,'home']);
Route::get('/search',[MainController::class,'search']);
Route::get('/shopnow',[MainController::class,'search']);
Route::get('/about_us',[MainController::class,'about_us']);

//Suscribed emails
Route::post('/subscribe',[MainController::class,'subscribe']);

Route::get('/cart',[UserController::class,'cart'])->name('cart');
Route::get('/order',[UserController::class,'addOrder']);
Route::get('/orders',[UserController::class,'orders']);
Route::post('/calcelOrder',[UserController::class,'calcelOrder']);
Route::post('/addtocart',[UserController::class,'addtocart']);
Route::post('/cart/ut',[UserController::class,'updateqty']);
Route::post('/cart/dlt',[UserController::class,'deleteItem']);
Route::post('/cart/byn',[UserController::class,'buynow']);
Route::post('/login',[UserController::class,'loginUser']);
Route::get('/logout',[UserController::class,'logoutUser']);
Route::get('/profile',[UserController::class,'user_profile']);
Route::get('/egprofile',[UserController::class,'edit_profile']);
Route::post('/conformation',[UserController::class,'conform']);
Route::post('/change', [UserController::class, 'change_password'])->name('change');
Route::post('/send', [UserController::class, 'forgot']);
Route::post('/verify', [UserController::class, 'verify_otp'])->name('verify');
Route::get('/forget_account', [UserController::class, 'forgot_page']);
Route::get('/otp_validation', [UserController::class, 'otp_validation']);
Route::get('/create_new', [UserController::class, 'create_new']);
Route::post('/updating_password', [UserController::class, 'update_password']);

Route::get('/register',function(){
    return view('user/Register');
});
Route::get('/login',function(){
    return view('user/LoginPage');
});
Route::post('/registerdata',[UserController::class,'registerUser']);




Route::get('/footer',function(){
    return view('footer');;
});
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\DemandeController;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware('auth:api')->group(function(){

	Route::apiResource('store', StoreController::class)->middleware('auth');
	Route::apiResource('domain', DomainController::class);
	Route::apiResource('formation', FormationController::class);
	Route::apiResource('module', ModuleController::class);
	Route::apiResource('plan', PlanController::class);
	Route::apiResource('demande', DemandeController::class);

});


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
	Route::post('register', [AuthController::class, 'register'])->name('store.register');
    Route::post('login', [AuthController::class, 'login'])->name('store.login');
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me'])->name('me');
}); 



/* Create a user route create */

Route::get('create-user', function(Request $request){
	User::create([
		'name' => 'Daouda',
		'email' => 'daouda@gmail.com',
		'password' => Hash::make('daouda')
	]);
});

/* Login a user route create */
/*Route::post('login', function(){
	// $credentials = [
	// 	'email' => 'admin@gmail.com',
	// 	'password' => 'password',
	// ];

	$credentials = request()->only(['email', 'password']);

	$token = auth()->attempt($credentials);
	return $token;
});
*/






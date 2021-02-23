<?php


// header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
// header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Accept,charset,boundary,Content-Length');
// header('Access-Control-Allow-Origin: *');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\DemandesController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\RecaptchaController;
use App\Http\Controllers\RessourceController;

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



// Route::middleware('api')->group(function(){

Route::apiResource('store', StoreController::class);
Route::apiResource('domain', DomainController::class);

// Route::get('/domain/{slug}', [DomainController::class, 'show']);
// Route::get('/domain', [DomainController::class, 'index']);
// Route::post('/domain', [DomainController::class, 'store']);
// Route::delete('/domain/{domain}', [DomainController::class, 'destroy']);

Route::apiResource('formation', FormationController::class);
Route::apiResource('module', ModuleController::class);
Route::apiResource('plan', PlanController::class);
Route::apiResource('demande', DemandesController::class);

// });
Route::get('formateur', [FormateurController::class, 'index']);

Route::post('contact', [ContactController::class, 'store']);

Route::post('uploadfile', [RessourceController::class, 'store']);

//Route::post('/captcha/submit',[RecaptchaController::class, 'recaptcha'])->name('recaptcha');

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
	Route::post('register', [AuthController::class, 'register'])->name('store.register');
    Route::get('login', [AuthController::class, 'login'])->name('store.login');
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('me', [AuthController::class, 'me'])->name('me');
}); 



/* Create a user route create */

Route::get('create-user', function(Request $request){
	User::create([
		'name' => 'admin',
		'email' => 'admin@admin.com',
		'password' => Hash::make('password')
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






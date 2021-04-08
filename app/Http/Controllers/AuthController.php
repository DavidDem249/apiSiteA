<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function register(Request $request)
    {
        /*
    	User::create($request->all());

    	return response()->json([
                'success' => 'Inscription éffectuée',
        	], 200);
        */

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return response()->json(['Validation error'=>$validator->errors()], 401)
            //return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('agilesTelecoms')->accessToken;
        $success['name'] =  $user->name;
   
        //return $this->sendResponse($success, 'User register successfully.');
        return response()->json(['success'=> "User register successfully."], 200);

    }
    /*
    public function login()
    {

	    
	 //    $credentials = [
		// 	'email' => 'admin@gmail.com',
		// 	'password' => 'password',
		// ];

		// $credentials = request()->only(['email', 'password']);

		// $token = auth()->attempt($credentials); 
		

		//return $token;

        //$credentials = request(['email', 'password']);

        $credentials = [
			'email' => 'admin@admin.com',
			'password' => 'password',
		];

		//$credentials = request()->only(['email', 'password']);

		$token = auth()->attempt($credentials);

        if (!$token) {
            return response()->json(['error' => 'Vous n\'êtes pas autorisé à voir cette page'], 401);
        }

        return $this->respondWithToken($token);
    } */


    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('agilesTelecoms')->accessToken; 
            $success['name'] =  $user->name;
            return response()->json(['success'=> "User login successfully."], 200);
            //return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return response()->json(['error'=> "Unauthorised"], 404);
            //return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
    	//$user = auth()->user();
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}

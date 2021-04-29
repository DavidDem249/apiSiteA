<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formateur;
use App\Mail\ValidationCompte;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

use DB;
use Validator;

class ValidationController extends Controller
{
    
    public function validateCompte(Request $request, Formateur $formateur)
    {
    	$email = $formateur->email;
    	$phone = $formateur->phone;
    	$name = $formateur->nom.' '.$formateur->prenom;
    	// dd($name);

    	$passwordCode = $this->passwordRand();

    	$data = [
    		'name' => $name,
    		'email' => $email,
    		'password' => $passwordCode,
    	];
    	// dd($data['email']);

    	$email_not_in_bd = DB::table('users')->where('email', $email)->doesntExist();


    	if($email_not_in_bd)
    	{
    		$user = User::create([
	    		'name' => $name,
	    		'email' => $email,
	    		'password' => bcrypt($passwordCode),
	    	]);

	    	if($user)
	    	{
	    		Formateur::whereId($formateur->id)->update([
	    			'status' => 1,
	    		]);

	    		$success['token'] =  $user->createToken('agilesTelecoms')->accessToken;
		        $success['name'] =  $user->name;
		        $success['id'] =  $user->id;

		    	Mail::to($email)->cc('daouda.dembele@agilestelecoms.com')->Send(new ValidationCompte($data));

		    	return response()->json([
		    		'success'=> true, 
		    		'message' => "Compte crée avec succès.",
		    		'data' => $success,
		    	], 200);
	    	}else{

	    		return response()->json([
		    		'success'=> false, 
		    		'message' => "Une erreur est survenue lors de la création du compte.",
		    	], 400);
	    	}
    	}else{

    		return response()->json([
	    		'success'=> false, 
	    		'message' => "Cette addresse email existe déjà dans la base de données.",
	    	], 400);
    	}

    }


    public function createCompte(Request $request)
    {

        $data = $request->validate([
            'nom' => 'nullable|min:3',
            'prenom' => 'nullable|min:3',
            'phone' => 'nullable|min:8',
            'email' => 'nullable|email|max:255',
            'domaine' => 'nullable',
            'pays' => 'nullable',
            'ville' => 'nullable',
        ]);
        // dd($data);
        if($data)
        {
           //dd($data);
            $formateur = new Formateur();
            $formateur->nom = $data['nom'];
            $formateur->prenom = $data['prenom'];
            $formateur->phone = $data['phone'];
            $formateur->email = $data['email'];
            $formateur->domaine = $data['domaine'] ?? "";
            $formateur->pays = $data['pays'] ?? "";
            $formateur->ville = $data['ville'] ?? "";
            $formateur->save();

            $passwordCode = $this->passwordRand();
            $email = $formateur->email;
            $name = $formateur->nom.' '.$formateur->prenom;

            $data = [
                'name' => $name,
                'email' => $email,
                'password' => $passwordCode,
            ];

            $email_not_in_bd = DB::table('users')->where('email', $email)->doesntExist();

            if($email_not_in_bd)
            {
                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'password' => bcrypt($passwordCode),
                ]);

                if($user)
                {
                    Formateur::whereId($formateur->id)->update([
                        'status' => 1,
                    ]);

                    $success['token'] =  $user->createToken('agilesTelecoms')->accessToken;
                    $success['name'] =  $user->name;
                    $success['id'] =  $user->id;
                    // ->cc('daouda.dembele@agilestelecoms.com')
                    Mail::to($email)->Send(new ValidationCompte($data));

                    return response()->json([
                        'success'=> true, 
                        'message' => "Compte crée avec succès.",
                        'data' => $success,
                    ], 200);
                }else{

                    return response()->json([
                        'success'=> false, 
                        'message' => "Une erreur est survenue lors de la création du compte.",
                    ], 400);
                }
            }else{

                return response()->json([
                    'success'=> false, 
                    'message' => "Cette addresse email existe déjà dans la base de données.",
                ], 400);
            }
        }
    }


    protected function passwordRand()
    {
    	$lettre = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $lettreLen = strlen($lettre) - 1;
        for($i=0;$i<8;$i++)
        {
            $n = rand(0, $lettreLen);
            $pass[] = $lettre[$n];
        }
        return implode($pass);
    }
}

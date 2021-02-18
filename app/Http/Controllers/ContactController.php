<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Http;
use App\Mail\Contact as ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
      $validate = $request->validate([
          'nom' => 'required|min:3',
          'prenom' => 'required|min:4',
          'object' => 'required|min:3',
          'email' => 'required|email|max:255',
          'phone' => 'required|numeric',
          'message' => 'required|text',
          'g-recaptcha-response' => 'required|recaptcha'
      ]);


      $secret = \config('captcha.v2-checkbox');

      $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify',  [
              'secret' => $secret,
              'response' => $request['g-recaptcha-response'],
          ]);

        session()->put([
            'payload' => $response->body(),
        ]);

      if($responses->success)
      {
          Contact::create([
            'nom' => "Dembele",
            'prenom' => "Daouda",
            'object' => "Création d'entreprise",
            'email' => "david@gmail.com",
            'phone' => "5578698423",
            'message' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
          ]);
          return response()->json([
              'success' => 'Message envoyé avec succès',
          ], 200);
          Mail::to('info@agilestelecoms.com')->Send(new ContactMail($data));
          //return redirect()->route('captchav2-checkbox');

      }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }
  
}

?>
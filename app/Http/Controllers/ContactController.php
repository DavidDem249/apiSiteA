<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Http;
use App\Mail\Contact as ContactMail;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;

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
      $data = $request->validate([
          'nom' => 'required|min:3',
          'prenom' => 'required|min:4',
          'object' => 'required|min:3',
          'email' => 'required|email|max:255',
          'phone' => 'required|numeric',
          'message' => 'required',
          'token' => 'nullable',
      ]);

      //dd($request);
      if(!config('services.recaptcha.enabled') || !$this->checkRecaptcha($request->get('token'), $request->ip())) {
          return response()->json('Recaptcha invalid.', 401);
      }
      
      try{
          Mail::to('daouda.dembele@agilestelecoms.com')->Send(new ContactMail($data));
          Contact::create($request->all());

      }catch (Exception $e){
          return response()->json([
            'success' => false,
            'message' => 'Erreur survenue!',
          ], 404);
      }
      
      return response()->json([
          'success' => true,
          'message' => 'Message envoyé avec succès',
      ], 200);
          
          //return redirect()->route('captchav2-checkbox');
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




  protected function checkRecaptcha($token, $ip)
  {
      $response = (new Client)->post('https://www.google.com/recaptcha/api/siteverify', [
         'form_params' => [
             'secret' => config('services.recaptcha.secret'),
             'response' => $token,
             'remoteip' => $ip,
         ],
      ]);

     //echo $response->getStatusCode(); // 200
     //echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
     //echo $response->getBody(); // '{"id": 1420053, "name": "guzzle", ...}'


     $response = json_decode((string) $response->getBody(), true);
     //dd($response);
     //return $response['success'];
     return true;
  }
  
}

?>
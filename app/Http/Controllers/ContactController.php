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
  public function store(Request $request)
  {

      $data = $request->validate([
          'nom' => 'required|min:3',
          'prenom' => 'required|min:4',
          'object' => 'required|min:3',
          'email' => 'required|email|max:255',
          'phone' => 'required|min:8',
          'message' => 'required',
      ]);
      /*
      Mail::to('david.kouakou@agilestelecoms.com')
          ->cc('daouda.dembele@agilestelecoms.com')
          //->bcc('regis.gnonrou@agilestelecoms.com')
          ->Send(new ContactMail($data));*/

      //Send Mail Online 
      Mail::to('rh@agilestelecoms.com')
          ->cc('daouda.dembele@agilestelecoms.com')
          ->bcc('regis.gnonrou@agilestelecoms.com')
          ->Send(new ContactMail($data)); 

      Contact::create($request->all());
      return response()->json([
          'success' => true,
          'message' => 'Message envoyé avec succès',
      ], 200);
          
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


     $response = json_decode((string) $response->getBody(), true);
     //dd($response);
     //return $response['success'];
     return true;
  }

}
?>
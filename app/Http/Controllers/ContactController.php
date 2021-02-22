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
      $request->validate([
          'nom' => 'required|min:3',
          'prenom' => 'required|min:4',
          'object' => 'required|min:3',
          'email' => 'required|email|max:255',
          'phone' => 'required|numeric',
          'message' => 'required|text',
      ]);

      Mail::to('info@agilestelecoms.com')->Send(new ContactMail($data));
      return response()->json([
          'success' => 'Message envoyé avec succès',
      ], 200);
          
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
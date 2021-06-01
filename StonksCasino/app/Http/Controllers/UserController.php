<?php

namespace App\Http\Controllers;

use App\Mail\testmail;
use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;

class UserController extends Controller
{
   public function edit() {

   }

   public function update(Request $request){

      $tokens =  $request->tokens;
      $update = $request->validate([
         'tokens' => 'required|integer|between:1,1000000',
      ]);

      $update = [
          'token' => $tokens + Auth::user()->token,
      ];
     
      User::where('id', Auth::user()->id)->update($update);
      return redirect()->route('home');
   }
    public function mail(){
      $details = [
         'title' => 'test',
         'body' => 'home'
         ];
      Mail::to('jopbogers03@gmail.com')->send(new testmail($details));
      return "email sent";
    }
}

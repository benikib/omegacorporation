<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserInformation extends Controller
{
    
   public function me(){
    $me=auth()->user();
    dd($me);
    return response()->json($me);
   }
}

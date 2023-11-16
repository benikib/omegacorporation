<?php

namespace App\Http\Controllers\Api\auth;

use App\Models\User;
use App\Models\Etudiant;
use App\Models\Professeur;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\EtudiantResource;

class LoginController extends Controller
{
    public function professor_login(Request $request){
        $user=User::where('telephone',$request->telephone)->get()->first();
        // dd($user->id);
        $professeur=Professeur::where('user_id',$user->id)->get()->first();
        // dd($etudiant);
        
        if(! empty($user)){
            if(password_verify($request->password,$user->password)){
                $token_=Str::random(60);
                // $user->update([
                //     'remember_token'=>$token_
                // ]);
                return response()->json([
                    "message"=>"connexion reussie",
                    "body"=>new EtudiantResource($professeur),
                    'status_code'=>200,
                    'token_'=>$token_
                ],200);
        }else{
            return response()->json([
                "message"=>"Mot de passe incorrect",
                'status_code'=>500
            ],500);
        }
    
            
        }else{
            return response()->json([
                "message"=>"Aucun utulisateur",
                'status_code'=>404
            ],404);
        }

        
    }

    public function student_login(Request $request){
        $user=User::where('telephone',$request->telephone)->get()->first();
        $etudiant=Etudiant::where('user_id',$user->id)->get()->first();
        // dd($etudiant);
        
        if($user){
            if(password_verify($request->password,$user->password)){
                $token_=Str::random(60);
                $user->update([
                    'remember_token'=>$token_
                ]);
                return response()->json([
                    "message"=>"connexion reussie",
                    "body"=>new EtudiantResource($etudiant),
                    'status_code'=>200,
                    'token_'=>$token_
                ],200);
        }else{
            return response()->json([
                "message"=>"Mot de passe incorrect",
                'status_code'=>500
            ],500);
        }
    
            
        }else{
            return response()->json([
                "message"=>"Aucun utulisateur",
                'status_code'=>404
            ],404);
        }

        
    }

    public function logout(Request $request, $id){

        $user=User::find($id);
        $user->update([
            'remember_token'=>''
        ]);

       return response()->json([
        "message"=>"deconnexion avec succes",
        'status_code'=>200
    ],200);

   }

}

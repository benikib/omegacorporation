<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\User;
use App\Models\Cours;
use App\Models\Professeur;
use Illuminate\Http\Request;

class RepportingController extends Controller
{
    function professeur(Request $request)
    {
        $users = User::has('professeur')
            ->with('professeur.cours')
            ->get();
        // $professeurs=User::find(1)->with("professeurs");
        // die($users);
        $cours = Cours::all();
        $i = 1;
        return view("professeurs.index", compact("users", "cours", "i"));

    }


    function professeur_store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nom' => 'required|max:255',
                'post_nom' => 'max:255',
                'prenom' => 'required|max:255',
                'adresse' => 'max:255',
                'telephone' => 'required|max:20',
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8'],
            ]);
            $user = new User;
            $user->nom = $validated['nom'];
            $user->post_nom = $validated['post_nom'];
            $user->prenom = $validated['prenom'];
            $user->telephone = $validated['telephone'];
            $user->adresse = $validated['adresse'];
            $user->email = $validated['email'];
            $user->password = Hash::make("password");
            $user->save();

            $professeur = Professeur::create([
                'user_id' => $user->id,
            ]);
            return redirect()->back() > with('success', 'creation avec success');
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Une erreur s\' est produit lors de la creation de du professeur'], 500);
        }
    }






    function etudiant(Request $request)
    {
        $users = User::has('etudiant')
            ->with('etudiant.note')
            ->get();
        // $professeurs=User::find(1)->with("professeurs");
        // die($users);
        $cours = Cours::all();
        $i = 1;
        return view("etudiants.index", compact("users", "cours", "i"));

    }



    function etudiant_store(Request $request){
        // dd($request);
        try {
            // $validated = $request->validate([
            //     'nom' => ['required','max:255'],
            //     'post_nom' => ['max:255'],
            //     'prenom' => ['required','max:255'],
            //     'adresse' => 'max:255',
            //     'promotion' => 'max:255',
            //     'telephone' => ['required','max:20'],
            //     'email' => ['email', 'max:255'],
            //     'password' => ['min:20'],
            // ]);
            
            // $user = new User;
            // $user->nom = $validated['nom'];
            // $user->post_nom = $validated['post_nom'];
            // $user->prenom = $validated['prenom'];
            // $user->telephone = $validated['telephone'];
            // $user->adresse = $validated['adresse'];
            // $user->email = $validated['email'];
            // $user->password = Hash::make("password");
            // $user->save();

            $user = User::create([
                'nom'=>$request->nom,
                'post_nom'=>$request->post_nom,
                'prenom'=>$request->prenom,
                'telephone'=>$request->telephone,
                'adresse'=>$request->adresse,
                'email'=>$request->email,
                'password'=>$request->password,
            ]);

            $professeur = Etudiant::create([
                'user_id' => $user->id,
                'promotion' => $request->promotion,
            ]);
            return redirect()->back() > with('success', 'creation avec success');
        } catch (\Throwable $th) {
            return $th;
        }
    }

}

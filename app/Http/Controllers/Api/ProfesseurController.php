<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Professeur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\ProfesseurResource;

class ProfesseurController extends Controller
{
    public function index()
    {
        $professeurs = Professeur::all();
        return ProfesseurResource::collection($professeurs);
    }
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nom' => 'required|max:255',
                'post_nom' => 'max:255',
                'prenom' => 'required|max:255',
                'adresse' => 'required|max:255',
                'telephone' => 'required|max:20',
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8'],
            ]);
            $user= new User;
            $user->nom = $validated['nom'];
            $user->post_nom = $validated['post_nom'];
            $user->prenom = $validated['prenom'];
            $user->telephone = $validated['telephone'];
            $user->adresse = $validated['adresse'];
            $user->email = $validated['email'];
            $user->password = Hash::make($validated['password']);
            $user->save();

            $professeur=Professeur::create([
                'user_id'=>$user->id,
            ]);

            if ($user && $professeur) {
                return response()->json(['message' => 'Professeur a ete cree avec succes '], 201);
            }

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Une erreur s\' est produit lors de la creation de du professeur'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Professeur = Professeur::find($id);
        return new ProfesseurResource($Professeur);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professeur $Professeur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $Professeur = Professeur::find($id);
            $Professeur = $Professeur->update($request->all());
            // $cours->save();

            if ($Professeur) {
                return response()->json(['message' => 'Professeur a ete modifie avec succes'], 201);
            }

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Une erreur s\' est produit de la modification de du professeur'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $cours = Professeur::find($id);
            $res = $cours->delete();
            if ($res) {
                return response()->json(['message' => 'Professeur a ete supprime avec succes'], 201);
            }

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Une erreur s\' est produit lors de la suppression de du professeur'], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Models\Professeur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\ProfesseurResource;

class ProfesseurController extends Controller
{
    public function index()
    {
        $Professeurs = Professeur::all();
        return ProfesseurResource::collection($Professeurs);
    }
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nom' => 'required|max:255',
                'post_nom' => 'max:255',
                'prenom' => 'required|max:255',
                'adresse' => 'required|max:255',
                'promotion' => 'max:255',
                'telephone' => 'required|unique:Professeurs|max:20',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:Professeurs'],
                'password' => ['required', 'string', 'min:8'],
            ]);
            $Professeur = new Professeur;
            $Professeur->nom = $validated['nom'];
            $Professeur->post_nom = $validated['post_nom'];
            $Professeur->prenom = $validated['prenom'];
            $Professeur->telephone = $validated['telephone'];
            $Professeur->adresse = $validated['adresse'];
            $Professeur->email = $validated['email'];
            $Professeur->password = Hash::make($validated['password']);
            $Professeur->save();
            if ($Professeur) {
                return response()->json(['message' => 'Professeur a ete cree avec succes'], 201);
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

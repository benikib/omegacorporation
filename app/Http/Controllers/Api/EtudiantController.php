<?php

namespace App\Http\Controllers\Api;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\EtudiantResource;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiants = Etudiant::all();
        return EtudiantResource::collection($etudiants);
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
                'telephone' => 'required|unique:etudiants|max:20',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:etudiants'],
                'password' => ['required', 'string', 'min:8'],
            ]);
            $etudiant = new Etudiant;
            $etudiant->nom = $validated['nom'];
            $etudiant->post_nom = $validated['post_nom'];
            $etudiant->prenom = $validated['prenom'];
            $etudiant->telephone = $validated['telephone'];
            $etudiant->adresse = $validated['adresse'];
            $etudiant->promotion = $validated['promotion'];
            $etudiant->email = $validated['email'];
            $etudiant->password = Hash::make($validated['password']);
            $etudiant->save();
            if ($etudiant) {
                return response()->json(['message' => 'Etudiant a ete cree avec succes'], 201);
            }

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Une erreur s\' est produit lors de la creation de l\'etudiant '.$th], 500);
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
        $etudiant = Etudiant::find($id);
        return new EtudiantResource($etudiant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiant $etudiant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $etudiant = Etudiant::find($id);
            $etudiant = $etudiant->update($request->all());
            // $cours->save();

            if ($etudiant) {
                return response()->json(['message' => 'Etudiant a ete modifie avec succes'], 201);
            }

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Une erreur s\' est produit de la modification de l\'etudiant'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $cours = Etudiant::find($id);
            $res = $cours->delete();
            if ($res) {
                return response()->json(['message' => 'Etudiant a ete supprime avec succes'], 201);
            }

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Une erreur s\' est produit lors de la suppression de l\'etudiant'], 500);
        }
    }
}

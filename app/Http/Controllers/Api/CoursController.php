<?php

namespace App\Http\Controllers\Api;

use App\Models\Cours;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CoursResource;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cours = Cours::all();
        return CoursResource::collection($cours);
    }
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'intitule' => 'required|unique:cours|max:255',
                'ponderation' => 'required|integer|between:1,7',
            ]);
            $cours = new Cours;
            $cours->intitule = $validated['intitule'];
            $cours->ponderation = $validated['ponderation'];
            $cours->save();
            if ($cours) {
                return response()->json(['message' => 'Le cours a ete cree avec succes'], 201);
            }

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Une erreur s\' est produit lors de la creation du cours'], 500);
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
        $cours = Cours::find($id);
        return new CoursResource($cours);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cours $cours)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $cours = Cours::find($id);
            $cours = $cours->update($request->all());
            // $cours->save();

            if ($cours) {
                return response()->json(['message' => 'Le cours a ete modifie avec succes'], 201);
            }

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Une erreur s\' est produit de la modification du cours'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $cours = Cours::find($id);
            $res = $cours->delete();
            if ($res) {
                return response()->json(['message' => 'Le cours a ete supprime avec succes'], 201);
            }

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Une erreur s\' est produit lors de la suppression du cours'], 500);
        }
    }
}

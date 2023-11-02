<?php

namespace App\Http\Controllers\Api;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\NoteResource;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::all();
        return NoteResource::collection($notes);
    }
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'cote' => 'required|integer|between:0,20',
                'cours' => 'required',
                'etudiant' => 'required',
            ]);
            $note = new Note;
            $note->cote = $validated['cote'];
            $note->cours = $validated['cours'];
            $note->etudiant = $validated['etudiant'];
            $note->save();
            if ($note) {
                return response()->json(['message' => 'Le Note a ete cree avec succes'], 201);
            }

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Une erreur s\' est produit lors de la creation du Note'], 500);
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
    
    //Cette methode retourne toutes les notes d'un etudiant
     public function getAllNoteforStudent($id){
        $note=Note::where('etudiant_id',$id)->get();
        return NoteResource::collection($note);
     }
     
    public function show($id)
    {
        $note = Note::find($id);
        return new NoteResource($note);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $note = Note::find($id);
            $note = $note->update($request->all());
            // $note->save();

            if ($note) {
                return response()->json(['message' => 'Note a ete modifie avec succes'], 201);
            }

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Une erreur s\' est produit de la modification de la Note'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $note = Note::find($id);
            $res = $note->delete();
            if ($res) {
                return response()->json(['message' => 'Note a ete supprime avec succes'], 201);
            }

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Une erreur s\' est produit lors de la suppression de la Note'], 500);
        }
    }
}

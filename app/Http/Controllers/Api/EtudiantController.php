<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Etudiant;
use App\Models\Professeur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
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
        // dd($request);
        try {
            $validated = $request->validate([
                'nom' => 'required|max:255',
                'post_nom' => 'max:255',
                'prenom' => 'required|max:255',
                'adresse' => 'required|max:255',
                'promotion' => 'max:255',
                'telephone' => 'required|unique:users|max:20',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
            ]);
            $user = new User;
            $user->nom = $validated['nom'];
            $user->post_nom = $validated['post_nom'];
            $user->prenom = $validated['prenom'];
            $user->telephone = $validated['telephone'];
            $user->adresse = $validated['adresse'];
            $user->email = $validated['email'];
            $user->password = Hash::make($validated['password']);
            $user->save();
            // $test=User::all();

            $etudiant = Etudiant::create([
                'user_id' => $user->id,
                'promotion' => $validated['promotion']
            ]);
            if ($user && $etudiant) {
                return response()->json(['message' => 'Etudiant a ete cree avec succes'], 201);
            }

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Une erreur s\' est produit lors de la creation de l\'etudiant ' . $th], 500);
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
        $error="";
        try {
            $validated_user = $request->validate([
                'nom' => 'max:255',
                'post_nom' => 'max:255',
                'prenom' => 'max:255',
                'adresse' => 'max:255',
                'telephone' => 'unique:users|max:20',
                'email' => [ 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['string', 'min:8'],
            ]);
            $etudiant=Etudiant::find($id);
            $validated_etd=$request->validate([
                'promotion' => 'max:255'
            ]);
            
            $user = User::find($etudiant->user_id);
            $user->update([
                'nom'=>$validated_user['nom'] ?? $user->nom,
                'post_nom'=>$validated_user['post_nom'] ?? $user->post_nom,
                'prenom'=>$validated_user['prenom'] ?? $user->prenom,
                'telephone'=>$validated_user['telephone'] ?? $user->telephone,
            ]);
            $user->save();
            // $cours->save();


            if ($request->hasFile('picture')) {
                $file = $request->file('profile');
                $allowed = ['png', 'jpg', 'jpeg', 'PNG', 'JPG', 'JPEG'];
                $extension = $file->extension();
    
                if (($file->getSize() / 1000000) <= 5) {
                    if (in_array($extension, $allowed)) {
                        $fileName = date('ymdhis').'.'.$extension;
                        if ($user->profile_photo != null) {
                            if (File::exists('storage/profiles/'.$user->profile_photo)) {
                                File::delete('storage/profiles/'.$user->profile_photo);
                            }
                        }
    
                        $user->profile_photo = $fileName;
                        $user->save();
                        $file->storeAs('profiles', $fileName, 'public');
                    } else {
                        $error='Le format du fichier est incorrect, seuls png,jpg,jpeg sont acceptés!!';
                    }
                } else {
                    $error='Le fichier est trop volumineux';
                }
            }

            $etudiant->update([
                'promotion' => $validated_etd['promotion']
            ]);
            
            if ($user && $etudiant) {
                return response()->json(['message' => 'Etudiant a ete modifie avec succes', 'status_code'=>201,'erreur'=>error], 201);
            }

        } catch (\Throwable $th) {
            return response()->json($th);
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
            return response()->json(['message' => 'Une erreur s\' est produit lors de la suppression de l\'etudiant','status_code'=>500], 500);
        }
    }
}

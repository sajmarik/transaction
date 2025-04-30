<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banque;
use App\Models\User;

class BanqueController extends Controller
{

    function __construct()

{     $this->middleware('permission:banque-list|banque-create|banque-edit|banque-delete', ['only' => ['index','store']]);
      $this->middleware('permission:banque-create', ['only' => ['create','store']]);
      $this->middleware('permission:banque-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:banque-delete', ['only' => ['destroy']]);
}
    


    public function index()
    {
        $banque = Banque::all();
        
        return response()->json([
            'message' => 'Liste des banques',
            'banques' => $banque,
        ]);
    }
    public function create()
    {
        return response()->json([
            'message' => 'Formulaire de création de banque prêt à être rempli.'
        ]);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nom_Banque' => 'required|string',
            'Code_Bic' => 'required|string',
            'Adresse_Siege' => 'required|string',
        ]);

        $banque = Banque::create($validated);

        return response()->json([
            'message' => 'Banque créée avec succès',
            'banque' => $banque,
        ], 201);
    }

    public function show($id)
    {
        $banque = Banque::findOrFail($id);

        return response()->json([
            'message' => 'Détails de la banque',
            'banque' => $banque,
        ]);
    }

    public function update(Request $request, $id)
    {
        $banque = Banque::findOrFail($id);

        $data = $request->validate([
            'Nom_Banque' => 'sometimes|string', 
            'Code_Bic' => 'sometimes|string',
            'Adresse_Siege' => 'sometimes|string',
        ]);

        $banque->update($data);

        return response()->json([
            'message' => 'Banque mise à jour avec succès',
            'banque' => $banque,
        ]);
    }
    public function edit($id)
    {
        $banque = Banque::find($id);
    
        if (!$banque) {
            return response()->json([
                'message' => 'Banque non trouvée'
            ], 404);
        }

        return response()->json([
            'banque' => $banque,
        ]);
    }
    
    
    public function destroy($id)
    {
        $banque = Banque::findOrFail($id); // récupère l'objet
        $banque->delete(); // soft delete (met à jour deleted_at)
    
        return response()->json([
            'message' => 'Banque supprimée avec succès',
        ]);
    }
}

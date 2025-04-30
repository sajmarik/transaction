<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

class CategorieController extends Controller
{
    function __construct()

    {
      $this->middleware('permission:categorie-list|categorie-create|categorie-edit|categorie-delete', ['only' => ['index','store']]);
      $this->middleware('permission:categorie-create', ['only' => ['create','store']]);
      $this->middleware('permission:categorie-edit', ['only' => ['edit','update']]);
      $this->middleware('permission:categorie-delete', ['only' => ['destroy']]);

    }

    public function create()
{
    return response()->json([],
);
}

     public function index()
    {
        // Récupérer toutes les catégories
        $categorie = Categorie::all();

        return response()->json([
            'message' => 'Liste des catégories',
            'categories' => $categorie,
        ]);
    }

    public function store(Request $request)
    {
        // Validation des données reçues
        $validated = $request->validate([
            'Nom_Cat' => 'required|string',
            'Type_Cat' => 'required|string',
        ]);

        // Créer une nouvelle catégorie
        $categorie = Categorie::create($validated);

        return response()->json([
            'message' => 'Catégorie créée avec succès',
            'categorie' => $categorie,
        ], 201);
    }

    public function show($id)
    {
        // Trouver la catégorie par son ID
        $categorie = Categorie::findOrFail($id);

        return response()->json([
            'message' => 'Détails de la catégorie',
            'categorie' => $categorie,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Trouver la catégorie à mettre à jour
        $categorie = Categorie::findOrFail($id);

        // Validation des données
        $data = $request->validate([
            'Nom_Cat' => 'sometimes|string',
            'Type_Cat' => 'sometimes|string',
        ]);

        // Mettre à jour la catégorie
        $categorie->update($data);

        return response()->json([
            'message' => 'Catégorie mise à jour avec succès',
            'categorie' => $categorie,
        ]);
    }
    public function edit($id)
    {
        $categorie = Categorie::find($id);
    
        if (!$categorie) {
            return response()->json([
                'message' => 'Catégorie non trouvée'
            ], 404);
        }
    
        return response()->json([
            'categorie' => $categorie,
        ]);
    }
    
    
    public function destroy($id)
    {
        // Trouver et supprimer la catégorie
        Categorie::destroy($id);

        return response()->json([
            'message' => 'Catégorie supprimée avec succès',
        ]);
    }
}

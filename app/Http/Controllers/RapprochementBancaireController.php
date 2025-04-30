<?php

namespace App\Http\Controllers;

use App\Models\RapprochementBancaire;
use App\Models\Transaction; // Assurez-vous d'importer le modèle Transaction si nécessaire
use App\Models\Compte_bancaire; // Assurez-vous d'importer le modèle Compte_bancaire
use Illuminate\Http\Request;

class RapprochementBancaireController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:rapprochement_bancaire-list|rapprochement_bancaire-create|rapprochement_bancaire-edit|rapprochement_bancaire-delete', ['only' => ['index','store']]);
        $this->middleware('permission:rapprochement_bancaire-create', ['only' => ['create','store']]);
        $this->middleware('permission:rapprochement_bancaire-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:rapprochement_bancaire-delete', ['only' => ['destroy']]);
    
 }   
           public function index()
    {
        $rapprochements = RapprochementBancaire::with(['compte', 'transaction'])->get();
        
        return response()->json([
            'message' => 'Liste des rapprochements bancaires',
            'rapprochements' => $rapprochements,
        ]);
    }
    public function create()
    {
        return response()->json([],
    );
    }
    // Afficher un rapprochement bancaire par ID
    public function show($id)
    {
        $rapprochement = RapprochementBancaire::with(['compte', 'transaction'])->findOrFail($id);
        
        return response()->json([
            'message' => 'Détails du rapprochement bancaire',
            'rapprochement' => $rapprochement,
        ]);
    }

    // Créer un nouveau rapprochement bancaire
    public function store(Request $request)
    {
        // Validation des données reçues
        $validated = $request->validate([
            'Date_Rapprochement' => 'required|date_format:Y-m-d H:i:s',
            'Solde_Reel' => 'required|numeric',
            'Solde_Comptable' => 'required|numeric',
            'Ecart' => 'required|numeric',
            'id_Compte' => 'required|exists:compte_bancaire,id_Compte',
            'id_Transaction' => 'required|exists:transaction,id_Transaction',
        ]);

        // Créer un nouveau rapprochement bancaire
        $rapprochement = RapprochementBancaire::create($validated);

        return response()->json([
            'message' => 'Rapprochement bancaire créé avec succès',
            'rapprochement' => $rapprochement,
        ], 201);
    }

    // Mettre à jour un rapprochement bancaire existant
    public function update(Request $request, $id)
    {
        // Validation des données reçues
        $data = $request->validate([
            'Date_Rapprochement' => 'sometimes|date_format:Y-m-d H:i:s',
            'Solde_Reel' => 'sometimes|numeric',
            'Solde_Comptable' => 'sometimes|numeric',
            'Ecart' => 'sometimes|numeric',
            'id_Compte' => 'sometimes|exists:compte_bancaire,id_Compte',
            'id_Transaction' => 'sometimes|exists:transaction,id_Transaction',
        ]);

        // Trouver le rapprochement bancaire
        $rapprochement = RapprochementBancaire::findOrFail($id);

        // Mettre à jour le rapprochement bancaire
        $rapprochement->update($data);

        return response()->json([
            'message' => 'Rapprochement bancaire mis à jour avec succès',
            'rapprochement' => $rapprochement,
        ]);
    }

    public function edit($id)
    {
        $rapprochement = RapprochementBancaire::find($id);
    
        if (!$rapprochement) {
            return response()->json([
                'message' => 'Rapprochement bancaire non trouvé'
            ], 404);
        }
    
        return response()->json([
            'rapprochement' => $rapprochement,
        ]);
    }

    public function destroy($id)
    {
        // Trouver et supprimer le rapprochement bancaire
        RapprochementBancaire::destroy($id);

        return response()->json([
            'message' => 'Rapprochement bancaire supprimé avec succès',
        ]);
    }
}

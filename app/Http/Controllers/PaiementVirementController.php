<?php

namespace App\Http\Controllers;

use App\Models\PaiementVirement;
use Illuminate\Http\Request;
use App\Models\Virement;
use App\Models\Transaction;

class PaiementVirementController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:paiement_virrement-list|paiement_virrement-create|paiement_virrement-edit|paiement_virrement-delete', ['only' => ['index','store']]);
        $this->middleware('permission:paiement_virrement-create', ['only' => ['create','store']]);
        $this->middleware('permission:paiement_virrement-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:paiement_virrement-delete', ['only' => ['destroy']]);
   
 }    public function index()
    {
        $virements = PaiementVirement::with('transaction')->get();

        return response()->json([
            'message' => 'Liste des virements',
            'virements' => $virements,
        ]);
    }
    public function create()
    {
        return response()->json([],
    );
    }
    // Créer un nouveau virement
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'Ref_Virement' => 'required|string',
            'Compte_Destinataire' => 'required|string',
            'id_Transaction' => 'required|exists:transaction,id_Transaction', // Vérifie si la transaction existe
        ]);

        // Créer un nouveau virement
        $virement = PaiementVirement::create($validated);

        return response()->json([
            'message' => 'Virement effectué avec succès',
            'virement' => $virement,
        ], 201);
    }

    // Afficher les détails d'un virement
    public function show($id)
    {
        // Trouver le virement par son ID
        $virement = PaiementVirement::with('transaction')->findOrFail($id);

        return response()->json([
            'message' => 'Détails du virement',
            'virement' => $virement,
        ]);
    }

    // Mettre à jour un virement
    public function update(Request $request, $id)
    {
        // Validation des données
        $data = $request->validate([
            'Ref_Virement' => 'sometimes|string' . $id,
            'Compte_Destinataire' => 'sometimes|string',
            'id_Transaction' => 'sometimes|exists:transaction,id_Transaction', // Vérifie si la transaction existe
        ]);

        // Trouver le virement et le mettre à jour
        $virement = PaiementVirement::findOrFail($id);
        $virement->update($data);

        return response()->json([
            'message' => 'Virement mis à jour avec succès',
            'virement' => $virement,
        ]);
    }

    public function edit($id)
    {
        $paiementVirement = PaiementVirement::find($id);
    
        if (!$paiementVirement) {
            return response()->json([
                'message' => 'Paiement par virement non trouvé'
            ], 404);
        }
    
        return response()->json([
            'paiementVirement' => $paiementVirement,
        ]);
    }
        public function destroy($id)
    {
        // Trouver et supprimer le virement
        PaiementVirement::destroy($id);

        return response()->json([
            'message' => 'Virement supprimé avec succès',
        ]);
    }
}

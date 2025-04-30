<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaiementCheque;
use App\Models\Transaction;

class PaiementChequeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:paiement_cheque-list|paiement_cheque-create|paiement_cheque-edit|paiement_cheque-delete', ['only' => ['index','store']]);
        $this->middleware('permission:paiement_cheque-create', ['only' => ['create','store']]);
        $this->middleware('permission:paiement_cheque-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:paiement_cheque-delete', ['only' => ['destroy']]);
    }
     public function index()
    {
        $paiements = PaiementCheque::with('transaction')->get();

        return response()->json([
            'message' => 'Liste des paiements par chèque',
            'paiements' => $paiements,
        ]);
    }
    public function create()
    {
        return response()->json([ ],
    );
    }
    // Créer un nouveau paiement par chèque
    public function store(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'Cheque_Numero' => 'required|string',
            'Banque_Emettrice' => 'required|string',
            'Nom_Titulaire' => 'required|string',
            'Date_Emission' => 'required|date_format:Y-m-d H:i:s',
            'id_Transaction' => 'required|exists:transaction,id_Transaction', // Vérifie si la transaction existe
        ]);

        // Créer un nouveau paiement par chèque
        $paiement = PaiementCheque::create($validated);

        return response()->json([
            'message' => 'Paiement par chèque effectué avec succès',
            'paiement' => $paiement,
        ], 201);
    }

    // Afficher les détails d'un paiement par chèque
    public function show($id)
    {
        // Trouver le paiement par chèque par son ID
        $paiement = PaiementCheque::with('transaction')->findOrFail($id);

        return response()->json([
            'message' => 'Détails du paiement par chèque',
            'paiement' => $paiement,
        ]);
    }

    // Mettre à jour un paiement par chèque
    public function update(Request $request, $id)
    {
        // Validation des données
        $data = $request->validate([
            'Cheque_Numero' => 'sometimes|string' . $id,
            'Banque_Emettrice' => 'sometimes|string',
            'Nom_Titulaire' => 'sometimes|string',
            'Date_Emission' => 'sometimes|date_format:Y-m-d H:i:s',
            'id_Transaction' => 'sometimes|exists:transaction,id_Transaction', // Vérifie si la transaction existe
        ]);

        // Trouver le paiement et le mettre à jour
        $paiement = PaiementCheque::findOrFail($id);
        $paiement->update($data);

        return response()->json([
            'message' => 'Paiement par chèque mis à jour avec succès',
            'paiement' => $paiement,
        ]);
    }

    public function edit($id)
{
    $paiementCheque = PaiementCheque::find($id);

    if (!$paiementCheque) {
        return response()->json([
            'message' => 'Paiement par chèque non trouvé'
        ], 404);
    }

    return response()->json([
        'paiementCheque' => $paiementCheque,
    ]);
}

    public function destroy($id)
    {
        // Trouver et supprimer le paiement par chèque
        PaiementCheque::destroy($id);

        return response()->json([
            'message' => 'Paiement par chèque supprimé avec succès',
        ]);
    }
}

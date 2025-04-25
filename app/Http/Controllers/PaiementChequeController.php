<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaiementCheque;
use App\Models\Transaction;

class PaiementChequeController extends Controller
{
    // Afficher la liste des paiements par chèque
    public function index()
    {
        $paiements = PaiementCheque::with('transaction')->get();

        return response()->json([
            'message' => 'Liste des paiements par chèque',
            'paiements' => $paiements,
        ]);
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

    // Supprimer un paiement par chèque
    public function destroy($id)
    {
        // Trouver et supprimer le paiement par chèque
        PaiementCheque::destroy($id);

        return response()->json([
            'message' => 'Paiement par chèque supprimé avec succès',
        ]);
    }
}

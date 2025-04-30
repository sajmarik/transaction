<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
{

    function __construct()
    {
     $this->middleware('permission:transaction-list|transaction-create|transaction-edit|transaction-delete', ['only' => ['index','store']]);
     $this->middleware('permission:transaction-create', ['only' => ['create','store']]);
     $this->middleware('permission:transaction-edit', ['only' => ['edit','update']]);
     $this->middleware('permission:transaction-delete', ['only' => ['destroy']]);
 }


    // Afficher toutes les transactions
    public function index()
    {
        $transactions = Transaction::with(['compte', 'echeance', 'categorie'])->get();  // Charger les relations

        return response()->json([
            'message' => 'Liste des transactions',
            'transactions' => $transactions,
        ]);
    }
    public function create()
    {
        return response()->json([ ],
    );
    }


    // Créer une nouvelle transaction
    public function store(Request $request)
    {
        // Validation des données reçues
        $validated = $request->validate([
            'Transaction_Montant' => 'required|numeric',
            'Date_Transaction' => 'required|date_format:Y-m-d H:i:s',
            'Type_Transaction' => 'required|string',
            'Description' => 'required|string',
            'id_Compte' => 'required|exists:compte_bancaire,id_Compte',
            'id_Echeance' => 'required|exists:echeance,id_Echeance',
            'id_Cat' => 'required|exists:categorie,id_Cat',
        ]);

        // Créer une nouvelle transaction
        $transaction = Transaction::create($validated);

        return response()->json([
            'message' => 'Transaction effectuée avec succès',
            'transaction' => $transaction,
        ], 201);
    }

    // Afficher les détails d'une transaction spécifique
    public function show($id)
    {
        // Trouver une transaction par son ID
        $transaction = Transaction::with(['compte', 'echeance', 'categorie'])->findOrFail($id);

        return response()->json([
            'message' => 'Détails de la transaction',
            'transaction' => $transaction,
        ]);
    }

    // Mettre à jour une transaction
    public function update(Request $request, $id)
    {
        // Validation des données reçues
        $data = $request->validate([
            'Transaction_Montant' => 'sometimes|numeric',
            'Date_Transaction' => 'sometimes|date_format:Y-m-d H:i:s',
            'Type_Transaction' => 'sometimes|string',
            'Description' => 'sometimes|string',
            'id_Compte' => 'sometimes|exists:compte_bancaire,id_Compte',
            'id_Echeance' => 'sometimes|exists:echeance,id_Echeance',
            'id_Cat' => 'sometimes|exists:categorie,id_Cat',
        ]);

        // Trouver la transaction existante
        $transaction = Transaction::findOrFail($id);

        // Mise à jour des données de la transaction
        $transaction->update($data);

        return response()->json([
            'message' => 'Transaction mise à jour avec succès',
            'transaction' => $transaction,
        ]);
    }

    public function edit($id)
{
    $transaction = Transaction::find($id);

    if (!$transaction) {
        return response()->json([
            'message' => 'Transaction non trouvée'
        ], 404);
    }

    return response()->json([
        'transaction' => $transaction,
    ]);
}


    public function destroy($id)
    {
        // Trouver et supprimer la transaction
        Transaction::destroy($id);

        return response()->json([
            'message' => 'Transaction supprimée avec succès',
        ]);
    }
}

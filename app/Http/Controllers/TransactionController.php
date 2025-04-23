<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
class TransactionController extends Controller
    {
        public function index()
        {
            return Transaction::with(['compte', 'categorie'])->get();
        }
    
        public function store(Request $request)
        {
            $data = $request->validate([
                'Montant' => 'required|numeric',
                'Type_Transaction' => 'required|string',
                'Date_Transaction' => 'required|date',
                'Description' => 'nullable|string',
                'id_Compte' => 'required|exists:compte_bancaires,id',
                'id_Categorie' => 'required|exists:categories,id',
            ]);
    
            return Transaction::create($data);
        }
    
        public function show($id)
        {
            return Transaction::with(['compte', 'categorie'])->findOrFail($id);
        }
    
        public function update(Request $request, $id)
        {
            $transaction = Transaction::findOrFail($id);
            $data = $request->validate([
                'Montant' => 'sometimes|numeric',
                'Type_Transaction' => 'sometimes|string',
                'Date_Transaction' => 'sometimes|date',
                'Description' => 'nullable|string',
                'id_Compte' => 'sometimes|exists:compte_bancaires,id',
                'id_Categorie' => 'sometimes|exists:categories,id',
            ]);
    
            $transaction->update($data);
            return $transaction;
        }
    
        public function destroy($id)
        {
            Transaction::destroy($id);
            return response()->json(['message' => 'Transaction supprimée']);
        }
    }
    

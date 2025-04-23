<?php

namespace App\Http\Controllers;

use App\Models\CompteBancaire;
use Illuminate\Http\Request;
class CompteBancaireController extends Controller
{
    public function index()
    {
        return CompteBancaire::with(['user', 'banque'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'Nom_compte' => 'required|string',
            'Solde_actuel' => 'required|numeric',
            'Devise' => 'required|string',
            'iban' => 'nullable|string',
            'Bic' => 'nullable|string',
            'id_User' => 'required|exists:users,id',
            'id_Banque' => 'required|exists:banques,id',
        ]);

        return CompteBancaire::create($data);
    }

    public function show($id)
    {
        return CompteBancaire::with(['user', 'banque'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $compte = CompteBancaire::findOrFail($id);
        $data = $request->validate([
            'Nom_compte' => 'sometimes|string',
            'Solde_actuel' => 'sometimes|numeric',
            'Devise' => 'sometimes|string',
            'iban' => 'nullable|string',
            'Bic' => 'nullable|string',
            'id_User' => 'sometimes|exists:users,id',
            'id_Banque' => 'sometimes|exists:banques,id',
        ]);

        $compte->update($data);
        return $compte;
    }

    public function destroy($id)
    {
        CompteBancaire::destroy($id);
        return response()->json(['message' => 'Compte bancaire supprimé']);
    }
}



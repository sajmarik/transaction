<?php

namespace App\Http\Controllers;

use App\Models\Compte_bancaire;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Banque;
class CompteBancaireController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:compte_bancaire-list|compte_bancaire-create|compte_bancaire-edit|compte_bancaire-delete', ['only' => ['index','store']]);
        $this->middleware('permission:compte_bancaire-create', ['only' => ['create','store']]);
        $this->middleware('permission:compte_bancaire-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:compte_bancaire-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $comptes = compte_bancaire::with(['user', 'banque'])->get();

        return response()->json([
            'message' => 'Liste des comptes bancaires',
            'comptes' => $comptes,
        ]);
    }

    public function create()
{
    $utilisateurs = User::pluck('name', 'id');
    $banques = Banque::pluck('Nom_Banque', 'id_Banque');

    return response()->json([
        'message' => 'Formulaire de création de compte bancaire prêt.',
        'utilisateurs' => $utilisateurs,
        'banques' => $banques,
    ]);
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'Nom_Compte' => 'required|string',
            'solde_actuel' => 'required|numeric',
            'Devise' => 'required|string',
            'Iban' => 'nullable|string',
            'Bic' => 'nullable|string',
            'id_User' => 'required|exists:users,id',
            'id_Banque' => 'required|exists:banque,id_banque'

        ]);

        $compte = compte_bancaire::create($validated);

        return response()->json([
            'message' => 'Compte bancaire créé avec succès',
            'compte' => $compte,
        ], 201);
    }

    public function show($id)
    {
        $compte = compte_bancaire::with(['user', 'banque'])->findOrFail($id);

        return response()->json([
            'message' => 'Détails du compte bancaire',
            'compte' => $compte,
        ]);
    }

    public function update(Request $request, $id)
    {
        $compte = compte_bancaire::findOrFail($id);

        $data = $request->validate([
            'Nom_Compte' => 'sometimes|string',
            'solde_actuel' => 'sometimes|numeric',
            'Devise' => 'sometimes|string',
            'Iban' => 'nullable|string',
            'Bic' => 'nullable|string',
            'id_User' => 'sometimes|exists:users,id',
            'id_Banque' => 'exists:banque,id_banque'
        ]);

        $compte->update($data);

        return response()->json([
            'message' => 'Compte bancaire mis à jour avec succès',
            'compte' => $compte,
        ]);
    }
    public function edit($id)
{
    $compte = Compte_bancaire::find($id);

    if (!$compte) {
        return response()->json([
            'message' => 'Compte bancaire non trouvé'
        ], 404);
    }

    return response()->json([
        'compte' => $compte,
    ]);
}

    
    public function destroy($id)
    {
        // Suppression permanente du compte bancaire
        Compte_bancaire::destroy($id);

        return response()->json([
            'message' => 'Compte bancaire supprimé avec succès',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transfert;

class TransfertController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:transfert-list|transfert-create|transfert-edit|transfert-delete', ['only' => ['index','store']]);
        $this->middleware('permission:transfert-create', ['only' => ['create','store']]);
        $this->middleware('permission:transfert-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:transfert-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $transferts = Transfert::with('compte')->get();
    
        return response()->json([
            'message' => 'Liste des transferts',
            'transferts' => $transferts,
        ]);
    }
    public function create()
    {
        return response()->json([ ],
    );
    }
public function store(Request $request)
{
    // Validation des données reçues
    $validated = $request->validate([
        'Transfert_Montant'=> 'required|numeric',
        'Date_Transfert'=> 'required|date_format:Y-m-d H:i:s',
        'Ref_Transfert'=> 'required|string|unique:transfert,Ref_Transfert',
        'Type_Transfert'=> 'required|string',
        'Compte_destinataire'=> 'required|string',
        'id_Compte' => 'required|exists:compte_bancaire,id_Compte',
    ]);

    // Vérifier si la référence existe déjà dans la base de données
    $existingTransfert = Transfert::where('Ref_Transfert', $request->Ref_Transfert)->first();

    if ($existingTransfert) {
        return response()->json([
            'message' => 'Cette référence de transfert existe déjà.',
        ], 400);
    }

    // Créer un nouveau transfert
    $transfert = Transfert::create($validated);

    return response()->json([
        'message' => 'Transfert effectué avec succès',
        'transfert' => $transfert,
    ], 201);
}

    public function show($id)
    {
        // Trouver un transfert par son ID
        $transfert = Transfert::findOrFail($id);

        return response()->json([
            'message' => 'Détails du transfert',
            'transfert' => $transfert,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Transfert_Montant' => 'sometimes|numeric',
            'Date_Transfert' => 'sometimes|date_format:Y-m-d H:i:s',
            'Ref_Transfert' => 'sometimes|string|unique:transfert,Ref_Transfert,' . $id,
            'Type_Transfert' => 'sometimes|string',
            'Compte_destinataire' => 'sometimes|string',
            'id_Compte' => 'sometimes|exists:compte_bancaire,id_Compte',
        ]);
    
        $transfert = Transfert::findOrFail($id);
    
        // Mise à jour des données du transfert
        $transfert->update($data);
    
        return response()->json([
            'message' => 'Transfert mis à jour avec succès',
            'transfert' => $transfert,
        ]);
    }
    public function edit($id)
{
    $transfert = Transfert::find($id);

    if (!$transfert) {
        return response()->json([
            'message' => 'Transfert non trouvé'
        ], 404);
    }

    return response()->json([
        'transfert' => $transfert,
    ]);
}

    public function destroy($id)
    {
        // Trouver et supprimer le transfert
        Transfert::destroy($id);

        return response()->json([
            'message' => 'Transfert supprimé avec succès',
        ]);
    }
}

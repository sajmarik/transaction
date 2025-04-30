<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Echeance;

class EcheanceController extends Controller
{
    function __construct()
    {
     $this->middleware('permission:echeance-list|echeance-create|echeance-edit|echeance-delete', ['only' => ['index','store']]);
     $this->middleware('permission:echeance-create', ['only' => ['create','store']]);
     $this->middleware('permission:echeance-edit', ['only' => ['edit','update']]);
     $this->middleware('permission:echeance-delete', ['only' => ['destroy']]);
 }
    public function index()
    {
        // Récupérer toutes les échéances
        $echeance = Echeance::all();

        return response()->json([
            'message' => 'Liste des échéances',
            'echeances' => $echeance,
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
        'date_echeance' => 'required|date_format:Y-m-d H:i:s',
        'Statut' => 'required|string',
        'Type_Echeance' => 'required|string',
    ]);

    // Créer une nouvelle échéance avec une valeur pour Date_Echeance
    $echeance = Echeance::create([
        'Date_Echeance' => $validated['date_echeance'],
        'Statut' => $validated['Statut'],
        'Type_Echeance' => $validated['Type_Echeance'],
    ]);

    return response()->json([
        'message' => 'Échéance créée avec succès',
        'echeance' => $echeance,
    ], 201);
}
    public function show($id)
    {
        // Trouver l'échéance par son ID
        $echeance = Echeance::findOrFail($id);

        return response()->json([
            'message' => 'Détails de l\'échéance',
            'echeance' => $echeance,
        ]);
    }

    public function update(Request $request, $id)
    {
        // Trouver l'échéance à mettre à jour
        $echeance = Echeance::findOrFail($id);

        // Validation des données
        $data = $request->validate([
'Date_Echeance' => 'sometimes|date_format:Y-m-d H:i:s',
            'Statut' => 'sometimes|string',
            'Type_Echeance' => 'sometimes|string',]);

        // Mettre à jour l'échéance
        $echeance->update($data);

        return response()->json([
            'message' => 'Échéance mise à jour avec succès',
            'echeance' => $echeance,
        ]);
    }
    public function edit($id)
    {
        $echeance = Echeance::find($id);
    
        if (!$echeance) {
            return response()->json([
                'message' => 'Échéance non trouvée'
            ], 404);
        }
    
        return response()->json([
            'echeance' => $echeance,
        ]);
    }
    
    public function destroy($id)
    {
        // Trouver et supprimer l'échéance
        Echeance::destroy($id);

        return response()->json([
            'message' => 'Échéance supprimée avec succès',
        ]);
    }
}

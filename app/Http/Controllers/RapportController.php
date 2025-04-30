<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rapport;

class RapportController extends Controller
{  function __construct()
    { 
        $this->middleware('permission:rapport-list|rapport-create|rapport-edit|rapport-delete', ['only' => ['index','store']]);
        $this->middleware('permission:rapport-create', ['only' => ['create','store']]);
        $this->middleware('permission:rapport-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:rapport-delete', ['only' => ['destroy']]);
     }
    public function index()
    {
        $rapports = Rapport::with('transaction')->get();

        return response()->json([
            'message' => 'Liste des rapports',
            'rapports' => $rapports,
        ]);
    }
    public function create()
    {
        return response()->json([],
    );
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Type_Rapport' => 'required|string',
            'Date_generation' => 'required|date_format:Y-m-d H:i:s',
            'id_Transaction' => 'required|exists:transaction,id_Transaction',
        ]);

        $rapport = Rapport::create($validated);

        return response()->json([
            'message' => 'Rapport créé avec succès',
            'rapport' => $rapport,
        ], 201);
    }

    public function show($id)
    {
        $rapport = Rapport::with('transaction')->findOrFail($id);

        return response()->json([
            'message' => 'Détails du rapport',
            'rapport' => $rapport,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'Type_Rapport' => 'sometimes|string',
            'Date_generation' => 'sometimes|date_format:Y-m-d H:i:s',
            'id_Transaction' => 'sometimes|exists:transaction,id_Transaction',
        ]);

        $rapport = Rapport::findOrFail($id);
        $rapport->update($data);

        return response()->json([
            'message' => 'Rapport mis à jour avec succès',
            'rapport' => $rapport,
        ]);
    }
    public function edit($id)
    {
        $rapport = Rapport::find($id);
    
        if (!$rapport) {
            return response()->json([
                'message' => 'Rapport non trouvé'
            ], 404);
        }
    
        return response()->json([
            'rapport' => $rapport,
        ]);
    }
    
    public function destroy($id)
    {
        Rapport::destroy($id);

        return response()->json([
            'message' => 'Rapport supprimé avec succès',
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banque;


class BanqueController extends Controller
{
    
    public function index()
    {
        return Banque::all();
    }


    public function show($id)
    {
        return Banque::findOrFail($id);
    }



    public function store(Request $request)
    {
        $data = $request->validate([
            'Nom_Banque' => 'required|string',
            'Code_Bic' => 'required|string',
            'Adresse_Siege' => 'required|string',
        ]);

        return Banque::create($data);
    }

   

    public function update(Request $request, $id)
    {
        $banque = Banque::findOrFail($id);
        $data = $request->validate([
            'Nom_Banque' => 'sometimes|string',
            'Code_Bic' => 'sometimes|string',
            'Adresse_Siege' => 'sometimes|string',
        ]);

        $banque->update($data);
        return $banque;
    }

    public function destroy($id)
    {
        Banque::destroy($id);
        return response()->json(['message' => 'Banque supprimée']);
    }
}

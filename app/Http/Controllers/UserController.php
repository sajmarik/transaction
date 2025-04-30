<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{

    function __construct()
    {
     $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
     $this->middleware('permission:user-create', ['only' => ['create','store']]);
     $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
     $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }


   // Récupérer tous les utilisateurs - réservé aux administrateurs
   public function index(Request $request)
   {
       if (!$request->user()->isAdmin()) {
           return response()->json(['message' => 'Accès refusé.'], 403); // 403 - Forbidden
       }
       $users = User::all();
       return response()->json([User::all()]);

   }

   public function createForm()

   {
       $roles = Role::pluck('name','name')->all();

       return response()->json([$roles]);

   }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|string', 
            'roles' => 'required'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'], 
            
        ]);
        $user->assignRole($request->input('roles'));
        return response()->json([
            // 'message' => 'Utilisateur créé avec succès',
             $user,
        ], 201);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'role' => 'sometimes|string', 
            'roles'=>'required',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));
        $user->update($data);
        return $user;
    }
    public function edit($id)

    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return response()->json([
            'user' => $user,
            'roles' => $roles,
            'userRole' => $userRole,

        ]);
    }
    public function destroy($id)
    {
        User::destroy($id);
        return response()->json(['message' => 'Utilisateur supprimé']);
    }



}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user= User::orderBY('created_at', 'desc')->get();

        return response()->json($user);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users',
            'apellidos' => 'required',
            'password' => 'required',
        ]);
        $user=new User();

        $user->name=$request->name;
        $user->apellidos=$request->apellidos;
        $user->rol='usuario';
        $user->password=$request->password;
        $user->save();

        $data=[
            'message'=>'usuario creado con exito',
            'productos'=>$user
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json($user);
    }

    public function mostrar(Request $request)
    {
        $user= $request->user();
        return response()->json($user);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        

        $request->validate([
            'name' => ['required',Rule::unique('users','name')->ignore($request->id, 'id')],
            'apellidos' => 'required',
            'password' => 'required',
        ]);

        $user->name=$request->name;
        $user->apellidos=$request->apellidos;
        $user->password=$request->password;
        $user->save();

        $data=[
            'message'=>'usuario editado con exito',
            'productos'=>$user
        ];

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user,Request $request)
    {
       
        
        if ($user->rol !='admin' && $request->user()->rol==='admin') {
            $user->delete();

            $data=[
                'message'=>'usuario borrado con exito',
                'productos'=>$user
            ];
    
            return response()->json($data);
        }
      
    }

    public function login(Request $request){

        if (!Auth::attempt($request->only('name','password'))) {
          
            return response()->json(['message'=>'no autorizado'],401);
        }

        $user= User::where('name',$request['name'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'=>'exito '.$user->name,
            'access_token'=>$token,
            'user'=>$user
        ]);

       
    }

    public function logout(Request $request){

        //auth()->user()->tokens()->delete();
        $request->user()->tokens()->delete();
        

        return ['message'=>'borrado correctamente'];
    }
}



<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::get();

        return view('user/index', [
            'users' => $users
        ]);
    }

    public function save(Request $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();
        
        return response()->json([
            'message' => 'Usuario creado con exito',
            'data' => $user
        ]);
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;

        $user->update();
        
        return response()->json([
            'message' => 'Usuario editado con exito',
            'data' => $user
        ]);
    }

    public function delete($id)
    {
        $user = User::find($id);

        $user->delete();
        
        return response()->json([
            'message' => 'Usuario eliminado con exito',
            'data' => $user
        ]);
    }
}

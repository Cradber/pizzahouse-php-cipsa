<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::all();

        return response()->json($users);
    }

    public function show($id) {
        $user = User::findOrFail($id);

        return response()->json($user);
    }

    public function store(Request $request) {
        $validator = $request->validate([
            'token' => 'required|string'
        ]);

        $user = User::create($validator);

        return response()->json($user, 201);
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        $validator = $request->validate([
            'token' => 'required|string'
        ]);

        $user->update($validator);

        return response()->json($user);
    }

    public function destroy($id) {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json(null, 204);
    }
}

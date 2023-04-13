<?php

namespace App\Http\Controllers;

use App\Models\Ingredients;
use http\Env\Response;
use Illuminate\Http\Request;

class IngredientsController extends Controller
{
    public function index() {
        $ingredients = Ingredients::all();

        return response()->json($ingredients);
    }

    public function show($id) {
        $ingredient = Ingredients::findOrFail($id);

        return response()->json($ingredient);
    }

    public function store(Request $request) {
        $validator = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|min:0'
        ]);

        $ingredient = Ingredients::create($validator);

        return response()->json($ingredient, 201);
    }

    public function update(Request $request, $id) {
        $ingredient = Ingredients::findOrFail($id);

        $validator = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric|min:0'
        ]);

        $ingredient->update($validator);

        return response()->json($ingredient);
    }

    public function destroy($id) {
        $ingredient = Ingredients::findOrFail($id);

        $ingredient->delete();

        return response()->json(null, 204);
    }
}

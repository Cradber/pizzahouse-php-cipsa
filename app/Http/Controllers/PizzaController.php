<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function index() {
        $pizzas = Pizza::all();

        return response()->json($pizzas);
    }

    public function show($id) {
        $pizza = Pizza::findOrFail($id);

        return response()->json($pizza);
    }

    public function store(Request $request) {
//        $validator = $request->validate([
//            'name' => 'required|string',
//            'description' => 'request|string'
//        ]);
//
//        $pizza = Pizza::create($validator);

        $pizza = new Pizza();
        $pizza->name = $request->name;
        $pizza->description = $request->description;
        $pizza->save();

        return response()->json($pizza, 201);
    }

    public function update(Request $request, $id) {
        $pizza = Pizza::findOrFail($id);

        $validator = $request->validate([
            'name' => 'required|string',
            'description' => 'request|string'
        ]);

        $pizza->update($validator);

        return response()->json($pizza);
    }

    public function destroy($id) {
        $pizza = Pizza::findOrFail($id);

        $pizza->delete();

        return response()->json(null, 204);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Edge;
use Illuminate\Http\Request;

class EdgeController extends Controller
{
    public function index() {
        $edges = Edge::all();

        return response()->json($edges);
    }

    public function show($id) {
        $edge = Edge::findOrFail($id);

        return response()->json($edge);
    }

    public function store(Request $request) {

        $validator = $request->validate([
            'fill' => 'required|boolean',
            'price' => 'required|numeric|min:0'
        ]);

        $edge = Edge::create($validator);

//        $edge = new Edge();
//        $edge->fill = $request->fill;
//        $edge->price = $request->price;
//        $edge->save();

        return response()->json($edge, 201);
    }

    public function update(Request $request, $id) {
        $edge = Edge::findOrFail($id);

        $validator = $request->validate([
            'fill' => 'required|boolean',
            'price' => 'required|numeric|min:0'
        ]);

        $edge->update($validator);

        return response()->json($edge);
    }

    public function destroy($id) {
        $edge = Edge::findOrFail($id);
        $edge->delete();

        return response()->json(null, 204);
    }
}

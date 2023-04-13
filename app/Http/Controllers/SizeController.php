<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index() {
        $sizes = Size::all();

        return response()->json($sizes);
    }

    public function show($id) {
        $size = Size::findOrFail($id);

        return response()->json($size);
    }

    public function store(Request $request) {
        $validator = $request->validate([
            'size' => 'required|string'
        ]);

        $size = Size::create($validator);

        return response()->json($size, 201);
    }

    public function update(Request $request, $id) {
        $size = Size::findOrFail($id);

        $validator = $request->validate([
            'size' => 'required|string'
        ]);

        $size->update($validator);

        return response()->json($size);
    }

    public function destroy($id) {
        $size = Size::findOrFail($id);

        $size->delete();

        return response()->json(null, 204);
    }
}

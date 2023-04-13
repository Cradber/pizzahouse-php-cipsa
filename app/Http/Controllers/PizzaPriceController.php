<?php

namespace App\Http\Controllers;

use App\Models\PizzaPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PizzaPriceController extends Controller
{
    public function index() {
        $pizza_prices = PizzaPrice::all();

        return response()->json($pizza_prices);
    }

    public function show($id) {
        $pizza_price = PizzaPrice::findOrFail($id);

        return response()->json($pizza_price);
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'pizza_id' => 'required|numeric|min:0',
            'size_id' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pizza_price = PizzaPrice::create($validator->validated());

        return response()->json($pizza_price, 201);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->query(), [
            'pizza_id' => 'required|numeric|min:0',
            'size_id' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'pizzaprice_id' => 'required|numeric|min:0'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $new_pizza_price = new PizzaPrice([
            'pizza_id' => $request->query('pizza_id'),
            'size_id' => $request->query('size_id'),
            'price' => $request->query('price')
        ]);

        $pizzaprice_id = $request->query('price_id');
        $pizza_price = PizzaPrice::findOrFail($pizzaprice_id);
        $pizza_price->update($new_pizza_price);

        return response()->json($new_pizza_price);
    }

    public function destroy($id) {
        $pizzaprice = PizzaPrice::findOrFail($id);
        $pizzaprice->delete();

        return response()->json(null, 204);
    }

    public function priceByPizzaAndSizeIds($pizza, $size) {
        $pizzaprice = PizzaPrice::all()
            ->where('pizza_id', $pizza)
            ->where('size_id', $size)
            ->first()
            ->price;

        return $pizzaprice;
    }

    public function priceByQuery(Request $request) {
        $validator = Validator::make($request->query(), [
            'pizza_id' => 'required|numeric',
            'size_id' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pizza_id = $request->query('pizza_id');
        $size_id = $request->query('size_id');

        $pizzaprice = $this->priceByPizzaAndSizeIds($pizza_id, $size_id);

        return response()->json($pizzaprice);
    }
}

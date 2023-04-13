<?php

namespace App\Http\Controllers;

use App\Models\Edge;
use App\Models\Ingredients;
use App\Models\Order;
use App\Models\OrderIngredients;
use App\Models\PizzaPrice;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::all();

        return response()->json($orders);
    }

    public function show($id) {
        $order = Order::findOrFail($id);

        return response()->json($order);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|min:1',
            'size_id' => 'required|integer|min:1',
            'edge_id' => 'required|integer|min:1',
            'pizza_id' => 'required|integer|min:1',
            'ingredients' => 'required|array|min:1',
            'ingredients.*' => 'integer|min:1',
        ]);

        $order = Order::create([
            'user_id' => $validatedData['user_id'],
            'size_id' => $validatedData['size_id'],
            'edge_id' => $validatedData['edge_id'],
            'pizza_id' => $validatedData['pizza_id']
        ]);

        $ingredients_price = 0.0;
        foreach ($validatedData['ingredients'] as $ingredient) {
            OrderIngredients::create([
                'order_id' => $order->id,
                'ingredient_id' => $ingredient,
            ]);

            $ingredient_price = Ingredients::find($ingredient)->price;
            $ingredients_price += $ingredient_price;
        }

        $edge_price = Edge::find($request->edge_id)->price;
        $pizza_price = PizzaPrice::all()
            ->where('pizza_id', $request->pizza_id)
            ->where('size_id', $request->size_id)
            ->first()
            ->price;
        $price = $edge_price + $pizza_price + $ingredients_price;

        return response()->json([$order, 'price' => $price], 201);
    }

    public function destroy($id) {
        $order = Order::findOrFail($id);

        $order->delete();

        return response()->json(null, 204);
    }
}

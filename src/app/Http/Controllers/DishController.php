<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;

class DishController extends Controller{
    public function ingredients()
    {
        $ingredients = DB::select('select * from ingredients where verified = 1');

        return view('search', compact('ingredients'));
    }
    public function ingredient()
    {
        $ingredients = DB::select('select * from ingredients where verified = 1');

        return view('create', compact('ingredients'));
    }   
    public function processSearch(Request $request)
    {
        // Start a base query targeting your main table
        $query = DB::table('dish_DB');

        // 1. Filter by Meal Type (Dropdown)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // 2. Filter by Kitchen (Multiple Select)
        if ($request->filled('kitchen')) {
            $query->whereIn('kitchen', $request->kitchen);
        }

        // 3. Filter by Checkboxes (Vegan / Vegetarian)
        if ($request->has('vegan')) {
            $query->where('vegan', 1);
        }
        if ($request->has('vegeterian')) {
            $query->where('vegeterian', 1); 
        }

        // 4. Filter by Ingredients
        if ($request->filled('ingredients')) {
            $query->whereIn('id', function($subquery) use ($request) {
                $subquery->select('id_dish')
                         ->from('dish_ingredient')
                         ->whereIn('id_ingredient', $request->ingredients);
            });
        }

        // 5. Execute the query and get the matching dishes
        $dishes = $query->get();

        // 6. Pass the results to a view
        return view('show', compact('dishes'));
    }

    public function createdish(){

    }
}
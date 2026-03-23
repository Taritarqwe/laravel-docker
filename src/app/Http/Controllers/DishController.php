<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;

class DishController extends Controller{
    public function ingredients()
    {
        $ingredients = DB::select('select * from ingredients');

        return view('search', compact('ingredients'));
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
        // Checkboxes only send data if they are checked, so we use has()
        if ($request->has('vegan')) {
            $query->where('vegan', true); // or 1, depending on your database setup
        }
        if ($request->has('vegeterian')) {
            $query->where('vegeterian', true); 
        }

        // 4. Filter by Ingredients (The tricky part!)
        if ($request->filled('ingredients')) {
            // We use a subquery to look inside the dish_ingredient table.
            // This grabs any dish that contains AT LEAST ONE of the selected ingredients.
            $query->whereIn('id', function($subquery) use ($request) {
                $subquery->select('id_dish')
                         ->from('dish_ingredient')
                         ->whereIn('id_ingredient', $request->ingredients);
            });
        }

        // 5. Execute the query and get the matching dishes
        $dishes = $query->get();

        // 6. Pass the results to a view (e.g., results.blade.php)
        return view('results', compact('dishes'));
    }
}
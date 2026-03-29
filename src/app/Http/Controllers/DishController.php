<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
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
        $query = DB::table('dish_DB');

        // 1. Type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // 2. Kitchen
        if ($request->filled('kitchen')) {
            $query->whereIn('kitchen', $request->kitchen);
        }

        // 3. Vegan / Vegetarian
        if ($request->has('vegan')) {
            $query->where('vegan', 1);
        }

        if ($request->has('vegeterian')) { // your form spelling
            $query->where('vegeterian', 1); // your DB spelling
        }

        // 4. Ingredients ranking
        if ($request->filled('ingredients')) {

            $ingredients = $request->ingredients;

            $query->join('dish_ingredient', 'dish_DB.id', '=', 'dish_ingredient.id_dish')
                ->whereIn('dish_ingredient.id_ingredients', $ingredients)
                ->select(
                    'dish_DB.*',
                    DB::raw('COUNT(dish_ingredient.id_ingredients) as match_count')
                )
                ->groupBy(
                    'dish_DB.id',
                    'dish_DB.name',
                    'dish_DB.kitchen',
                    'dish_DB.photoURL',
                    'dish_DB.description',
                    'dish_DB.recipeURL',
                    'dish_DB.type',
                    'dish_DB.userName',
                    'dish_DB.userID',
                    'dish_DB.created_at',
                    'dish_DB.verified',
                    'dish_DB.vegeterian',
                    'dish_DB.vegan'
                )
                ->orderByDesc('match_count');
        }

        $dishes = $query->get();

        return view('show', compact('dishes'));
    }

    public function browse()
    {
        $dishes = DB::table('dish_DB')
            ->leftJoin('dish_ingredient', 'dish_DB.id', '=', 'dish_ingredient.id_dish')
            ->select(
                'dish_DB.*',
                DB::raw('COUNT(dish_ingredient.id_ingredients) as match_count')
            )
            ->groupBy(
                'dish_DB.id',
                'dish_DB.name',
                'dish_DB.kitchen',
                'dish_DB.photoURL',
                'dish_DB.description',
                'dish_DB.recipeURL',
                'dish_DB.type',
                'dish_DB.userName',
                'dish_DB.userID',
                'dish_DB.created_at',
                'dish_DB.verified',
                'dish_DB.vegeterian',
                'dish_DB.vegan'
            )
            ->inRandomOrder()
            ->get();

        return view('browse', compact('dishes'));
    }

    public function createDish(Request $request)
    {
        // 1. Validate the incoming data (makes sure everything is provided)
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'kitchen' => 'required|string',
            'description' => 'required|string',
            'recipeURL' => 'required|url',
            'photoURL' => 'required|image|mimes:jpeg,png|max:2048',
            'ingredients' => 'required|array|min:1',
        ]);

        // 2. Handle the Image Upload
        if ($request->hasFile('photoURL')) {
            $file = $request->file('photoURL');
            // Create a unique filename: e.g., 1711382400_my-dish.jpg
            $fileName = time() . '_' . $file->getClientOriginalName();
            // Move the file to public/photoURLs
            $file->move(public_path('photoURLs'), $fileName);
            // This is the string we save to the 'photoURL' column in the DB
            $databasePath = 'photoURLs/' . $fileName;
        }
        // 3. Get Logged-in User Info
        $user = Auth::user();

        // 4. Save the Dish and get its new ID
        // Replace 'dishes' with your actual table name if it's different
        $dishId = DB::table('dish_DB')->insertGetId([
            'name'        => $request->name,
            'photoURL'    => $databasePath, // Saves "photoURLs/filename.jpg"
            'userName'    => Auth::user()->name,
            'userID'      => Auth::id(),
            'kitchen'     => $request->kitchen,
            'description' => $request->description,
            'recipeURL'   => $request->recipeURL,
            'type'        => $request->type,
            'verified'    => false,
            'vegeterian'  => $request->has('vegeterian'),
            'vegan'       => $request->has('vegan'),
            'created_at'  => now(),
        ]);
        // 5. Handle Ingredients (Existing IDs vs. New Strings)
        $ingredientIdsToLink = [];

        foreach ($request->ingredients as $item) {
            if (is_numeric($item)) {
                // It's a number, so it's an existing ingredient ID
                $ingredientIdsToLink[] = $item;
            } else {
                // It's text, meaning the user created a new tag. Save it to ingredients table.
                $newIngredientId = DB::table('ingredients')->insertGetId([
                    'ingredient' => $item,
                    'verified' => false, // Default to false as per your schema
                ]);
                $ingredientIdsToLink[] = $newIngredientId;
            }
        }

        // 6. Save the connections to the Pivot Table
        $pivotRecords = [];
        foreach ($ingredientIdsToLink as $ingId) {
            $pivotRecords[] = [
                'id_dish' => $dishId,
                'id_ingredients' => $ingId
            ];
        }
        
        // Replace 'dish_ingredients' with your actual pivot table name from Image 1
        DB::table('dish_ingredient')->insert($pivotRecords);

        // 7. Done! Redirect back with success message.
        return redirect()->back()->with('success', 'Dish added successfully!');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\KApplication;
use App\Models\Product;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\IngPrice;
class IngredientController extends Controller
{

    public function index()
    {
        $ingredients = Ingredient::all();
        return view('pages.ingredients.index', compact('ingredients'));
    }

    public function create()
    {
        return view('pages.ingredients.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $ingredient = new Ingredient();
        $ingredient->name = $validatedData['name'];
        $ingredient->count = 0;
        $ingredient->type = $validatedData['type'];
        $ingredient->save();

        return redirect('/ingredients')->with('success', 'Ингредиент успешно создан.');
    }

    public function show(Ingredient $ingredient)
    {
        $startDate = Carbon::parse(Carbon::now()->subWeek());
        if(request('from_date')){
            $startDate = Carbon::parse(request('from_date'));
        }
        $endDate = Carbon::parse(request('to_date'));
        $ingprices = IngPrice::where('ingredient_id', $ingredient->id)
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->orderBy('created_at','desc')
            ->get();
        return view('pages.ingredients.show', compact('ingredient','ingprices'));
    }

    public function edit(Ingredient $ingredient)
    {
        return view('pages.ingredients.edit', compact('ingredient'));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $ingredient->name = $validatedData['name'];
        $ingredient->count = 0;
        $ingredient->type = $validatedData['type'];
        $ingredient->save();

        return redirect('/ingredients')->with('success', 'Ингредиент успешно обновлен.');
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return redirect('/ingredients')->with('success', 'Ингредиент успешно удален.');
    }

    public function ingredients(){
        $ingredients = Ingredient::all();
        return response()->json(['ingredients' => $ingredients]);
    }

    public function table(){
        $fromDate = Carbon::parse(request('from_date'));
        $toDate = Carbon::parse(request('to_date'));
        $kapplications = KApplication::whereDate('created_at','>=', $fromDate)->whereDate('created_at','<=', $toDate)->get();
        $purchases = Purchase::whereDate('created_at','>=', $fromDate)->whereDate('created_at','<=', $toDate)->get();
        $ingredients = [];
        foreach($purchases as $purchase){
            foreach($purchase->data as $item){
                if(isset($ingredients[$item['input_name']])){
                    $ingredients[$item['input_name']] += (int)$item['input_count2'];
                }else{
                    $ingredients[$item['input_name']] = (int)$item['input_count2'];
                }
            }
        }
        $purchased_ings = $ingredients;
        $used_ings = [];
        foreach($kapplications as $kapplication){
            foreach($kapplication->k_data as $item){
                if($item['input_count2']>0){
                    $product = Product::where('name',$item['input_name'])->first();
                    foreach($product->ingredients as $ingredient){
                        if(isset($used_ings[$ingredient['input_name']])){
                            $used_ings[$ingredient['input_name']] -= ((int)$ingredient['input_count1'])*((int)$item['input_count2']);
                        }else{
                            $used_ings[$ingredient['input_name']] = -(int)$ingredient['input_count1']*((int)$item['input_count2']);
                        } 
                    }
                }
            }
        }
        ksort($purchased_ings);
        return view('pages.ingredients.table',compact('purchased_ings','used_ings'));
    }
}

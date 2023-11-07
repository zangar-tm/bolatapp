<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\Purchase;
use App\Models\IngPrice;
class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::orderBy('created_at','desc')->simplePaginate(10);
        return view('pages.purchases.index', compact('purchases'));
    }

    public function create()
    {
        $ingredients = Ingredient::all();
        return view('pages.purchases.create',compact('ingredients'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'data' => 'required',
        ]);

        $purchase = new Purchase();
        $purchase->data = json_decode($validatedData['data'],true);
        $purchase->save();

        foreach($purchase->data as $d){
            $ingr = Ingredient::where('name', $d['input_name'])->first();
            if($d['input_count1']!=''){
                $ingprice = new IngPrice();
                $ingprice->ingredient_id = $ingr->id;
                $ingprice->price = $d['input_count1'];
                $ingprice->save();
            }
        }
        return redirect('/purchases')->with('success', 'Отчет успешно создан.');
    }

    public function show(Purchase $purchase)
    {
        return view('pages.purchases.show', compact('purchase'));
    }

    public function edit(Purchase $purchase)
    {
        return view('pages.purchases.edit', compact('purchase'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $validatedData = $request->validate([
            'data' => 'required',
        ]);

        $purchase->data = json_decode($validatedData['data'],true);
        $purchase->save();
        foreach($purchase->data as $d){
            $ingr = Ingredient::where('name', $d['input_name'])->first();
            if(!IngPrice::whereDate('created_at', \Carbon\Carbon::today())->where('ingredient_id', $ingr->id)->exists()){
                if($d['input_count1']!=''){
                    $ingprice = new IngPrice();
                    $ingprice->ingredient_id = $ingr->id;
                    $ingprice->price = $d['input_count1'];
                    $ingprice->save();
                }
            }
        }
        return redirect('/purchases')->with('success', 'Отчет успешно обновлен.');
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect('/purchases')->with('success', 'Отчет успешно удален.');
    }
}

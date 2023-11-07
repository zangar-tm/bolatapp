<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\IngPrice;
class IngredientController extends Controller
{
    // Отобразить список всех ингредиентов
    public function index()
    {
        $ingredients = Ingredient::all();
        return view('pages.ingredients.index', compact('ingredients'));
    }

    // Отобразить форму для создания нового ингредиента
    public function create()
    {
        return view('pages.ingredients.create');
    }

    // Сохранить новый ингредиент
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        // Создание нового ингредиента
        $ingredient = new Ingredient();
        $ingredient->name = $validatedData['name'];
        $ingredient->count = 0;
        $ingredient->type = $validatedData['type'];
        $ingredient->save();

        return redirect('/ingredients')->with('success', 'Ингредиент успешно создан.');
    }

    // Отобразить информацию об ингредиенте
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

    // Отобразить форму для редактирования ингредиента
    public function edit(Ingredient $ingredient)
    {
        return view('pages.ingredients.edit', compact('ingredient'));
    }

    // Обновить ингредиент
    public function update(Request $request, Ingredient $ingredient)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        // Обновление данных ингредиента
        $ingredient->name = $validatedData['name'];
        $ingredient->count = 0;
        $ingredient->type = $validatedData['type'];
        $ingredient->save();

        return redirect('/ingredients')->with('success', 'Ингредиент успешно обновлен.');
    }

    // Удалить ингредиент
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return redirect('/ingredients')->with('success', 'Ингредиент успешно удален.');
    }

    public function ingredients(){
        $ingredients = Ingredient::all();
        return response()->json(['ingredients' => $ingredients]);
    }
}

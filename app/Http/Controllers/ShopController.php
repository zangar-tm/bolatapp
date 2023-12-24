<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Shop;
class ShopController extends Controller
{
    // Отобразить список всех магазинов
    public function index()
    {
        $shops = Shop::simplePaginate(10);
        return view('pages.shops.index', compact('shops'));
    }

    // Отобразить форму для создания нового магазина
    public function create()
    {
        $expeditors = User::whereIn('role',['экспедитор', 'старший экспедитор'])->get();
        return view('pages.shops.create',compact('expeditors'));
    }

    // Сохранить новый магазин
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'user_id' => 'required|integer',
            'type' => 'required|string',
            "boss_phone" => "nullable",
            "bonus" => "nullable",
        ]);

        // Создание нового магазина
        $shop = new Shop();
        $shop->name = $validatedData['name'];
        $shop->address = $validatedData['address'];
        $shop->phone = $validatedData['phone'];
        $shop->boss_phone = $validatedData['boss_phone'];
        $shop->user_id = $validatedData['user_id'];
        $shop->type = $validatedData['type'];
        $shop->bonus = $validatedData['bonus'];
        $shop->save();

        return redirect('/shops')->with('success', 'Магазин успешно создан.');
    }

    // Отобразить информацию о магазине
    public function show(Shop $shop)
    {
        return view('pages.shops.show', compact('shop'));
    }

    // Отобразить форму для редактирования магазина
    public function edit(Shop $shop)
    {
        $expeditors = User::whereIn('role',['экспедитор', 'старший экспедитор'])->get();
        return view('pages.shops.edit', compact('shop','expeditors'));
    }

    // Обновить магазин
    public function update(Request $request, Shop $shop)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'user_id' => 'required|integer',
            'type' => 'required|string',
            'boss_phone' => 'nullable',
            'bonus' => 'nullable'
        ]);

        // Обновление данных магазина
        $shop->name = $validatedData['name'];
        $shop->address = $validatedData['address'];
        $shop->phone = $validatedData['phone'];
        $shop->user_id = $validatedData['user_id'];
        $shop->boss_phone = $validatedData['boss_phone'];
        $shop->type = $validatedData['type'];
        $shop->bonus = $validatedData['bonus'];
        $shop->save();

        return redirect('/shops')->with('success', 'Магазин успешно обновлен.');
    }

    // Удалить магазин
    public function destroy(Shop $shop)
    {
        $shop->delete();
        return redirect('/shops')->with('success', 'Магазин успешно удален.');
    }

    public function shops(){
        $shops = Shop::where('user_id', '!=', request()->get('user_id'))->get();
        return response()->json(['shops' => $shops]);
    }
}

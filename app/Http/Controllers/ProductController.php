<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
class ProductController extends Controller
{
    // Отобразить список всех продуктов
    public function index()
    {
        $products = Product::get();
        return view('pages.products.index',compact('products'));
    }

    // Отобразить форму для создания нового продукта
    public function create()
    {
        $ingredients = Ingredient::all();
        return view('pages.products.create', compact('ingredients'));
    }

    // Сохранить новый продукт
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'ingredients' => 'required',
            'price' => 'required|integer'
        ]);

        // Загрузка изображения
        
        // $imagePath = $request->file('image')->store('products', 'public');
        // dd($request);
        // Создание нового продукта
        $product = new Product();
        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        // $product->image = $imagePath;
        $product->ingredients = json_decode($validatedData['ingredients'], true);
        $product->save();

        return redirect('/products')->with('success', 'Продукт успешно создан.');
    }

    // Отобразить информацию о продукте
    public function show(Product $product)
    {
        return view('pages.products.show', compact('product'));
    }

    // Отобразить форму для редактирования продукта
    public function edit(Product $product)
    {
        return view('pages.products.edit', compact('product'));
    }

    // Обновить продукт
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'ingredients' => 'nullable',
            'price' => 'required'
        ]);

        // Обновление данных продукта
        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        if(isset($request->ingredients)){
            $product->ingredients = json_decode($validatedData['ingredients'], true);
        }
        $product->save();

        return redirect('/products')->with('success', 'Продукт успешно обновлен.');
    }

    // Удалить продукт
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/products')->with('success', 'Продукт успешно удален.');
    }

    public function products(){
        $products = Product::all();
        return response()->json(['products' => $products]);
    }
}

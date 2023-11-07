<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\KApplication;
use App\Models\Product;
class KApplicationController extends Controller
{
    // Отобразить список всех K-заявок
    public function index()
    {
        $kapplications = KApplication::orderBy('created_at','desc')->simplePaginate(10);
        return view('pages.kapplications.index', compact('kapplications'));
    }

    // Отобразить форму для создания новой K-заявки
    public function create()
    {
        $totalproducts = [];
        $applications = Application::whereDate('created_at', Carbon::today())->get();
        
        foreach($applications as $app)
        {
            foreach($app->data as $d){
                if(isset($totalproducts[$d['input_name']])){
                    $totalproducts[$d['input_name']] += (int)$d['input_count2'];
                }else{
                    $totalproducts[$d['input_name']] = (int)$d['input_count2'];
                }
            }
        }
        $products = Product::all();
        return view('pages.kapplications.create', compact('products','totalproducts'));
    }

    // Сохранить новую K-заявку
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'data' => 'required',
        ]);
        // Создание новой K-заявки
        $kApplication = new KApplication();
        $kApplication->k_data = json_decode($validatedData['data']);
        $kApplication->status = 'exp';
        $kApplication->save();

        return redirect('/kapplications')->with('success', 'заявка успешно создана.');
    }

    // Отобразить информацию о K-заявке
    public function show(KApplication $kapplication)
    {
        return view('pages.kapplications.show', compact('kapplication'));
    }

    // Отобразить форму для редактирования K-заявки
    public function edit(KApplication $kapplication)
    {
        return view('pages.kapplications.edit', compact('kapplication'));
    }

    // Обновить K-заявку
    public function update(Request $request, KApplication $kapplication)
    {
        $validatedData = $request->validate([
            'data' => 'required',
        ]);

        // Обновление данных K-заявки
        $kapplication->k_data = json_decode($validatedData['data']);
        if(auth()->user()->role="кухня"){
            $kapplication->status = 'kitchen';
        }
        $kapplication->save();

        return redirect('/kapplications')->with('success', 'заявка успешно обновлена.');
    }

    // Удалить K-заявку
    public function destroy(KApplication $kapplication)
    {
        $kapplication->delete();
        return redirect('/kapplications')->with('success', 'заявка успешно удалена.');
    }
}

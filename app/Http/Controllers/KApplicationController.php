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
        // dd($totalproducts);
        return view('pages.kapplications.create', compact('products','totalproducts'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'data' => 'nullable',
        ]);
        $mydata = [];
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
        $kApplication = new KApplication();
        if($request->data == null){
            foreach($totalproducts as $key => $totprod){
                $mydata[] = [
                    'input_name' => $key,
                    'input_count1' => $totprod,
                    'input_count2' => 0,
                    'input_count3' => 0,
                ];
            }
            $kApplication->k_data = $mydata;
        }else{
            $kApplication->k_data = json_decode($validatedData['data']);
        }
        $kApplication->status = 'exp';
        $kApplication->save();
        return redirect('/kapplications')->with('success', 'заявка успешно создана.');
    }

    // Отобразить информацию о K-заявке
    public function show(KApplication $kapplication)
    {
        $needed_ings = [];
        foreach($kapplication->k_data as $item){
            if($item['input_count1']>0){
                $product = Product::where('name',$item['input_name'])->first();
                if($product){
                    foreach($product->ingredients as $ingredient){
                        if(isset($needed_ings[$ingredient['input_name']])){
                            $needed_ings[$ingredient['input_name']] -= ((int)$ingredient['input_count1'])*((int)$item['input_count1']);
                        }else{
                            $needed_ings[$ingredient['input_name']] = -(int)$ingredient['input_count1']*((int)$item['input_count1']);
                        } 
                    }
                }
            }
        }
        ksort($needed_ings);
        return view('pages.kapplications.show', compact('kapplication', 'needed_ings'));
    }

    // Отобразить форму для редактирования K-заявки
    public function edit(KApplication $kapplication)
    {
        $needed_ings = [];
        foreach($kapplication->k_data as $item){
            if($item['input_count1']>0){
                $product = Product::where('name',$item['input_name'])->first();
                if($product){
                    foreach($product->ingredients as $ingredient){
                        if(isset($needed_ings[$ingredient['input_name']])){
                            $needed_ings[$ingredient['input_name']] -= ((int)$ingredient['input_count1'])*((int)$item['input_count1']);
                        }else{
                            $needed_ings[$ingredient['input_name']] = -(int)$ingredient['input_count1']*((int)$item['input_count1']);
                        } 
                    }
                }
            }
        }
        ksort($needed_ings);
        return view('pages.kapplications.edit', compact('kapplication','needed_ings'));
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

<?php

namespace App\Http\Controllers;

use App\Models\Chief;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\KSummary;
class KSummaryController extends Controller
{

    public function index()
    {
        $ksummaries = KSummary::simplePaginate();
        return view('pages.ksummaries.index', compact('ksummaries'));
    }

    public function create()
    {
        $chiefs = Chief::all();
        $products = Product::all();
        return view('pages.ksummaries.create',compact('chiefs','products'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'data' => 'required',
        ]);

        $ksummary = new KSummary();
        $ksummary->data = json_decode($validatedData['data'],true);
        $ksummary->save();

        return redirect('/ksummaries')->with('success', 'Отчет успешно создан.');
    }

    public function show(KSummary $ksummary)
    {
        return view('pages.ksummaries.show', compact('ksummary'));
    }

    public function edit(KSummary $ksummary)
    {
        $chiefs = Chief::all();
        $products = Product::all();
        return view('pages.ksummaries.edit', compact('ksummary','chiefs', 'products'));
    }

    public function update(Request $request, KSummary $ksummary)
    {
        $validatedData = $request->validate([
            'data' => 'required',
        ]);

        $ksummary->data = json_decode($validatedData['data'],true);
        $ksummary->save();

        return redirect('/ksummaries')->with('success', 'Отчет успешно обновлен.');
    }

    public function destroy(KSummary $ksummary)
    {
        $ksummary->delete();
        return redirect('/ksummaries')->with('success', 'Отчет успешно удален.');
    }

    public function table(){
        $fromDate = Carbon::parse(request('from_date'));
        $toDate = Carbon::parse(request('to_date'));
        $summaries = KSummary::whereDate('created_at','>=', $fromDate)->whereDate('created_at','<=', $toDate)->get();

        $preparedData = [];

        foreach ($summaries as $record) {
            foreach ($record->data as $item) {
                $productName = $item['input_name'];
                $userName = $item['input_count1'];
                $value = $item['input_count2'];

                // Проверяем, существует ли уже запись для данного продукта и пользователя
                if (!isset($preparedData[$productName][$userName])) {
                    $preparedData[$productName][$userName] = 0;
                }

                // Суммируем значения для продукта и пользователя
                $preparedData[$productName][$userName] += (int) $value;
            }
        }
        $users = Chief::pluck('full_name');
        return view('pages.ksummaries.table', compact('preparedData', 'users'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chief;
class ChiefController extends Controller
{
    // Отобразить список всех начальников
    public function index()
    {
        $chiefs = Chief::all();
        return view('pages.chiefs.index', compact('chiefs'));
    }

    // Отобразить форму для создания нового начальника
    public function create()
    {
        return view('pages.chiefs.create');
    }

    // Сохранить нового начальника
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
        ]);

        // Создание нового начальника
        $chief = new Chief();
        $chief->full_name = $validatedData['full_name'];
        $chief->save();

        return redirect('/chiefs')->with('success', 'Начальник успешно создан.');
    }

    // Отобразить информацию о начальнике
    public function show(Chief $chief)
    {
        return view('pages.chiefs.show', compact('chief'));
    }

    // Отобразить форму для редактирования начальника
    public function edit(Chief $chief)
    {
        return view('pages.chiefs.edit', compact('chief'));
    }

    // Обновить начальника
    public function update(Request $request, Chief $chief)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
        ]);

        // Обновление данных начальника
        $chief->full_name = $validatedData['full_name'];
        $chief->save();

        return redirect('/chiefs')->with('success', 'Начальник успешно обновлен.');
    }

    // Удалить начальника
    public function destroy(Chief $chief)
    {
        $chief->delete();
        return redirect('/chiefs')->with('success', 'Начальник успешно удален.');
    }

    public function chiefs(){
        $chiefs = Chief::all();
        return response()->json(['chiefs' => $chiefs]);
    }
}

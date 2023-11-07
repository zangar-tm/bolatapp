<?php

namespace App\Http\Controllers;

use App\Models\KApplication;
use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
class ApplicationController extends Controller
{
    // Отобразить список всех заявок
    public function index()
    {
        $today = Carbon::today()->toDateString(); // Получаем текущую дату в формате "Y-m-d"
        $recordCreatedToday = Application::where('user_id', auth()->user()->id)->whereDate('created_at', $today)->count();

        $applications = Application::orderBy('created_at','desc')->simplePaginate(2);
        return view('pages.applications.index', compact('applications','recordCreatedToday'));
    }

    // Отобразить форму для создания новой заявки
    public function create()
    {
        $products = Product::all();
        return view('pages.applications.create',compact('products'));
    }

    // Сохранить новую заявку
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'data' => 'required'
        ]);
        // Создание новой заявки
        $application = new Application();
        $application->user_id = Auth::user()->id;
        $application->data = json_decode($validatedData['data']);
        $application->status = 'small';
        $application->save();

        return redirect('/applications')->with('success', 'Заявка успешно создана.');
    }

    // Отобразить информацию о заявке
    public function show(Application $application)
    {
        return view('pages.applications.show', compact('application'));
    }

    // Отобразить форму для редактирования заявки
    public function edit(Application $application)
    {
        $products = Product::all();
        return view('pages.applications.edit', compact('application','products'));
    }

    // Обновить заявку
    public function update(Request $request, Application $application)
    {
        $validatedData = $request->validate([
            'data' => 'required|json',
        ]);

        // Обновление данных заявки
        $application->data = json_decode($validatedData['data']);
        $application->status = true;
        $application->save();

        return redirect('/applications')->with('success', 'Заявка успешно обновлена.');
    }

    // Удалить заявку
    public function destroy(Application $application)
    {
        $application->delete();
        return redirect('/applications')->with('success', 'Заявка успешно удалена.');
    }

    public function aa_index()
    {
        $today = Carbon::today()->toDateString();
        $recordCreatedToday = Application::whereDate('created_at', $today)->count();
        $applications = Application::orderBy('created_at','desc')->get();
        return view('pages.aapplications.index', compact('applications','recordCreatedToday'));
    }
    
    public function aa_show($id)
    {
        $application = Application::find($id);
        return view('pages.aapplications.show', compact('application'));
    }

    // Отобразить форму для редактирования заявки
    public function aa_edit($id)
    {
        $application = Application::find($id);
        $kapplication = KApplication::whereDate('created_at', $application->created_at)->first();
        $products = Product::all();
        return view('pages.aapplications.edit', compact('application','products','kapplication'));
    }

    // Обновить заявку
    public function aa_update(Request $request, $id)
    {
        $application = Application::find($id);
        $validatedData = $request->validate([
            'data' => 'nullable',
        ]);

        if($request->data == null){
            $data = [];
            foreach($application->data as $app){
                $data[] = [
                    'input_name' => $app['input_name'],
                    'input_count1' => $app['input_count1'],
                    'input_count2' => $app['input_count2'],
                    'input_count3' => $app['input_count2'],
                ];
            }
            $application->data = $data;
        }else{
            // Обновление данных заявки
            $application->data = json_decode($validatedData['data']);
        }

        $application->status = 'big_exp';
        $application->save();
        return redirect('/aapplications')->with('success', 'Заявка успешно обновлена.');
    }

    public function table(){

        $products = Product::all();
        $fromDate = Carbon::parse(request('from_date'));
        $toDate = Carbon::parse(request('to_date'));
        $applications = Application::whereDate('created_at','>=', $fromDate)->whereDate('created_at','<=', $toDate)->get();
        $expeditors = User::whereIn('role', ['экспедитор','старший экспедитор'])->get();
        $reportData = [];

        foreach ($applications as $summary) {
            foreach ($summary->data as $item) {
                $productName = $item['input_name'];
                // $userId = $summary->user_id; // Получение идентификатора пользователя
                $userName = $summary->user->name; // Получение имени пользователя из связанной модели User
                $count = $item['input_count3'];
        
                if (!isset($reportData[$productName])) {
                    $reportData[$productName] = [];
                }
        
                if (!isset($reportData[$productName][$userName])) {
                    $reportData[$productName][$userName] = 0;
                }
        
                $reportData[$productName][$userName] += (int)$count;
            }
        }

        foreach ($expeditors as $user) {
            foreach ($products as $product) {
                $productName = $product->name;
                $userName = $user->name;
        
                if (!isset($reportData[$productName])) {
                    $reportData[$productName] = [];
                }
        
                if (!isset($reportData[$productName][$userName])) {
                    $reportData[$productName][$userName] = 0;
                }
            }
        }
        // dd($reportData);
       
        
        // $expIds = [];
        // foreach($expeditors as $exp){
        //     $expIds[] = $exp->id;
        // } 
        
        // dd($expeditors);
        // return view('pages.applications.table');
        return view('pages.applications.table', compact('reportData','expeditors','products'));
    }
}

<?php

namespace App\Http\Controllers;


use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Invoice;
use App\Models\Product;
use Dompdf\Options;
use \Mpdf\Mpdf;
class InvoiceController extends Controller
{
    // Отобразить список всех счетов
    public function index()
    {
        $invoices = Invoice::where('user_id',auth()->user()->id)->simplePaginate(10);
        return view('pages.invoices.index', compact('invoices'));
    }

    // Отобразить форму для создания нового счета
    public function create()
    {
        $products = Product::all();
        $shops = Shop::where('user_id',auth()->user()->id)->get();
        return view('pages.invoices.create',compact('shops','products'));
    }

    // Сохранить новый счет
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'payment_type' => 'required|string|max:255',
            'file' => 'nullable',
            'products' => 'required',
        ]);

        // Загрузка файла
        if(isset($request->file)){
            $filePath = $request->file('file')->store('invoices', 'public');
        }
        
        // Создание нового счета
        $invoice = new Invoice();
        $invoice->user_id = auth()->user()->id;
        $invoice->shop_id = $validatedData['shop_id'];
        $invoice->payment_type = $validatedData['payment_type'];
        $invoice->file = $filePath ?? '';
        $invoice->products = json_decode($validatedData['products'], true);
        $sum_price = 0;
        foreach($invoice->products as $product){
            $prod_price = $product['input_count1']*$product['input_count2'];
            $sum_price +=$prod_price;
        }
        $invoice->sum_price = $sum_price;
        $invoice->save();
        
        return redirect('/invoices/'.$invoice->id)->with('success', 'Счет успешно создан.');
    }

    // Отобразить информацию о счете
    public function show(Invoice $invoice)
    {
        return view('pages.invoices.show', compact('invoice'));
    }

    // Отобразить форму для редактирования счета
    public function edit(Invoice $invoice)
    {
        $products = Product::all();
        $shops = Shop::all();
        return view('pages.invoices.edit', compact('invoice','products','shops'));
    }

    // Обновить счет
    public function update(Request $request, Invoice $invoice)
    {
        $validatedData = $request->validate([
            'shop_id' => 'required|exists:shops,id',
            'payment_type' => 'required|string|max:255',
            'file' => 'nullable',
            'products' => 'required',
        ]);

        // Обновление данных счета
        $invoice->user_id = auth()->user()->id;
        $invoice->shop_id = $validatedData['shop_id'];
        $invoice->payment_type = $validatedData['payment_type'];
        
        if ($request->hasFile('file')) {
            // Если загружен новый файл, заменить его
            $filePath = $request->file('file')->store('invoices', 'public');
            $invoice->file = $filePath;
        }

        $invoice->products = json_decode($validatedData['products'], true);
        $sum_price = 0;
        foreach($invoice->products as $product){
            $prod = Product::name($product['input_name'])->first();
            $prod_price = $prod->price*$product['input_count1'];
            $sum_price +=$prod_price;
        }
        $invoice->sum_price = $sum_price;
        $invoice->save();

        return redirect('/invoices/'.$invoice->id)->with('success', 'Счет успешно обновлен.');
    }

    // Удалить счет
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect('/invoices')->with('success', 'Счет успешно удален.');
    }

    public function makePDF($id){
        $invoice = Invoice::find($id);
        $setting = Setting::find(1);
        $data = [
            'title' => 'Накладная',
            'shop'=> $invoice->shop->name,
            'payment_type' => $invoice->payment_type,
            'sum_price' => $invoice->sum_price,
            'products' => $invoice->products,
            'date' => $invoice->created_at->format('d.m.Y'),
            'expeditor' => $invoice->user->name,
            'company' => $setting->data['company']??''
        ];
        // dd($data);
        $mpdf = new Mpdf();
        $mpdf->WriteHTML(view('pages.invoices.pdf', $data));
        $mpdf->Output('nakladnaya'.$invoice->id.'.pdf', 'D'); 
    }
}

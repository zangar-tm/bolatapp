@extends('layout.app')
@section('title','Накладная '.$invoice->shop->name)
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view tables">
        <div class="btns-group-edit"><a class="btn btn-text btn-icon" href="/invoices"><img src="/icons/back.svg" alt="">Назад</a><a class="btn-edit" href="/invoices/{{$invoice->id}}/edit"> 
            <svg class="inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="24" height="24" role="presentation">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg></a></div>
        <div class="title">
            <h2>Накладная: {{$invoice->shop->name}}</h2>
        </div>
        <div class="view-main">
            <div class="view-item">
                <div class="view-item-key">
                    <p>Магазин</p>
                </div>
                <div class="view-item-value">
                    <p>{{$invoice->shop->name}}</p>
                </div>
            </div>
            <div class="view-item">
                <div class="view-item-key">
                    <p>Тип оплаты</p>
                </div>
                <div class="view-item-value">
                    <p>{{$invoice->payment_type}}</p>
                </div>
            </div>
            
            <div class="view-item">
                <div class="view-item-key hide">
                    <p>Продукты</p>
                </div>
                <div class="view-item-value">
                    <div class="keyValues keyValues-four keyValues-noBtn">
                        <div class="keyValues-title">
                            <div class="keyValues-name keyValues-title-item"><span>Продукт</span></div>
                            <div class="keyValues-key keyValues-title-item"><span>Стоимость</span></div>
                            <div class="keyValues-value keyValues-title-item"><span>Передано</span></div>
                            <div class="keyValues-count keyValues-title-item"><span>Сумма</span></div>
                        </div>
                        <div class="keyValues-wrapper">
                            @foreach($invoice->products as $inv)
                            @if($inv['input_count2']!=0)
                            <div class="keyValues-item">
                                <div class="keyValues-name">
                                    <input class="input input-name" id="input_name" type="text" value="{{$inv['input_name']}}" disabled>
                                </div>
                                <div class="keyValues-key">
                                    <input class="input input-count1" id="input_count1"value="{{$inv['input_count1']}}" type="number" disabled>
                                </div>
                                <div class="keyValues-value">
                                    <input class="input input-count2" id="input_count2"value="{{$inv['input_count2']}}" type="number" disabled>
                                </div>
                                <div class="keyValues-count">
                                    <input class="input input-count3" id="input_count3"value="{{$inv['input_count1']*$inv['input_count2']}}" type="number" disabled>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="view-item">
                <div class="view-item-key">
                    <p>Файл</p>
                </div>
                <div class="view-item-value receipt">
                <div class="image-container">
                    <img src="/images/kaspi2.jpg" alt="">
                    <a class="btn btn-main" href="" download="">Скачать файл</a>
                </div>
            </div>
                <!-- /storage/{{$invoice->file}} -->
            </div>
            
            <div class="view-item">
                <div class="view-item-key">
                    <p>Общая сумма</p>
                </div>
                <div class="view-item-value">
                    <p>{{$invoice->sum_price}}</p>
                </div>
            </div>
        </div>
        <div class="view-btns">
            <div class="btns-group">
                <!-- <a href="https://wa.me/77718877671" class="btn btn-main">Отправить на WhatsApp</a> -->
                <a href="/invoicespdf/{{$invoice->id}}" class="btn btn-main">Получить накладную</a>
            </div>
        </div>
    </section>
</div>
@endsection

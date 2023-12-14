@extends('layout.app')
@section('title','Продукт '.$product->name)
@section('content')
<div class="main-content">
    @include('partials.menu')
    <section class="view tables">
        <div class="btns-group-edit"><a class="btn btn-text btn-icon" href="/products"><img src="/icons/back.svg" alt="">Назад</a><a class="btn-edit" href="/products/{{$product->id}}/edit"> 
            <svg class="inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="24" height="24" role="presentation">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg></a></div>
        <div class="title">
            <h2>Обновить продукт: {{$product->name}}</h2>
        </div>
        <div class="view-main">
            <div class="view-item">
                <div class="view-item-key">
                    <p>Название</p>
                </div>
                <div class="view-item-value">
                    <p>{{$product->name}}</p>
                </div>
            </div>
            <div class="view-item">
                <div class="view-item-key">
                    <p>Ингредиенты</p>
                </div>

                <div class="view-item-value">
                    <div class="keyValues keyValues-two keyValues-noBtn">
                        <div class="keyValues-title">
                            <div class="keyValues-name keyValues-title-item"><span>НАЗВАНИЕ</span></div>
                            <div class="keyValues-key keyValues-title-item"><span>ЗНАЧЕНИЕ</span></div>
                        </div>
                        <div class="keyValues-wrapper">
                            @foreach($product->ingredients as $ingred)
                            <div class="keyValues-item">
                                <div class="keyValues-name">
                                    @php
                                        $type = App\Models\Ingredient::where('name',$ingred['input_name'])->first()->type;
                                    @endphp
                                    <input class="input" id="input_name" type="text" value="{{$ingred['input_name']}} {{$type}}" placeholder disabled>
                                </div>
                                <div class="keyValues-key">
                                    <input class="input" id="input_count1" type="text" value="{{ $ingred['input_count1']}}" placeholder disabled>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="view-item">
                <div class="view-item-key">
                    <p>Прайс</p>
                </div>
                <div class="view-item-value">
                    <p>{{$product->price}}</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@extends('layout.app')
@section('title','Обновить продукт')
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view edit tables">
    <a class="btn btn-text btn-icon" href="/products"><img src="/icons/back.svg" alt>Назад</a>
        <div class="title">
            <h2>Обновить продукт: {{$product->name}}</h2>
        </div>
        <form action="/products/{{$product->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="view-main">
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Название</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <input class="input" type="text" placeholder="Название" value="{{$product->name}}" name="name">
                    </div>
                </div>
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Ингредиенты</p>
                    </div>
                    <div class="view-item-value">
                        <div class="keyValues keyValues-two">
                            <input class="hidden-input" type="hidden" name="ingredients">
                            <input class="status-input" type="hidden" name="table" value="ingredients">
                            <div class="keyValues-title">
                                <div class="keyValues-name keyValues-title-item"><span>НАЗВАНИЕ</span></div>
                                <div class="keyValues-key keyValues-title-item"><span>ЗНАЧЕНИЕ</span></div>
                            </div>
                            <div class="keyValues-wrapper">
                                @foreach($product->ingredients as $ingredient)
                                <div class="keyValues-item">
                                    <div class="keyValues-name">
                                        <input class="input" id="input_name" type="text" placeholder value="{{$ingredient['input_name']}}"disabled>
                                    </div>
                                    <div class="keyValues-key">
                                        <input class="input" id="input_count1" type="text" placeholder value="{{$ingredient['input_count1']}}">
                                    </div>
                                    <div class="keyValues-btn-delete">
                                        <button class="keyValues-delete" type="button"><img src="/icons/delete-red.svg"
                                                alt></button>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="keyValues-btn-add">
                                <button class="keyValues-add btn btn-text" type="button"><img src="/icons/add.svg"
                                        alt>Добавить</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Прайс</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <input class="input phone-mask" type="number" placeholder="Прайс" value="{{$product->price}}" name="price">
                    </div>
                </div>
            </div>
            <div class="view-btns">
                <div class="btns-group">
                    <a class="btn btn-text" href="/products">Отмена</a>
                    <button class="btn btn-main" type="submit">Обновить</button>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

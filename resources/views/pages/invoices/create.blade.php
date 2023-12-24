@extends('layout.app')
@section('title','Создать накладную')
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view edit tables">
        <a class="btn btn-text btn-icon" href="/invoices"><img src="/icons/back.svg" alt>Назад</a>
        <div class="title">
            <h2>Создать накладную</h2>
        </div>
        <form action="/invoices" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="view-main">
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Магазин</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <input type="hidden" name="shop_id">
                        <div class="btn select-item select-dropdown">
                            <span class="btn-dropdown">Выберите вариант</span>
                            <ul class="hidden-list">
                            @foreach($shops as $shop)
                            <li class="item-list" value="{{$shop->id}}">{{$shop->name}}</li>
                            @endforeach
                            <li class="list-more" value="">еще </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Тип оплаты</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <select class="btn select-item" name="payment_type">
                            <option value="" disabled selected>Выберите тип оплаты</option>
                            <option value="наличные">Наличные</option>
                            <option value="каспи переводом">Каспи переводом</option>
                            <option value="картой">Картой</option>
                            <option value="долг">Долг</option>
                        </select>
                        @error('payment_type')
                            <div class="error-text">Выберите тип оплаты</div>
                        @enderror
                    </div>
                </div>
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Продукты</p>
                    </div>
                    <div class="view-item-value">
                        <div class="keyValues keyValues-three keyValues-noBtn">
                            <input class="status-input" type="hidden" name="table" value="products">
                            <input class="status-input" type="hidden" name="isSelect" value="true">
                            <input class="hidden-input" type="hidden" name="products">
                            <div class="keyValues-title">
                                <div class="keyValues-name keyValues-title-item"><span>Продукт</span></div>
                                <div class="keyValues-key keyValues-title-item"><span>Стоимость</span></div>
                                <div class="keyValues-value keyValues-title-item"><span>Передано</span></div>
                            </div>
                            <div class="keyValues-wrapper">
                                @foreach($products as $product)
                                <div class="keyValues-item">
                                    <div class="keyValues-name">
                                        <input class="input input-name" id="input_name" type="text" value="{{$product->name}}" disabled>
                                    </div>
                                    <div class="keyValues-key">
                                        <input class="input input-count1" id="input_count1" type="number" value="{{$product->price}}" disabled>
                                    </div>
                                    <div class="keyValues-value">
                                        <input class="input input-count2" id="input_count2" type="number" value="0" placeholder>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Файл</p>
                    </div>
                    <div class="view-item-value image-item">
                        <label class="view-item-image" for="input-file">
                            <img id="uploaded-image" src="/images/no-img.png" alt="">
                        </label>
                        <label class="btn btn-main custom-file-input" for="input-file">Загрузите файл
                            <input class="input-file" name="file" id="input-file" type="file"
                                placeholder="Загрузите файл" accept="image/png, image/jpg">
                            @error('file')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </label>
                    </div>
                </div>
            </div>
            <div class="view-btns">
                <div class="btns-group">
                    <a class="btn btn-text" href="/invoices">Отмена</a>
                    <button class="btn btn-main" type="submit">Создать</button>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

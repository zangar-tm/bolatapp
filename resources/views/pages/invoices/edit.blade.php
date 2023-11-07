@extends('layout.app')
@section('title','Обновить накладную')
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view edit tables">
    <a class="btn btn-text btn-icon" href="/invoices"><img src="/icons/back.svg" alt>Назад</a>
        <div class="title">
            <h2>Обновить накладную: {{$invoice->shop->name}}</h2>
        </div>
        <form action="/invoices/{{$invoice->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="view-main">
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Магазин</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <select class="btn select-item" name="shop_id">
                            @foreach($shops as $shop)
                                <option value="{{$shop->id}}"@if($shop->id == $invoice->shop_id)selected @endif>{{$shop->name}}</option>
                            @endforeach
                        </select>
                        @error('shop_id')
                            <div class="error-text">Выберите магазин</div>
                        @enderror
                    </div>
                </div>
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Тип оплаты</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <select class="btn select-item" name="payment_type">
                            <option value="" disabled selected>Выберите тип оплаты</option>
                            <option value="наличные" @if($invoice->payment_type=="наличные") selected @endif>Наличные</option>
                            <option value="каспи переводом" @if($invoice->payment_type=="каспи переводом") selected @endif>Каспи переводом</option>
                            <option value="картой" @if($invoice->payment_type=="картой") selected @endif>Картой</option>
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
                        <div class="keyValues keyValues-two">
                            <input class="status-input" type="hidden" name="table" value="products">
                            <input class="status-input" type="hidden" name="isSelect" value="true">
                            <input class="hidden-input" type="hidden" name="products">
                            <div class="keyValues-title">
                                <div class="keyValues-name keyValues-title-item"><span>Продукт</span></div>
                                <div class="keyValues-key keyValues-title-item"><span>Передано</span></div>
                            </div>
                            <div class="keyValues-wrapper">
                                @foreach($invoice->products as $prod)
                                <div class="keyValues-item">
                                    <div class="keyValues-name">
                                        <input class="input input-name" id="input_name" type="text" value="{{$prod['input_name']}}" disabled>
                                    </div>
                                    <div class="keyValues-key">
                                        <input class="input input-count1" id="input_count1" type="number" value="{{$prod['input_count2']}}" placeholder>
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
                        <label class="btn btn-main custom-file-input" for="input-file">Загрузите файл
                            <input class="input-file" name="avatar" id="input-file" type="file"
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
                    <button class="btn btn-main" type="submit">Обновить</button>
                </div>
            </div>
        </form> 
    </section>
</div>
@endsection

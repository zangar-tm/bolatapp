@extends('layout.app')
@section('title','Обновить магазин')
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view edit tables">
    <a class="btn btn-text btn-icon" href="/shops"><img src="/icons/back.svg" alt>Назад</a>
        <div class="title">
            <h2>Обновить магазин: {{$shop->name}}</h2>
        </div>
        <form action="/shops/{{$shop->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="view-main">
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Название</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <input class="input" type="text" placeholder="Название" value="{{$shop->name}}" name="name">
                        @error('name')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Адрес</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <input class="input" type="text" placeholder="Адрес" value="{{$shop->address}}" name="address">
                        @error('address')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Телефон продавца</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <input class="input phone-mask" type="text" placeholder="Телефон" value="{{$shop->phone}}" name="phone">
                        @error('phone')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Телефон начальства</p>
                    </div>
                    <div class="view-item-value">
                        <input class="input phone-mask" type="input" placeholder="Телефон начальства"  value="{{$shop->boss_phone}}" name="boss_phone">
                        @error('boss_phone')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Экспедитор</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <select class="btn select-item" name="user_id">
                            <!-- <option value="" disabled selected>Выберите вариант</option> -->
                            @foreach($expeditors as $exp)
                            <option value="{{$exp->id}}"@if($exp->id == $shop->user_id)selected @endif>{{$exp->name}}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="error-text">Выберите экспедитора</div>
                        @enderror
                    </div>
                </div>

                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Тип магазина</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <select class="btn select-item" name="type">
                            <option value="" disabled selected>Выберите тип</option>
                            <option value="консигнация" @if($shop->type=="консигнация") selected @endif>консигнация</option>
                            <option value="обычный" @if($shop->type=="обычный") selected @endif>обычный</option>
                        </select>
                        @error('type')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="view-btns">
                <div class="btns-group">
                    <a class="btn btn-text" href="/shops">Отмена</a>
                    <button class="btn btn-main" type="submit">Обновить</button>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

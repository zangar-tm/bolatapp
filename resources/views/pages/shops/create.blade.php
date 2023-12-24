@extends('layout.app')
@section('title','Создать магазин')

@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view edit tables">
    <a class="btn btn-text btn-icon" href="/shops"><img src="/icons/back.svg" alt>Назад</a>
        <div class="title">
            <h2>Создать магазин</h2>
        </div>
        <form action="/shops" method="POST">
            @csrf
            <div class="view-main">
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Название</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <input class="input" type="text" placeholder="Название" name="name">
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
                        <input class="input" type="text" placeholder="Адрес" name="address">
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
                        <input class="input phone-mask" type="input" placeholder="Телефон продавца" name="phone">
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
                        <input class="input phone-mask" type="input" placeholder="Телефон начальства" name="boss_phone">
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
                            <option value="{{$exp->id}}">{{$exp->name}}</option>
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
                            <option value="консигнация">консигнация</option>
                            <option value="обычный" selected>обычный</option>
                        </select>
                        @error('type')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Бонус</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <select class="btn select-item" name="type">
                            <option value="" disabled selected>Выберите ингредиент</option>
                            <option value="10+1">10+1</option>
                            <option value="15+1">15+1</option>
                            <option value="20+1">20+1</option>
                        </select>
                        @error('bonus')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="view-btns">
                <div class="btns-group">
                    <a class="btn btn-text" href="/shops">Отмена</a>
                    <button class="btn btn-main" type="submit">Создать</button>
                </div>
            </div>
        </form>
        
    </section>
</div>
@endsection
@extends('layout.app')
@section('title','Создать ингредиент')

@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view edit tables">
    <a class="btn btn-text btn-icon" href="/ingredients"><img src="/icons/back.svg" alt>Назад</a>
        <div class="title">
            <h2>Создать ингредиент</h2>
        </div>
        <form action="/ingredients" method="POST">
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
                        <p>Тип</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <select class="btn select-item" name="type">
                            <option value="" disabled selected>Выберите тип</option>
                            <option value="шт">шт</option>
                            <option value="кг">кг</option>
                            <option value="л">л</option>
                            <option value="пачка">пачка</option>
                        </select>
                        @error('type')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="view-btns">
                <div class="btns-group">
                    <a class="btn btn-text" href="/ingredients">Отмена</a>
                    <button class="btn btn-main" type="submit">Создать</button>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

@extends('layout.app')
@section('title','Обновить ингредиент')
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view edit tables">
    <a class="btn btn-text btn-icon" href="/ingredients"><img src="/icons/back.svg" alt>Назад</a>
        <div class="title">
            <h2>Обновить ингредиент: {{ $ingredient->name }}</h2>
        </div>
        <form action="/ingredients/{{$ingredient->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="view-main">
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Название</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <input class="input" type="text" placeholder="Название" name="name"
                        value="{{ $ingredient->name }}">
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
                            <option value="шт" @if($ingredient->type=='шт') selected @endif>шт</option>
                            <option value="гр" @if($ingredient->type=='гр') selected @endif>гр</option>
                            <option value="мл" @if($ingredient->type=='мл') selected @endif>мл</option>
                            <option value="пачка" @if($ingredient->type=='пачка') selected @endif>пачка</option>
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
                    <button class="btn btn-main" type="submit">Обновить</button>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

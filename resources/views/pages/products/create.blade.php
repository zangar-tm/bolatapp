@extends('layout.app')
@section('title','Создать продукт')
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view edit tables">
        <a class="btn btn-text btn-icon" href="/products"><img src="/icons/back.svg" alt>Назад</a>
        <div class="title">
            <h2>Создать продукт</h2>
        </div>
        <form action="/products" method="POST">
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
                        <p>Ингредиенты</p>
                    </div>
                    <div class="view-item-value">
                        <div class="keyValues keyValues-two">
                            <input class="hidden-input" type="hidden" name="ingredients">
                            <input class="status-input" type="hidden" name="table" value="ingredients">
                            <input class="status-input" type="hidden" name="isSelect" value="true">
                            <input class="status-input" type="hidden" name="status" value="small_exp">
                            <div class="keyValues-title">
                                <div class="keyValues-name keyValues-title-item"><span>НАЗВАНИЕ</span></div>
                                <div class="keyValues-key keyValues-title-item"><span>ЗНАЧЕНИЕ</span></div>
                            </div>
                            <div class="keyValues-wrapper">
                                <div class="keyValues-item">
                                    <div class="keyValues-name">
                                        <select class="input select-main" id="input_name" name="role">
                                            <option value="" disabled selected>Выберите вариант</option>
                                            @foreach($ingredients as $ingredient)
                                            <option value="{{$ingredient->name}}">{{$ingredient->name}}({{$ingredient->type}})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="keyValues-key">
                                        <input class="input input-count1" id="input_count1" type="text" placeholder>
                                    </div>
                                    <div class="keyValues-btn-delete">
                                        <button class="keyValues-delete" type="button"><img src="/icons/delete-red.svg"
                                                alt></button>
                                    </div>
                                </div>
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
                        <p>Стоимость</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <input class="input phone-mask" type="number" placeholder="Стоимость" name="price">
                    </div>
                </div>
            </div>
            <div class="view-btns">
                <div class="btns-group">
                    <a class="btn btn-text" href="/products">Отмена</a>
                    <button class="btn btn-main" type="submit">Создать</button>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

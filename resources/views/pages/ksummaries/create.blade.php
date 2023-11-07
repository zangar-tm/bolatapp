@extends('layout.app')
@section('title','Создать отчет')
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view edit tables">
        <a class="btn btn-text btn-icon" href="/ksummaries"><img src="/icons/back.svg" alt>Назад</a>
        <div class="title">
            <h2>Создать отчет</h2>
        </div>
        <form action="/ksummaries" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="view-main">
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Параметры</p>
                    </div>
                    <div class="view-item-value">
                        <div class="keyValues keyValues-three">
                            <input class="status-input" type="hidden" name="table" value="chiefs">
                            <input class="status-input" type="hidden" name="isSelect" value="true">
                            <input class="hidden-input" type="hidden" name="data">
                            <div class="keyValues-title">
                                <div class="keyValues-name keyValues-title-item"><span>Продукт</span></div>
                                <div class="keyValues-key keyValues-title-item"><span>Повар</span></div>
                                <div class="keyValues-value keyValues-title-item"><span>Итого</span></div>
                            </div>
                            <div class="keyValues-wrapper">
                                <div class="keyValues-item">
                                    <div class="keyValues-name">
                                        <select class="input select-main" id="input_name" name="role">
                                            <option value="" disabled selected>Выберите вариант</option>
                                            @foreach($products as $product)
                                            <option value="{{$product->name}}">{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="keyValues-key">
                                        <!-- <input class="input input-count1" id="input_count1" type="number" placeholder> -->
                                        <select class="input select-main" id="input_count1" name="role">
                                            <option value="" disabled selected>Выберите вариант</option>
                                            @foreach($chiefs as $chief)
                                            <option value="{{$chief->full_name}}">{{$chief->full_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="keyValues-value">
                                        <input class="input input-count2" id="input_count2" type="number" placeholder>
                                    </div>
                                    <div class="keyValues-btn-delete">
                                        <button class="keyValues-delete" type="button">
                                            <img src="/icons/delete-red.svg" alt>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="keyValues-btn-add">
                                <button class="keyValues-add btn btn-text" type="button">
                                    <img src="/icons/add.svg" alt>Добавить
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="view-btns">
                <div class="btns-group">
                    <a class="btn btn-text" href="/ksummaries">Отмена</a>
                    <button class="btn btn-main" type="submit">Создать</button>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

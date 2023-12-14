@extends('layout.app')
@section('title','Обновить закуп')
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view edit tables">
    <a class="btn btn-text btn-icon" href="/purchases"><img src="/icons/back.svg" alt>Назад</a>
        <div class="title">
            <h2>Обновить закуп: {{ $purchase->name }}</h2>
        </div>
        <form action="/purchases/{{$purchase->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="view-main">
            <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Параметры</p>
                    </div>
                    <div class="view-item-value">
                        <div class="keyValues keyValues-four">
                            <input class="status-input" type="hidden" name="status" value="purchase">                                 
                            <input class="status-input" type="hidden" name="table" value="ingredients">
                            <input class="hidden-input" type="hidden" name="data">
                            <div class="keyValues-title">
                                <div class="keyValues-name keyValues-title-item"><span>Ингредиент</span></div>
                                <div class="keyValues-key keyValues-title-item"><span>Стоимость</span></div>
                                <div class="keyValues-value keyValues-title-item"><span>Куплено</span></div>
                                <div class="keyValues-count keyValues-title-item"><span>Принято</span></div>
                            </div>
                            <div class="keyValues-wrapper">
                                @foreach($purchase->data as $pur)
                                <div class="keyValues-item">
                                    <div class="keyValues-name">
                                        <input class="input" id="input_name" type="text" value="{{$pur['input_name']}}" disabled>
                                    </div>
                                    <div class="keyValues-key">
                                        <input class="input" id="input_count1" type="number" value="{{$pur['input_count1']}}" placeholder>
                                    </div>
                                    <div class="keyValues-value">
                                        <input class="input" id="input_count2" type="number" value="{{$pur['input_count2']}}">
                                    </div>
                                    <div class="keyValues-count">
                                        <input class="input" id="input_count3" type="number" value="{{$pur['input_count3']}}">
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
            </div>
            <div class="view-btns">
                <div class="btns-group">
                    <a class="btn btn-text" href="/purchases">Отмена</a>
                    <button class="btn btn-main" type="submit">Обновить</button>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

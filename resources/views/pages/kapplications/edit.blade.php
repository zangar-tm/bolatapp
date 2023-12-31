@extends('layout.app')
@section('title','Обновить заявку')
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view edit tables">
    <a class="btn btn-text btn-icon" href="/kapplications"><img src="/icons/back.svg" alt>Назад</a>
        <div class="title">
            <h2>Обновить заявку: {{ $kapplication->name }}</h2>
        </div>
        <form action="/kapplications/{{$kapplication->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="view-main">
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Параметры</p>
                    </div>
                    <div class="view-item-value">
                        <div class="keyValues keyValues-three">
                            <input class="hidden-input" type="hidden" name="data">
                            <div class="keyValues-title">
                                <div class="keyValues-name keyValues-title-item"><span>Продукт</span></div>
                                <div class="keyValues-key keyValues-title-item"><span>Количество на заявку</span></div>
                                <div class="keyValues-value keyValues-title-item"><span>Сделано</span></div>
                            </div>
                            <div class="keyValues-wrapper">
                                @foreach($kapplication->k_data as $app)
                                    <div class="keyValues-item">
                                        <div class="keyValues-name">
                                            <input class="input" id="input_name" type="text" placeholder value="{{$app['input_name']}}" disabled>
                                        </div>
                                        <div class="keyValues-key">
                                            <input class="input" id="input_count1" type="text" value="{{$app['input_count1']}}" @if(auth()->user()->role=='кухня')disabled @endif placeholder>
                                        </div>
                                        <div class="keyValues-value">
                                            <input class="input" id="input_count2" @if(!auth()->user()->role=='кухня')disabled @endif type="text" value="{{$app['input_count2']}}" placeholder>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="view-btns">
                <div class="btns-group">
                    <a class="btn btn-text" href="/kapplications">Отмена</a>
                    <button class="btn btn-main" type="submit">Обновить</button>
                </div>
            </div>
        </form>
            <br>
            <br>
            <br>
            <div class="view-main">
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Нужное количество ингредиентов</p>
                    </div>
                    <div class="view-item-value">
                        <div class="viewTable viewTable-two">
                            <div class="viewTable-title">
                                <div class="viewTable-name viewTable-title-item"><span>Ингредиент</span></div>
                                <div class="viewTable-key viewTable-title-item"><span>Количество</span></div>
                            </div>
                            <div class="viewTable-wrapper">
                                @foreach($needed_ings as $key=>$needing)
                                    <div class="viewTable-item">
                                        <div class="viewTable-name">
                                            <input class="input" type="text" value="{{$key}}" disabled>
                                        </div>
                                        <div class="viewTable-key">
                                            <input class="input" type="text" value="{{-$needing}}" disabled>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
@endsection

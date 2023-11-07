@extends('layout.app')
@section('title','Обновить заявку')
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view edit tables">
    <a class="btn btn-text btn-icon" href="/applications"><img src="/icons/back.svg" alt>Назад</a>
        <div class="title">
            <h2>Обновить заявку от: {{ $application->created_at->format('d.m.Y') }}</h2>
        </div>
        <form action="/applications/{{$application->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="view-main">
                
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Параметры</p>
                    </div>
                    <div class="view-item-value">
                        <div class="keyValues keyValues-four keyValues-noBtn">
                            <input class="status-input" type="hidden" name="status" value="big_exp">
                            <input class="status-input" type="hidden" name="table" value="products">
                            <input class="hidden-input" type="hidden" name="data">
                            <div class="keyValues-title">
                                <div class="keyValues-name keyValues-title-item"><span>Продукт</span></div>
                                <div class="keyValues-key keyValues-title-item"><span>Количество на заявку</span></div>
                                <div class="keyValues-value keyValues-title-item"><span>Итоговое количество</span></div>
                                <div class="keyValues-count keyValues-title-item"><span>Получено</span></div>
                            </div>
                            <div class="keyValues-wrapper">
                            @foreach($application->data as $app)
                                <div class="keyValues-item">
                                    <div class="keyValues-name">
                                        <input class="input" id="input_name" type="text" placeholder value="{{$app['input_name']}}" disabled>
                                    </div>
                                    <div class="keyValues-key">
                                        <input class="input" id="input_count1" type="text" value="{{$app['input_count1']}}" placeholder>
                                    </div>
                                    <div class="keyValues-value">
                                        <input class="input" id="input_count2" disabled type="text" value="{{$app['input_count2']}}" placeholder>
                                    </div>
                                    <div class="keyValues-count">
                                        <input class="input" id="input_count3" disabled type="text" value="{{$app['input_count3']??$app['input_count2']}}" placeholder>
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
                    <a class="btn btn-text" href="/applications">Отмена</a>
                    <button class="btn btn-main" type="submit">Обновить</button>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

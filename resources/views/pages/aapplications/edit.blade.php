@extends('layout.app')
@section('title','Обновить заявку')
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view edit tables">
    <a class="btn btn-text btn-icon" href="/aapplications"><img src="/icons/back.svg" alt>Назад</a>
        <div class="title">
            <h2>Обновить заявку от: {{ $application->created_at->format('d.m.Y') }}</h2>
        </div>
        <form action="/aapplications/{{$application->id}}" method="POST">
            @csrf
            @method('PUT')
            <div class="view-main">
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Параметры</p>
                    </div>
                    <div class="view-item-value">
                        <div class="keyValues keyValues-four keyValues-noBtn">
                            <input class="status-input" type="hidden" name="status" value="">
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
                            @if($app['input_count1']!=''&& $app['input_count1']!=0)
                                <div class="keyValues-item">
                                    <div class="keyValues-name">
                                        <input class="input" id="input_name" type="text" value="{{$app['input_name']}}" disabled>
                                    </div>
                                    <div class="keyValues-key">
                                        <input class="input" id="input_count1" disabled type="text" value="{{$app['input_count1']}}">
                                    </div>
                                    <div class="keyValues-value">
                                        <input class="input" id="input_count2" type="number" value="{{$app['input_count2']??$app['input_count1']}}">
                                    </div>
                                    <div class="keyValues-count">
                                        <input class="input" id="input_count3" type="number" value="{{$app['input_count2']}}" autofocus>
                                    </div>
                                </div>
                                @endif
                            @endforeach
                            </div>
                        </div>
                </div>
                </div>
            </div>
            <div class="view-btns">
                <div class="btns-group">
                    <a class="btn btn-text" href="/aapplications">Отмена</a>
                    <button class="btn btn-main" type="submit">Обновить</button>
                </div>
            </div>
        </form>
        <br>
        <br>
        @if(isset($kapplication))
        <div class="view-main">
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>От кухни</p>
                    </div>
                    <div class="view-item-value">
                        <div class="keyValues keyValues-four keyValues-noBtn">
                            <input class="status-input" type="hidden" name="status" value="small_exp">
                            <input class="status-input" type="hidden" name="table" value="products">
                            <input class="status-input" type="hidden" name="isSelect" value="true">
                            <input class="hidden-input" type="hidden" name="data">
                            <div class="keyValues-title">
                                <div class="keyValues-name keyValues-title-item"><span>Продукт</span></div>
                                <div class="keyValues-key keyValues-title-item"><span>Сделано</span></div>
                                <div class="keyValues-value keyValues-title-item"><span>Осталось</span></div>
                            </div>
                            
                            <div class="keyValues-wrapper">
                                @foreach($kapplication->k_data as $kapp)
                                @if($kapp['input_count2']!='' && $kapp['input_count2']!=0)
                                <div class="keyValues-item">
                                    <div class="keyValues-name">
                                        <input class="input input-name" id="input_name" type="text" value="{{$kapp['input_name']}}" disabled>
                                    </div>
                                    <div class="keyValues-key">
                                        <input class="input input-count1" id="input_count1" type="number" value="{{$kapp['input_count2']??0}}">
                                    </div>
                                    <div class="keyValues-value">
                                        <input class="input input-count2" id="input_count2" type="number" value="0" disabled>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
    </section>
</div>
@endsection

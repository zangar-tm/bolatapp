@extends('layout.app')
@section('title','Закуп')
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view tables">
        <div class="title">
            <h2>Обновить закуп: {{$purchase->created_at->format('d.m.Y')}}</h2>
        </div>
        <div class="view-main">
            <div class="view-item">
                <div class="view-item-key hide">
                    <p>Параметры</p>
                </div>
                <div class="view-item-value">
                    <div class="keyValues keyValues-four keyValues-noBtn">
                        <!-- <input class="status-input" type="hidden" name="status" value="big_exp"> -->
                        <input class="status-input" type="hidden" name="table" value="ingredients">
                        <input class="hidden-input" type="hidden" name="data">
                        <div class="keyValues-title">
                            <div class="keyValues-name keyValues-title-item"><span>Ингредиент</span></div>
                            <div class="keyValues-key keyValues-title-item"><span>Стоимость за единицу</span></div>
                            <div class="keyValues-value keyValues-title-item"><span>Куплено</span></div>
                            <div class="keyValues-key keyValues-title-item"><span>Общая стоимость</span></div>
                            <div class="keyValues-count keyValues-title-item"><span>Принято</span></div>
                        </div>
                        <div class="keyValues-wrapper">
                            @foreach($purchase->data as $p)
                            <div class="keyValues-item">
                                <div class="keyValues-name">
                                    <input class="input" id="input_name" value="{{$p['input_name']}}" type="text" placeholder disabled>
                                </div>
                                <div class="keyValues-key">
                                    <input class="input" id="input_count1" value="{{$p['input_count1']}}" type="text" placeholder disabled>
                                </div>
                                <div class="keyValues-value">
                                    <input class="input" id="input_count2" value="{{$p['input_count2']}}" type="text" placeholder disabled>
                                </div>
                                <div class="keyValues-count">
                                    <input class="input" id="input_count3" type="number" value="{{$p['input_count3']}}" disabled>
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

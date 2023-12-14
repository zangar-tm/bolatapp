@extends('layout.app')
@section('title','Создать заявку')

@section('content')

<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view edit tables">
    <a class="btn btn-text btn-icon" href="/kapplications"><img src="/icons/back.svg" alt>Назад</a>
        <div class="title">
            <h2>Создать заявку</h2>
        </div>
        <form action="/kapplications" method="POST">
            @csrf
            <div class="view-main">
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Параметры</p>
                    </div>
                    <div class="view-item-value">
                        <div class="keyValues keyValues-three keyValues-noBtn">
                            <input class="status-input" type="hidden" name="status" value="small_exp">
                            <input class="status-input" type="hidden" name="table" value="products">
                            <input class="status-input" type="hidden" name="isSelect" value="true">
                            <input class="hidden-input" type="hidden" name="data">
                            <div class="keyValues-title">
                                <div class="keyValues-name keyValues-title-item"><span>Продукт</span></div>
                                <div class="keyValues-key keyValues-title-item"><span>Количество на заявку</span></div>
                                <div class="keyValues-value keyValues-title-item"><span>Сделано</span></div>
                            </div>
                            <div class="keyValues-wrapper">
                                @foreach($products as $key => $product)
                                    @if(isset($totalproducts[$product->name]))
                                    <div class="keyValues-item">
                                        <div class="keyValues-name">
                                            <input class="input input-name" id="input_name" type="text" value="{{$product->name}}" disabled>
                                        </div>
                                        <div class="keyValues-key">
                                            <input class="input input-count1" id="input_count1" type="number" value="{{$totalproducts[$product->name]}}" placeholder>
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
            <div class="view-btns">
                <div class="btns-group">
                    <a class="btn btn-text" href="/kapplications">Отмена</a>
                    <button class="btn btn-main" type="submit">В кухню</button>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

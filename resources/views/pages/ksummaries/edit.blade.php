@extends('layout.app')
@section('title','Обновить отчет')
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view edit tables">
    <a class="btn btn-text btn-icon" href="/ksummaries"><img src="/icons/back.svg" alt>Назад</a>
        <div class="title">
            <h2>Обновить отчет от: {{$ksummary->created_at->format('d.m.Y')}}</h2>
        </div>
        <form action="/ksummaries/{{$ksummary->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                                @foreach($ksummary->data as $ksum)
                                <div class="keyValues-item">
                                    <div class="keyValues-name">
                                        <input class="input input-name" id="input_name" type="text" value="{{$ksum['input_name']}}" disabled>
                                    </div>
                                    <div class="keyValues-key">
                                        <input class="input input-count1" id="input_count1" type="text" value="{{$ksum['input_count1']}}" disabled>
                                    </div>
                                    <div class="keyValues-value">
                                        <input class="input input-count2" id="input_count2" type="number" value="{{$ksum['input_count2']}}">
                                    </div>
                                    <div class="keyValues-btn-delete">
                                        <button class="keyValues-delete" type="button">
                                            <img src="/icons/delete-red.svg" alt>
                                        </button>
                                    </div>
                                </div>
                                @endforeach
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
                    <button class="btn btn-main" type="submit">Обновить</button>
                </div>
            </div>
        </form> 
    </section>
</div>
@endsection

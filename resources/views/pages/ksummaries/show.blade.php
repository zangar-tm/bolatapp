@extends('layout.app')
@section('title','Отчет')
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view tables">
        <div class="btns-group-edit"><a class="btn btn-text btn-icon" href="/ksummaries"><img src="/icons/back.svg" alt="">Назад</a><a class="btn-edit" href="/ksummaries/{{$ksummary->id}}/edit"> 
            <svg class="inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="24" height="24" role="presentation">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg></a></div>
        <div class="title">
            <h2>Обновить отчет от: {{$ksummary->created_at->format('d.m.Y')}}</h2>
        </div>
        <div class="view-main">
            <div class="view-item">
                <div class="view-item-key hide">
                    <p>Параметры</p>
                </div>
                <div class="view-item-value">
                    <div class="keyValues keyValues-three keyValues-noBtn">
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
                                    <input class="input input-count2" id="input_count2" type="number" value="{{$ksum['input_count2']}}" disabled>
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

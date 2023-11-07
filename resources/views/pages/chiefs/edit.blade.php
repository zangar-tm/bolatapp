@extends('layout.app')
@section('title','Обновить повара')
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view edit tables">
    <a class="btn btn-text btn-icon" href="/chiefs"><img src="/icons/back.svg" alt>Назад</a>
        <div class="title">
            <h2>Обновить повара: {{$chief->full_name}}</h2>
        </div>
        <form action="/chiefs/{{$chief->id}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="view-main">
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>ФИО</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <input class="input" type="text" placeholder="ФИО" value="{{$chief->full_name}}" name="full_name">
                        @error('full_name')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="view-btns">
                <div class="btns-group">
                    <a class="btn btn-text" href="/chiefs">Отмена</a>
                    <button class="btn btn-main" type="submit">Обновить</button>
                </div>
            </div>
        </form> 
    </section>
</div>
@endsection

@extends('layout.app')
@section('title','Настройки')
@section('content')
<div class="main-content">
@include('partials.menu')
<div class="close-menu-bg"></div>
<section class="view edit tables">
    <div class="title">
        <h2>Настройки</h2>
    </div>
    <form action="/company/update" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="view-main">
            <div class="view-item">
                <div class="view-item-key">
                    <p>Логотип</p><span>*</span>
                </div>
                <div class="view-item-value image-item">
                    <label class="view-item-image" for="input-file"><img id="uploaded-image" src="@if($logoPath)/storage/{{$logoPath}}@else /images/no-img.png @endif" alt=""></label>
                    <label class="btn btn-main custom-file-input" for="input-file">Загрузите файл
                        <input class="input-file" name="logo" id="input-file" type="file" placeholder="Загрузите файл" accept="">
                    </label>
                </div>
            </div>
            <div class="view-item">
                <div class="view-item-key">
                    <p>Название компании</p>
                </div>
                <div class="view-item-value">
                    <input class="input" type="text" placeholder="Название компании" name="name" value="{{$companyName}}">
                </div>
            </div>
        </div>
        <div class="view-btns">
            <div class="btns-group">
                <button class="btn btn-main" type="submit">Сохранить</button>
            </div>
        </div>
    </form>
    
</section>
</div>
@endsection

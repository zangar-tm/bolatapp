@extends('layout.app')
@section('title','Повар '.$chief->full_name)
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view tables">
        <div class="btns-group-edit"><a class="btn btn-text btn-icon" href="/chiefs"><img src="/icons/back.svg" alt="">Назад</a><a class="btn-edit" href="/chiefs/{{$chief->id}}/edit"> 
            <svg class="inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="24" height="24" role="presentation">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg></a></div>
        <div class="title">
            <h2>Обновить повара: {{$chief->full_name}}</h2>
        </div>
        <div class="view-main">
            <div class="view-item">
                <div class="view-item-key">
                    <p>ФИО</p>
                </div>
                <div class="view-item-value">
                    <p>{{$chief->full_name}}</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

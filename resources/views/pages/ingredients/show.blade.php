@extends('layout.app')
@section('title','Ингредиент '.$ingredient->name)
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view tables tables-ingredients">
        <div class="btns-group-edit"><a class="btn btn-text btn-icon" href="/ingredients"><img src="/icons/back.svg" alt="">Назад</a><a class="btn-edit" href="/edit"> 
            <svg class="inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="24" height="24" role="presentation">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg></a></div>
        <div class="title">
            <h2>Обновить ингредиент: {{$ingredient->name}}</h2>
        </div>
        
        <div class="view-main">
            <div class="view-item">
                <div class="view-item-key">
                    <p>Название</p>
                </div>
                <div class="view-item-value">
                    <p>{{$ingredient->name}}</p>
                </div>
            </div>
            <div class="view-item">
                <div class="view-item-key">
                    <p>Тип</p>
                </div>
                <div class="view-item-value">
                    <p>{{$ingredient->type}}</p>
                </div>
            </div>
        </div>
        <div class="tables-wrapper">
          <div class="filters">
          <form class="date-filter date-filter-range" action="/ingredients/{{$ingredient->id}}"> 
            <input class="input" id="calendar_from" type="date" name="from_date" value="{{request('from_date')}}" placeholder="От"><span class="block mx-0.5">-</span>
            <input class="input" id="calendar_to" type="date" name="to_date" value="{{request('to_date')}}" placeholder="До">
            <button class="btn btn-main" type="submit">Показать</button>
          </form>
        </div>
          <table class="tables-item">
            <thead class="tables-head">
              <tr class="tables-item-row">
              <th class="th-max-100"><span>ID</span></th>
                <th><span>Стоимость</span></th>
                <th><span>Дата</span></th>
              </tr>
            </thead>
            <tbody class="tables-body">
              @foreach($ingprices as $key => $ingp)
              <tr class="tables-item-row">
                <td class="td-max-100"><a class="tables-link tables-id" href="#">{{$key+1}}</a></td>
                <td><a class="tables-link" href="#">{{$ingp->price}}</a></td>
                <td><a class="tables-link" href="#">{{$ingp->created_at->format('d.m.Y')}}</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </section>
</div>
@endsection

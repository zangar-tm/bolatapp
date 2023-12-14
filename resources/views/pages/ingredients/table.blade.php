@extends('layout.app')
@section('title','Таблица ингредиентов')
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view edit tables">
        <div class="title">
            <h2>Таблица</h2>
        </div>
        <div class="filters">
          <form class="date-filter date-filter-range" action="/ingredients-table"> 
            <input class="input" id="calendar_from" type="date" name="from_date" value="{{request('from_date')??now()->format('Y-m-d')}}" placeholder="От"><span class="block mx-0.5">-</span>
            <input class="input" id="calendar_to" type="date" name="to_date" value="{{request('to_date')??now()->format('Y-m-d')}}" placeholder="До">
            <button class="btn btn-main" type="submit">Показать</button>
          </form>
        </div>
        <div class="view-main prodExp">
          <div class="prodExp-table">
            <div class="prodExp-container">
              <div class="prodExp-row">
                <div class="prodExp-cell">Ингредиент</div>
                <div class="prodExp-cell">Приход</div>
                <div class="prodExp-cell">Уход</div>
                <div class="prodExp-cell">Осталось</div>
              </div>
              @foreach($purchased_ings as $key => $ping)
              <div class="prodExp-row">
              @php
                  $type = App\Models\Ingredient::where('name',$key)->first()->type;
              @endphp
                <div class="prodExp-cell">{{$key}} {{ $type}}</div>
                <div class="prodExp-cell">{{$ping}}</div>
                <div class="prodExp-cell">{{isset($used_ings[$key]) ?$used_ings[$key]: 0}}</div>
                <div class="prodExp-cell">{{$ping-(-isset($used_ings[$key]) ?$used_ings[$key]: 0)}}</div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
    </section>
</div>
@endsection

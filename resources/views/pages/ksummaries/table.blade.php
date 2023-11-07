@extends('layout.app')
@section('title','Таблица кухни')
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view edit tables">
        <div class="title">
            <h2>Таблица</h2>
        </div>
        <div class="filters">
          <form class="date-filter date-filter-range" action="/ksummaries-table"> 
            <input class="input" id="calendar_from" type="date" name="from_date" value="{{request('from_date')??now()->format('Y-m-d')}}" placeholder="От"><span class="block mx-0.5">-</span>
            <input class="input" id="calendar_to" type="date" name="to_date" value="{{request('to_date')??now()->format('Y-m-d')}}" placeholder="До">
            <button class="btn btn-main" type="submit">Показать</button>
          </form>
        </div>
        <div class="view-main prodExp">
          <div class="prodExp-table">
            @if(!empty($preparedData))
            <div class="prodExp-container">
              <div class="prodExp-row">
                <div class="prodExp-cell">Продукты</div>
                @foreach($users as $user)
                <div class="prodExp-cell">{{ $user }}</div>
                @endforeach
                <div class="prodExp-cell">Итого</div>
              </div>
              @foreach($preparedData as $product => $userValues)
              <div class="prodExp-row">
                <div class="prodExp-cell">{{ $product  }}</div>
                @php
                  $sum = 0;
                @endphp
                @foreach($users as $user)
                @php
                $sum += $userValues[$user]??0;
                @endphp
                <div class="prodExp-cell">{{ $userValues[$user] ?? 0 }}</div>
                @endforeach
                <div class="prodExp-cell">{{ $sum }}</div>
              </div>
              @endforeach
            </div>
            @endif
          </div>
        </div>
    </section>
</div>
@endsection

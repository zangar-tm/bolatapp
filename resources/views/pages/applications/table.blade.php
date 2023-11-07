@extends('layout.app')
@section('title','Таблица экспедиторов')
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view edit tables">
        <div class="title">
            <h2>Таблица</h2>
        </div>
        <div class="filters">
          <form class="date-filter date-filter-range" action="/applications-table"> 
            <input class="input" id="calendar_from" type="date" name="from_date" value="{{request('from_date')??now()->format('Y-m-d')}}" placeholder="От"><span class="block mx-0.5">-</span>
            <input class="input" id="calendar_to" type="date" name="to_date" value="{{request('to_date')??now()->format('Y-m-d')}}" placeholder="До">
            <button class="btn btn-main" type="submit">Показать</button>
          </form>
        </div>
        <div class="view-main prodExp">
          <div class="prodExp-table">
            <div class="prodExp-container">
              <div class="prodExp-row">
                <div class="prodExp-cell">Продукт</div>
                @foreach ($expeditors as $exp)
                <div class="prodExp-cell">{{ $exp->name }}</div>
                @endforeach
                <div class="prodExp-cell">Итого получено</div>
              </div>
              @foreach ($products as $product)
              <div class="prodExp-row">
                @php
                $sum = 0;
                @endphp
                <div class="prodExp-cell">{{ $product->name }}</div>
                @foreach ($expeditors as $exp)
                <div class="prodExp-cell">{{ $reportData[$product->name][$exp->name] ?? 0 }}</div>
                @php
                  $sum += $reportData[$product->name][$exp->name] ?? 0;
                @endphp
                @endforeach
                <div class="prodExp-cell">{{ $sum }}</div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
    </section>
</div>
@endsection

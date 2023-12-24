@php
  $setting = App\Models\Setting::whereId(1)->first();
  $logo='';
  if(isset($setting)){
    $logo = $setting->data['logo_path'];
  }
@endphp
<section class="aside">
    <div class="aside-logo">
        <img src="@if($logo!='')/storage/{{$logo}}@else/{{config('company.logo_path')}} @endif" alt="">
    </div>
    <button class="btn-close-menu">
        <img src="/images/close.svg" alt="">
    </button>
    <div class="aside-main">
        @if(in_array(auth()->user()->role,['админ']))
        <a class="aside-item @if(Route::currentRouteName() === 'users.index' or request()->is('users/*')) active @endif" href="/users">
            <div class="aside-item-icon"><img src="/icons/users.svg" alt=""></div>Сотрудники
        </a>
        @endif
        @if(in_array(auth()->user()->role,['админ','менеджер','экспедитор','старший экспедитор']))
        <a class="aside-item @if(Route::currentRouteName() === 'shops.index' or request()->is('shops/*')) active @endif" href="/shops">
            <div class="aside-item-icon"><img src="/icons/store.svg" alt=""></div>Магазины
        </a>
        @endif
        @if(in_array(auth()->user()->role,['админ','менеджер']))
        <a class="aside-item @if(Route::currentRouteName() === 'products.index' or request()->is('products/*')) active @endif" href="/products">
            <div class="aside-item-icon"><img src="/icons/product.svg" alt=""></div>Продукты
        </a>
        @endif
        @if(in_array(auth()->user()->role,['админ','менеджер']))
        <a class="aside-item @if(Route::currentRouteName() === 'ingredients.index') or request()->is('ingredients/*')) active @endif" href="/ingredients">
            <div class="aside-item-icon"><img src="/icons/ingredients.svg" alt=""></div>Ингредиенты
        </a>
        @endif
        @if(in_array(auth()->user()->role,['админ','менеджер','экспедитор','старший экспедитор']))
        <a class="aside-item @if(Route::currentRouteName() === 'invoices.index')  or request()->is('invoices/*')) active @endif" href="/invoices">
            <div class="aside-item-icon"><img src="/icons/invoice.svg" alt=""></div>Накладные
        </a>
        @endif
        @if(in_array(auth()->user()->role,['админ','менеджер']))
        <a class="aside-item @if(Route::currentRouteName() === 'chiefs.index') or request()->is('chiefs/*')) active @endif" href="/chiefs">
            <div class="aside-item-icon"><img src="/icons/chief.svg" alt=""></div>Повара
        </a>
        @endif
        @if(in_array(auth()->user()->role,['админ','экспедитор','старший экспедитор']))
        <a class="aside-item @if(Route::currentRouteName() === 'applications.index') or request()->is('applications/*')) active @endif" href="/applications">
            <div class="aside-item-icon"><img src="/icons/forwarder.svg" alt=""></div>Заявки к ст.экспедитору
        </a>
        @endif
        @if(in_array(auth()->user()->role,['админ','старший экспедитор']))
        <a class="aside-item @if(Route::currentRouteName() === 'applications.aa_index') or request()->is('aapplications/*')) active @endif" href="/aapplications">
            <div class="aside-item-icon"><img src="/icons/forwarder.svg" alt=""></div>Заявки от экспедиторов
        </a>
        @endif
        @if(in_array(auth()->user()->role,['админ','старший экспедитор','кухня','закупщик']))
        <a class="aside-item @if(Route::currentRouteName() === 'kapplications.index') or request()->is('kapplications/*')) active @endif" href="/kapplications">
            <div class="aside-item-icon"><img src="/icons/kitchen.svg" alt=""></div>Заявки в кухню
        </a>
        @endif
        @if(in_array(auth()->user()->role,['админ','кухня']))
        <a class="aside-item @if(Route::currentRouteName() === 'ksummaries.index') or request()->is('ksummaries/*')) active @endif" href="/ksummaries">
            <div class="aside-item-icon"><img src="/icons/report.svg" alt=""></div>Отчеты кухни
        </a>
        @endif
        @if(in_array(auth()->user()->role,['админ','закупщик','кухня']))
        <a class="aside-item @if(Route::currentRouteName() === 'purchases.index') or request()->is('purchases/*')) active @endif" href="/purchases">
            <div class="aside-item-icon"><img src="/icons/cart.svg" alt=""></div>Закуп
        </a>
        @endif
        @if(in_array(auth()->user()->role,['админ','кухня']))
        <a class="aside-item @if(Route::currentRouteName() === 'ksummaries.table') active @endif" href="/ksummaries-table">
            <div class="aside-item-icon"><img src="/icons/report.svg" alt=""></div>Таблица кухни
        </a>
        @endif
        @if(in_array(auth()->user()->role,['админ','старший экспедитор']))
        <a class="aside-item @if(Route::currentRouteName() === 'applications.table') active @endif" href="/applications-table">
            <div class="aside-item-icon"><img src="/icons/forwarder.svg" alt=""></div>Таблица экспедиторов
        </a>
        @endif
        @if(in_array(auth()->user()->role,['админ','закупщик','кухня']))
        <a class="aside-item @if(Route::currentRouteName() === 'ingredients.table')) active @endif" href="/ingredients-table">
            <div class="aside-item-icon"><img src="/icons/cart.svg" alt=""></div>Таблица ингредиентов
        </a>
        @endif
        @if(in_array(auth()->user()->role,['админ','менеджер']))
        <a class="aside-item @if(Route::currentRouteName() === 'setting.edit') active @endif" href="/company/edit">
            <div class="aside-item-icon"><img src="/icons/settings.svg" alt=""></div>Наcтройки
        </a>
        @endif
    </div>
</section>

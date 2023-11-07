@php
  $setting = App\Models\Setting::whereId(1)->first();
  $logo='';
  if(isset($setting)){
    $logo = $setting->data['logo_path'];
  }
@endphp
<header class="nav">
  <button class="btn-burger">
    <svg class="inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="24" height="24" role="presentation">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
  </button>
  <div class="nav-logo"><a href="/users"> <img src="@if($logo!='')/storage/{{$logo}}@else/{{config('company.logo_path')}} @endif" alt=""></a></div>
  <div class="nav-user">
    <button class="nav-user-btn">
      <div class="nav-user-image"><img src="/images/avatar.png" alt=""></div>
      <div class="nav-user-name">
        <p>{{auth()->user()->name}}</p>
      </div>
      <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6">
        <path class="fill-current" d="M8.292893.292893c.390525-.390524 1.023689-.390524 1.414214 0 .390524.390525.390524 1.023689 0 1.414214l-4 4c-.390525.390524-1.023689.390524-1.414214 0l-4-4c-.390524-.390525-.390524-1.023689 0-1.414214.390525-.390524 1.023689-.390524 1.414214 0L5 3.585786 8.292893.292893z"></path>
      </svg>
    </button>
    <ul class="nav-user-dropdown">
      <li> 
        <a class="logout" href="/logout"><img src="/icons/logout.svg" alt="">Выйти</a>
      </li>
    </ul>
  </div>
</header>

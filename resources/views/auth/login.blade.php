<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/app.css">
    <title>Вход</title>
  </head>
  <body>
    <section class="login">
    @php
      $setting = App\Models\Setting::whereId(1)->first();
      $logo='';
      if(isset($setting)){
        $logo = $setting->data['logo_path'];
      }
    @endphp
      <div class="login-logo"><img src="@if($logo!='')/storage/{{$logo}} @else /{{config('company.logo_path')}} @endif" alt=""></div>
      <div class="login-container">
        <h1>Добро пожаловать!</h1>
        <form class="login-form" action="/login" method="POST">
          @csrf
          <div class="input-group">
            <label for="email">Электронный адрес</label>
            <input class="input" type="email" name="email">
          </div>
          <div class="input-group">
            <label for="password">Пароль</label>
            <input class="input" type="password" name="password">
          </div>
          <button class="btn btn-main" type="submit">Войти</button>
        </form>
      </div>
    </section>
    <script src="/js/app.js"></script>
  </body>
</html>
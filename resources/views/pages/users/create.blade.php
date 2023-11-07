@extends('layout.app')
@section('title','Создать сотрудника')
@section('content')
<div class="main-content">
    @include('partials.menu')
    <div class="close-menu-bg"></div>
    <section class="view edit tables">
        <a class="btn btn-text btn-icon" href="/users"><img src="/icons/back.svg" alt>Назад</a>
        <div class="title">
            <h2>Создать сотрудника</h2>
        </div>
        <form action="/users" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="view-main">
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Имя</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <input class="input" type="text" placeholder="Имя" name="name">
                        @error('name')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Роль</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <select class="btn select-item" name="role">
                            <option value="" disabled selected>Выберите роль</option>
                            <option value="админ">админ</option>
                            <option value="кухня">кухня</option>
                            <option value="экспедитор">экспедитор</option>
                            <option value="старший экспедитор">старший экспедитор</option>
                            <option value="закупщик">закупщик</option>
                        </select>
                        @error('role')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- <div class="view-item">
                    <div class="view-item-key">
                        <p>Аватар</p><span>*</span>
                    </div>
                    <div class="view-item-value image-item">
                        <label class="view-item-image" for="input-file"><img id="uploaded-image"
                                src="/images/no-img.png" alt=""></label>
                        <label class="btn btn-main custom-file-input" for="input-file">Загрузите файл
                            <input class="input-file" name="avatar" id="input-file" type="file"
                                placeholder="Загрузите файл" accept="image/png, image/jpg">
                            @error('avatar')
                                <div class="error-text">{{ $message }}</div>
                            @enderror
                        </label>
                    </div>
                </div> -->
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Телефон</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <input class="input phone-mask" type="input" placeholder="Телефон" name="phone">
                        @error('phone')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Email</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <input class="input" type="email" placeholder="Email" name="email">
                        @error('email')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="view-item">
                    <div class="view-item-key hide">
                        <p>Пароль</p><span>*</span>
                    </div>
                    <div class="view-item-value">
                        <input class="input" type="password" placeholder="Пароль" name="password">
                        @error('password')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="view-item">
                    <div class="view-item-key hide">
                    <p>Примечание</p>
                    </div>
                    <div class="view-item-value">
                    <textarea class="input" placeholder="Примечание" cols="30" rows="3" name="note"></textarea>
                        @error('note')
                            <div class="error-text">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="view-btns">
                <div class="btns-group">
                    <a class="btn btn-text" href="/users">Отмена</a>
                    <button class="btn btn-main" type="submit">Создать</button>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

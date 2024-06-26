<!DOCTYPE html>
<html lang="ru">
<head>
    <x-head>Авторизация</x-head>
    @vite(['resources/css/auth.css', 'resources/js/auth.js'])
</head>
<body>
<div style="display: none" id="user">{{ auth()->id() }}</div>
<x-header></x-header>
    <main>
        <div class="forms-container">
            <form action="{{ route('register') }}" method="post">
                @csrf
                <h2 class="title">Создайте аккаунт</h2>
                <p>Добро пожаловать! Создайте аккаунт для получения доступа к услугам сайта.</p>
                <div>
                    <label for="reg-sername__input" class="text-password__label">Фамилия</label>
                    <input id="reg-sername__input" value="{{ old('surname') }}" name="surname" type="text" placeholder="Введите свою фамилию" required>
                </div>
                <div>
                    <label for="reg-name__input" class="text-password__label">Имя</label>
                    <input id="reg-name__input" value="{{ old('firstname') }}" name="firstname" type="text" placeholder="Введите свое имя" required>
                </div>
                <div>
                    <label for="reg-email__input" class="text-password__label">Почта</label>
                    <input id="reg-email__input" @if($active == 'register') value="{{ old('email') }}" @endif name="email" type="email" placeholder="Введите свою почту" required>
                </div>
                <div class="password-container__div">
                    <div>
                        <label for="reg-password__input" class="text-password__label">Пароль</label>
                        <input id="reg-password__input" class="small-password__input" name="password" type="password" placeholder="Введите пароль" required>
                    </div>
                    <div id="reg-password-eye" class="form__eye pass-open pass-close">
                        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m17.069 6.546 2.684-2.359c.143-.125.32-.187.497-.187.418 0 .75.34.75.75 0 .207-.086.414-.254.562l-16.5 14.501c-.142.126-.319.187-.496.187-.415 0-.75-.334-.75-.75 0-.207.086-.414.253-.562l2.438-2.143c-1.414-1.132-2.627-2.552-3.547-4.028-.096-.159-.144-.338-.144-.517s.049-.358.145-.517c2.111-3.39 5.775-6.483 9.853-6.483 1.815 0 3.536.593 5.071 1.546zm2.319 1.83c.966.943 1.803 2.014 2.474 3.117.092.156.138.332.138.507s-.046.351-.138.507c-2.068 3.403-5.721 6.493-9.864 6.493-1.297 0-2.553-.313-3.729-.849l1.247-1.096c.795.285 1.626.445 2.482.445 3.516 0 6.576-2.622 8.413-5.5-.595-.932-1.318-1.838-2.145-2.637zm-3.434 3.019c.03.197.046.399.046.605 0 2.208-1.792 4-4 4-.384 0-.756-.054-1.107-.156l1.58-1.389c.895-.171 1.621-.821 1.901-1.671zm-.058-3.818c-1.197-.67-2.512-1.077-3.898-1.077-3.465 0-6.533 2.632-8.404 5.5.853 1.308 1.955 2.567 3.231 3.549l1.728-1.519c-.351-.595-.553-1.289-.553-2.03 0-2.208 1.792-4 4-4 .925 0 1.777.315 2.455.843zm-2.6 2.285c-.378-.23-.822-.362-1.296-.362-1.38 0-2.5 1.12-2.5 2.5 0 .36.076.701.213 1.011z" fill-rule="nonzero"/></svg>
                        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z" fill-rule="nonzero"/></svg>
                    </div>
                </div>
                <div>
                    <label for="reg-password-again__input" class="text-password__label">Повторите пароль</label>
                    <input id="reg-password-again__input" name="password_confirm" type="password" placeholder="Повторите пароль" required>
                </div>
                <div class="radio-container">
                    <div>
                        <input id="patient-ident__input" checked value="person" name="status" type="radio">
                        <label for="patient-ident__input" class="radio__label">Я пациент</label>
                    </div>
                    <div>
                        <input id="doctor-ident__input" value="medic" name="status" type="radio" required>
                        <label for="doctor-ident__input" class="radio__label">Я врач</label>
                    </div>
                </div>
                <button type="submit">Зарегистрироваться</button>
                @if($errors->all() && $active == 'register')
                    <span class="form__error">{{ $errors->all()[0] }}</span>
                @endif
                <span class="form-leafer">Уже есть аккаунт? - <a class="link log-link">Войти</a></span>
            </form>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <h2 class="title">Вход</h2>
                <p>Добро пожаловать! Войдите аккаунт для получения доступа к услугам сайта</p>
                <div>
                    <label for="log-email__input" class="text-password__label">Почта</label>
                    <input id="log-email__input" @if($active == 'login') value="{{ old('email') }}" @endif name="email" type="email" placeholder="Введите почту" required>
                </div>
                <div class="password-container__div">
                    <div>
                        <label for="log-password__input" class="text-password__label">Пароль</label>
                        <input id="log-password__input" class="small-password__input" name="password" type="password" placeholder="Введите пароль" required>
                    </div>
                    <div id="log-password-eye" class="form__eye pass-open pass-close">
                        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m17.069 6.546 2.684-2.359c.143-.125.32-.187.497-.187.418 0 .75.34.75.75 0 .207-.086.414-.254.562l-16.5 14.501c-.142.126-.319.187-.496.187-.415 0-.75-.334-.75-.75 0-.207.086-.414.253-.562l2.438-2.143c-1.414-1.132-2.627-2.552-3.547-4.028-.096-.159-.144-.338-.144-.517s.049-.358.145-.517c2.111-3.39 5.775-6.483 9.853-6.483 1.815 0 3.536.593 5.071 1.546zm2.319 1.83c.966.943 1.803 2.014 2.474 3.117.092.156.138.332.138.507s-.046.351-.138.507c-2.068 3.403-5.721 6.493-9.864 6.493-1.297 0-2.553-.313-3.729-.849l1.247-1.096c.795.285 1.626.445 2.482.445 3.516 0 6.576-2.622 8.413-5.5-.595-.932-1.318-1.838-2.145-2.637zm-3.434 3.019c.03.197.046.399.046.605 0 2.208-1.792 4-4 4-.384 0-.756-.054-1.107-.156l1.58-1.389c.895-.171 1.621-.821 1.901-1.671zm-.058-3.818c-1.197-.67-2.512-1.077-3.898-1.077-3.465 0-6.533 2.632-8.404 5.5.853 1.308 1.955 2.567 3.231 3.549l1.728-1.519c-.351-.595-.553-1.289-.553-2.03 0-2.208 1.792-4 4-4 .925 0 1.777.315 2.455.843zm-2.6 2.285c-.378-.23-.822-.362-1.296-.362-1.38 0-2.5 1.12-2.5 2.5 0 .36.076.701.213 1.011z" fill-rule="nonzero"/></svg>
                        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z" fill-rule="nonzero"/></svg>
                    </div>
                </div>
                <button type="submit">Войти</button>
                @if($errors->all() && $active == 'login')
                    <span class="form__error">{{ $errors->all()[0] }}</span>
                @endif
                <span class="form-leafer">Еще нет аккаунта? - <a class="link reg-link">Создай!</a></span>
            </form>
        </div>
    </main>
</body>
</html>

<!DOCTYPE html>
<html lang="ru">
<head>
    <x-head>Online Medical Apps</x-head>
</head>
<body>
<x-header></x-header>

<div class="section step__section">
    <div class="container step__container">
        <img class="step__img" src="img/icons/step0.svg" alt="img">
        <div class="step__block">
            <h2>Здравствуйте, давайте начнем!</h2>
            <a class="btn" href="{{route('login')}}">Вход</a>
            <a class="btn btn--2" href="{{route('register')}}">Регистрация</a>
        </div>
    </div>
</div>
</body>
</html>

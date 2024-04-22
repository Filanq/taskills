<!DOCTYPE html>
<html lang="ru">
<head>
    <x-head>Звонок</x-head>
    @vite("resources/js/call.js")
</head>
<body>
<x-header></x-header>
<div class="section">
    <div style="display: none" id="user">{{ auth()->id() }}</div>
    <input type="hidden" id="csrf" value="{{ csrf_token() }}">
    <input type="hidden" id="callId" value="{{ $call_id }}">
    <input type="hidden" id="offer_id" value="{{ $offer_id }}">
    <input type="hidden" id="answer_id" value="{{ $answer_id }}">
    <div class="container">
        <h3>Звонок</h3>
        <div class="wrap__call">
            <div class="wrap__video">
                <div class="block__video">
                    <div class="block__persone">
                        <img src="{{ asset('img/avatars/' . $remote_user->avatar) }}" alt="Аватар">
                        <p>{{ $remote_user->firstname }} {{ $remote_user->surname }}</p>
                    </div>
                    <video id="remote" class="web__person--sobes" autoplay></video>
                </div>
                <div class="block__video block__video--my">
                    <video id="local" class="web__person" autoplay muted></video>
                </div>
            </div>
            <div class="interactive_button">
{{--                <a class="web__btn web__btn--micro" href="#"></a>--}}
{{--                <a class="web__btn" href="#"></a>--}}
                <a id="quitBtn" class="web__btn web__btn--red" href="#"></a>
            </div>
        </div>
    </div>
</div>
</body>
</html>

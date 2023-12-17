<!DOCTYPE html>
<html lang="ru">
<head>
    <x-head>{{ $user->firstname }} {{ $user->surname }}</x-head>
    @vite('resources/js/chat.js')
</head>
<body>
<div style="display: none" id="user">{{ auth()->id() }}</div>
    <div class="section">
        <div class="container">
            <h3>Профиль доктора</h3>
            <div class="wrap__office">
                <div class="block__office block__office--my_info">
                    <p class="my_name">{{ $user->firstname }} {{ $user->surname }}</p>
                    <img class="my_avatar" src="{{ asset("img/avatars/{$user->avatar}") }}" alt="Аватар">
                    <table class="wrap__my_info">
                        <tr>
                            <th class="info__th">Возраст</th>
                            <td class="info__td">{{ $user->age }}</td>
                        </tr>
                        <tr>
                            <th class="info__th">Пол</th>
                            <td class="info__td">{{ $user->sex }}</td>
                        </tr>
                        <tr>
                            <th class="info__th">Специализация</th>
                            <td class="info__td">{{ $user->specialization }}</td>
                        </tr>
                        <tr>
                            <th class="info__th">Местоположение</th>
                            <td class="info__td">{{ $user->location }}</td>
                        </tr>
                        <tr>
                            <th class="info__th">График</th>
                            <td class="info__td">{{ $user->graphic }}</td>
                        </tr>
                    </table>

                    @if(!$is_guest)
                        <a class="btn btn--my_info" href="{{ route('profile.edit') }}">Редактировать</a>
                    @elseif($is_guest && auth()->check())
                        @if($call_link)
                           <a class="btn btn--my_info" href="{{ route('call', ['answer_id' => $curr_user->id, 'offer_id' => $user->id]) }}">Ответить</a>
                        @else
                            <a class="btn btn--my_info" href="{{ route('call', ['offer_id' => $curr_user->id, 'answer_id' => $user->id]) }}">Позвонить</a>
                        @endif
                    @endif
                </div>
                <div class="wrap__info_office">
                    <div class="block__office">
                        <h4>История болезней</h4>
                        @if(!isset($logs[0]))
                            <p>Отсутствует</p>
                        @else
                            <div class="wrap__dop_info wrap__dop_info--disease">
                                @foreach($logs as $log)
                                    <a class=" block__dop_info block__dop_info--disease" href="#">
                                        <p>{{ $log->title }} ({{ $log->firstname }} {{ $log->surname }})</p>
                                        <span>{{ $log->date }}</span>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <div class="block__office">
                        <h4>Справки</h4>
                        @if(!isset($certificates[0]))
                            <p>Отсутствуют</p>
                        @else
                            <div class="wrap__dop_info">
                                @foreach($certificates as $certificate)
                                    <a class="block__dop_info" href="#">
                                        <p>{{ $certificate->title }} ({{ $certificate->firstname }} {{ $certificate->surname }})</p>
                                        <span>{{ $certificate->date }}</span>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    @if($is_guest && auth()->check())
                        <div class="block__office block__office--sms">
                            <h4 style="border-bottom: 1px solid #9f9f9f; padding-bottom: 15px; margin-bottom: 15px;">Чат</h4>
                            <div class="wrap__dop_info--sms">
                                @if(!isset($chat_data[0]))
                                    <p style="width: 100%; color: #9f9f9f; text-align: center">Напишите ваше первое сообщение</p>
                                @else
                                    @foreach($chat_data as $message)
                                        <div class="@if($message->sender_id == $user->id) block__dop_info--sms--answer @endif block__dop_info--sms">
                                            <img class="@if($message->sender_id == $user->id) avatar__dop_info--answer @endif avatar__dop_info" src="{{ asset('img/avatars/' . ($message->sender_id == $user->id ? $user->avatar : $curr_user->avatar)) }}" alt="Аватар">
                                            <p class="@if($message->sender_id == $user->id) text__dop_info--answer @endif text__dop_info">{{ $message->message }}</p>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <form action="{{ route('message.send') }}" id="chatForm" method="post" class="block__dop_info--text">
                                <input class="input_btn chat_input" type="text" placeholder="Сообщение...">
                                <input class="input_btn_push" type="submit" value>
                            </form>
                            <div style="display: none" id="dataForAjax">{{ json_encode((object)["csrf" => csrf_token(), "user_id" => $user->id, "sender_id" => $curr_user->id, "avatarStorage" => asset('img/avatars/')]) }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>

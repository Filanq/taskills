<!DOCTYPE html>
<html lang="ru">
<head>
    <x-head>{{ $user->firstname }} {{ $user->surname }}</x-head>
    @vite('resources/js/profile.js')
    @vite('resources/js/chat.js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
</head>
<body>
    <div class="section">
        <div class="container">
            <h3>Профиль</h3>
            <div class="wrap__office">
                <div class="block__office block__office--my_info">
                    <p class="my_name">{{ $user->firstname }} {{ $user->surname }}</p>
                    <img class="my_avatar" src="{{ asset('img/avatars/' . $user->avatar) }}" alt="Аватар">
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
                            <th class="info__th">Семейное положение</th>
                            <td class="info__td">{{ $user->status }}</td>
                        </tr>
                        <tr>
                            <th class="info__th">Местоположение</th>
                            <td class="info__td">{{ $user->location }}</td>
                        </tr>
                    </table>

                    @if(!$is_guest)
                        <a class="btn btn--my_info" href="#">Редактировать</a>
                    @elseif($is_guest && auth()->check())
                        <a class="btn btn--my_info" href="tel:+7952812">Позвонить</a>
                    @endif
                </div>
                <div class="wrap__info_office">
                    @if(!is_string($user->favorites))
                        <div class="swiper mySwiper block__office">
                            <h4>Врачи</h4>
                            <div class="swiper-wrapper wrap__dop_info--doctors_card">
                                @foreach($user->favorites as $favorite)
                                    <a class="swiper-slide block__dop_info--doctors_card" href="{{ route('profile', ['user' => $favorite->user_id]) }}">
                                        <img class="avatat__dop_info--doctor" src="{{ asset('img/avatars/' . $favorite->avatar) }}" alt="doctor_photo">
                                        <span>{{ $favorite->specialization }}</span>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="block__office">
                        <h4>История болезней</h4>
                        @if(!isset($logs[0]))
                            <p>Отсутствует</p>
                        @else
                            <div class="wrap__dop_info wrap__dop_info--disease">
                                @foreach($logs as $log)
                                    <a class=" block__dop_info block__dop_info--disease" href="#">
                                        <p>{{ $log->title }}</p>
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
                                        <p>{{ $certificate->title }}</p>
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

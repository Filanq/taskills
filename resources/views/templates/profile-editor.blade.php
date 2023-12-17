<!DOCTYPE html>
<html lang="ru">
<head>
    <x-head>Редактировать профиль</x-head>
    @vite('resources/js/data-transfer.js')
    @vite('resources/js/profile-edit.js')
</head>
<body>
    <div class="section">
        <div class="container">
            <h3>Редактировать профиль</h3>
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
                </div>
                <div class="wrap__info_office">
                    <div class="block__office block__office--editor">
                        <div>
                            <h4>Аккаунт</h4>
                            <form id="password-form" class="wrap__dop_info wrap__dop_info--editor" action="{{ route('profile.edit-password') }}" method="post" enctype="application/x-www-form-urlencoded">
                                @csrf
                                <div>
                                    <label class="label_btn_input" for="old_password">Старый пароль<span class="red">*</span></label>
                                    <input class="btn_input" name="old_password" id="old_password" type="password" placeholder="Пароль">
                                </div>
                                <div>
                                    <label class="label_btn_input" for="new_password">Новый пароль<span class="red">*</span></label>
                                    <input class="btn_input" name="new_password" id="new_password" type="password" placeholder="Пароль">
                                </div>

                                <input class="btn_input--push" type="submit" value="Сохранить">
                            </form>
                        </div>
                        <form id="profile-form" action="{{ route('profile.edit') }}" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" id="csrf" value="{{ csrf_token() }}">
                            <h4>Личные данные</h4>
                            <div class="wrap__dop_info wrap__dop_info--editor">
                                <div>
                                    <label class="label_btn_input" for="avatar">Аватар</label>
                                    <input class="btn_input" data-src="{{ $user->avatar }}" name="img" id="img" type="file">
                                </div>
                                <div>
                                    <label class="label_btn_input" for="name">Имя</label>
                                    <input class="btn_input" value="{{ $user->firstname }}" name="firstname" id="firstname" type="text" placeholder="Изменить имя">
                                </div>
                                <div>
                                    <label class="label_btn_input" for="surname">Фамилия</label>
                                    <input class="btn_input" value="{{ $user->surname }}" name="surname" id="surname" type="text" placeholder="Изменить фамилию">
                                </div>
                                <div>
                                    <label class="label_btn_input" for="age">Возраст</label>
                                    <input class="btn_input" value="{{ $user->age }}" name="age" id="age" type="number" placeholder="Изменить возраст">
                                </div>
                                <div>
                                    <label class="label_btn_input" for="gender">Пол</label>
                                    <select name="sex" class="btn_input" id="sex">
                                        <option @if($user->sex == 'Мужской') selected @endif value="Мужской">Мужской</option>
                                        <option @if($user->sex == 'Женский') selected @endif value="Женский">Женский</option>
                                    </select>
                                </div>
                                @if(!$is_medic)
                                    <div>
                                        <label class="label_btn_input" for="status">Семейное положение</label>
                                        <select class="btn_input" name="status" id="status">
                                            <option @if($user->status == 'Женат/Замужем') selected @endif value="Женат/Замужем">Женат/Замужем</option>
                                            <option @if($user->status == 'Свободен(-а)') selected @endif value="Свободен(-а)">Свободен(-а)</option>
                                        </select>
                                    </div>
                                @endif
                                @if($is_medic)
                                    <div>
                                        <label class="label_btn_input" for="specialization">Специализация</label>
                                        <input class="btn_input" value="{{ $user->specialization }}" name="specialization" id="specialization" type="text" placeholder="Хирург">
                                    </div>
                                    <div>
                                        <label class="label_btn_input" for="graphic">График</label>
                                        <input class="btn_input" name="graphic" id="graphic" type="text" placeholder="Пн, Ср, Пт">
                                    </div>
                                @endif

                                <div>
                                    <label class="label_btn_input" for="location">Местоположение</label>
                                    <input class="btn_input" value="{{ $user->location }}" id="location" name="location" type="text" placeholder="Россия, Москва">
                                </div>

                                <input class="btn_input--push" type="submit" value="Сохранить">
                            </div>
                        </form>
                    </div>



                </div>
            </div>
        </div>
    </div>
</body>
</html>

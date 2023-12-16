<!DOCTYPE html>
<html lang="ru">
<head>
    <x-head>Редактировать профиль</x-head>
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

                    @if(!$is_guest)
                        <a class="btn btn--my_info" href="#">Редактировать</a>
                    @elseif($is_guest && auth()->check())
                        <a class="btn btn--my_info" href="tel:+7952812">Позвонить</a>
                    @endif
                </div>
                <div class="wrap__info_office">
                    <div class="block__office block__office--editor">
                        <div>
                            <h4>Аккаунт</h4>
                            <form class="wrap__dop_info wrap__dop_info--editor" action="" method="post">
                                <div>
                                    <label class="label_btn_input" for="old_password">Старый пароль<span class="red">*</span></label>
                                    <input class="btn_input" id="old_password" type="password" placeholder="Пароль">
                                </div>
                                <div>
                                    <label class="label_btn_input" for="new_password">Новый пароль<span class="red">*</span></label>
                                    <input class="btn_input" id="new_password" type="password" placeholder="Пароль">
                                </div>

                                <input class="btn_input--push" type="submit" value="Сохранить">
                            </form>
                        </div>
                        <div>
                            <h4>Личные данные</h4>
                            <div class="wrap__dop_info wrap__dop_info--editor">
                                <div>
                                    <label class="label_btn_input" for="name">Имя</label>
                                    <input class="btn_input" id="name" type="text" placeholder="Изменить имя">
                                </div>
                                <div>
                                    <label class="label_btn_input" for="surname">Фамилия</label>
                                    <input class="btn_input" id="surname" type="text" placeholder="Изменить фамилию">
                                </div>
                                <div>
                                    <label class="label_btn_input" for="midname">Отчество</label>
                                    <input class="btn_input" id="midname" type="text" placeholder="Изменить отчество">
                                </div>
                                <div>
                                    <label class="label_btn_input" for="age">Возраст</label>
                                    <input class="btn_input" id="age" type="number" placeholder="Изменить возраст">
                                </div>
                                <div>
                                    <label class="label_btn_input" for="gender">Пол</label>
                                    <select class="btn_input" id="gender">
                                        <option value="Мужской">Мужской</option>
                                        <option value="Мужской">Женсикй</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="label_btn_input" for="family">Семейное положение</label>
                                    <select class="btn_input" id="family">
                                        <option value="Мужской">Женат (замужем)</option>
                                        <option value="Мужской">Нет</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="label_btn_input" for="point">Местоположение</label>
                                    <input class="btn_input" id="point" type="number" placeholder="Изменить местоположение">
                                </div>

                                <input class="btn_input--push" type="submit" value="Сохранить">
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</body>
</html>

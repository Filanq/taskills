<!DOCTYPE html>
<html lang="en">
<head>
    <x-head>Online Medical Apps</x-head>
    @vite('resources/js/profile-data.js')
</head>
<body>
    <x-header></x-header>

    <div class="section">
        <div class="container">
            <h3>Справки | Болезни</h3>
            <div class="wrap__office wrap__info_office--recomend">
                <div class="block__office">
                    <div class="h4__and_plus">
                        <h4>История болезней</h4>
                        @if(auth()->user()->status === 'medic' && $user->status == 'person')
                            <input type="hidden" id="user_id" value="{{ $user->id }}">
                            <input type="hidden" id="csrf" value="{{ csrf_token() }}">
                            <span id="logAddBtn">+</span>
                        @endif
                    </div>
                    @if(!isset($logs[0]))
                        <p>Отсутствует</p>
                    @else
                        <div class="wrap__dop_info wrap__dop_info--disease_str">
                            @foreach($logs as $log)
                                <span class="block__dop_info block__dop_info--disease">
                                    <p>{{ $log->title }} @if(auth()->user()->status == 'medic') ({{ $user->firstname }} {{ $user->surname }}) @endif</p>
                                    <span>{{ $log->date }}</span>
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="block__office wrap__office--refer_str">
                    <div class="h4__and_plus">
                        <h4>Сертификаты</h4>
                        @if(auth()->user()->status === 'medic' && $user->status == 'person')
                            <span id="certAddBtn">+</span>
                        @endif
                    </div>
                    @if(!isset($certificates[0]))
                        <p>Отсутствуют</p>
                    @else
                        <div class="wrap__dop_info wrap__dop_info--disease_str">
                            @foreach($certificates as $certificate)
                                <a class="block__dop_info block__dop_info--disease" href="{{ route('profile.get-file', ['id' => $certificate->id]) }}">
                                    <p>{{ $certificate->title }} @if(auth()->user()->status == 'medic') ({{ $user->firstname }} {{ $user->surname }})@endif</p>
                                    <span>{{ $certificate->date }}</span>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal-new-file">
        <form method="post">
            <h2></h2>
            <label class="input-file">
                <input id="inputFile" type="file" required>
                <span class="input-file-btn">Выберите файл</span>
                <span class="selectedFile"></span>
            </label>
            <input class="input-file-submit" type="submit" value="Отправить">
        </form>
    </div>
    <div class="darker"></div>
    <script>

    </script>

</body>
</html>

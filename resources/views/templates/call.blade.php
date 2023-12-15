<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    @vite('resources/js/call.js')
</head>
<body>
    <video src="" playsinline autoplay id="local" width="400" height="400"></video>
    <video src="" playsinline autoplay id="remote" width="400" height="400"></video>

    <button id="webcamButton">Старт</button>
    <br><br><br>
    <button id="callButton">Создать звонок</button>
    <br><br><br>
    <input type="text" id="callInput">
    <button id="answerButton">Присоединиться</button>
</body>
</html>

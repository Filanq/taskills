<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
@vite(['resources/css/normalize.css', 'resources/css/cent1ck_style.css', 'resources/css/style.css', 'resources/css/filans_style.css', 'resources/js/bootstrap.js'])
<title>{{ $slot }}</title>

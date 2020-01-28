<!doctype html>
<html>
<head>
    <title>@yield('title') | The Tool</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{ elixir('assets/css/all.css') }}">
    <script src="{{ elixir('assets/js/all.js') }}"></script>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/vnd.microsoft.icon">
</head>
<body>
@include('_partial.analytics-google')
<div class="ui left fixed inverted vertical menu">
    <div class="item header">WiseMon Tools</div>
    <a class="item" href="{{ route('text-length') }}">Длина текста</a>
    <a class="item" href="{{ route('client-info') }}">Информация о клиенте</a>
    <a class="item" href="{{ route('hash') }}">Хэш-генератор</a>
    <a class="item" href="{{ route('password') }}">Генератор паролей</a>
    <a class="item" href="{{ route('url-encode') }}">Декодер веб-адресов</a>
    <a class="item" href="{{ route('ip-blacklist') }}">IP в блэклистах</a>
    <a class="item" href="{{ route('name-generator') }}">Генератор имён</a>
    <a class="item" href="{{ route('time-converter') }}">Конвертер времени</a>
    <a class="item" href="{{ route('page-meta') }}">META страниц</a>
    <a class="item" href="{{ route('whois') }}">WHOIS</a>
    <div class="item header">
        <img src="/assets/image/logo-cybercog.svg" style="width: 24px;">
        <a href="https://cybercog.su/?utm_source=tool.cybercog.su" target="_blank" style="margin-left: 4px;">
            CyberCog LLC
        </a>
    </div>
</div>
<div class="ui container segment root">
    @yield('content')
</div>

@stack('script-footer')

</body>
</html>

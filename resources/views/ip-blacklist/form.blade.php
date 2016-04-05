@extends('layout.master')

@section('title', 'Проверка IP в блэклистах')

@section('content')
<h1>Проверка IP в блэклистах</h1>
{!! Form::open(['url' => 'ip-blacklist', 'class' => 'ui fluid form']) !!}
    <div class="ui field">
        <div>{!! Form::label('ipV4', 'IPv4', ['class' => 'ui pointing below label large']) !!}</div>
        <div>{!! Form::text('ipV4', @$ipV4, ['class' => 'ui input large']) !!}</div>
    </div>
    <div class="ui inverted segment">
        {!! Form::submit('Проверить', ['class' => 'ui primary button inverted teal', 'name' => 'check']) !!}
    </div>
    @if ($checkPerformed)
        <div>
            <h2>Результат сканирования</h2>
            @if ($inBlacklist)
                <h3 class="ui header red">IP адрес обнаружен в чёрном списке</h3>
                <ul class="ui list divided relaxed">
                    @foreach($blacklistInfoLinks as $link)
                        <li class="item">
                            <a href="{{ $link }}" target="_blank">{{ $link }}</a>
                        </li>
                    @endforeach
                </ul>
            @else
                <h3 class="ui header green">IP адрес в чёрном списке не обнаружен</h3>
            @endif
            <p>
                <i>Сканирование осуществлено сервисом <a href="{{ $checkerUrl }}">Spamhaus</a></i>
            </p>
        </div>
    @endif
{!! Form::close() !!}
@endsection

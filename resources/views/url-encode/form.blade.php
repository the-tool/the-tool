@extends('layout.master')

@section('title', 'Декодер веб-адресов')

@section('content')
<h1>Декодер веб адресов</h1>
{!! Form::open(['url' => 'url-encode', 'class' => 'ui fluid form']) !!}
    <div class="">
        <div>{!! Form::label('url', 'URL', ['class' => 'ui pointing below label large']) !!}</div>
        <div>{!! Form::textarea('url', @$url, ['class' => 'ui input large']) !!}</div>
    </div>
    <div class="ui inverted segment">
        {!! Form::submit('Кодировать', ['class' => 'ui primary button inverted teal', 'name' => 'encode']) !!}
        {!! Form::submit('Декодировать', ['class' => 'ui primary button inverted purple', 'name' => 'decode']) !!}
    </div>
    <div>
        <div>{!! Form::label('skipCharacters', 'Skip characters', ['class' => 'ui pointing below label large']) !!}</div>
        <div>{!! Form::text('skipCharacters', @$skipCharacters, ['class' => 'ui input large']) !!}</div>
    </div>
{!! Form::close() !!}
@endsection

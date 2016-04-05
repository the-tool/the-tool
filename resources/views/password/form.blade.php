@extends('layout.master')

@section('title', 'Генератор паролей')

@section('content')
<h1>Генератор паролей</h1>
{!! Form::open(['url' => 'password', 'class' => 'ui fluid form']) !!}
    <div class="ui grid">
        <div class="right floated six wide column">
            <div>{!! Form::label('length', 'Length', ['class' => 'ui pointing below label large']) !!}</div>
            <div>{!! Form::number('length', @$length, ['class' => 'ui input large', 'min' => 1]) !!}</div>
        </div>
        <div class="left floated ten wide column">
            <div>{!! Form::label('password', 'Password', ['class' => 'ui pointing below label large']) !!}</div>
            <div>{!! Form::text('password', @$password, ['class' => 'ui input large', 'readonly' => true]) !!}</div>
        </div>
    </div>
    <div class="ui inverted segment">
        {!! Form::submit('Генерировать новый пароль', ['class' => 'ui primary button inverted teal']) !!}
    </div>
    <div class="ui list horizontal divided large">
        <div class="item">
            <div class="ui checkbox">
                {!! Form::hidden('useLatinCharacters', 0) !!}
                {!! Form::checkbox('useLatinCharacters', 1, @$useLatinCharacters, ['id' => 'useLatinCharacters']) !!}
                {!! Form::label('useLatinCharacters', 'Use latin characters') !!}
            </div>
        </div>
        <div class="item">
            <div class="ui checkbox">
                {!! Form::hidden('useDigitCharacters', 0) !!}
                {!! Form::checkbox('useDigitCharacters', 1, @$useDigitCharacters, ['id' => 'useDigitCharacters']) !!}
                {!! Form::label('useDigitCharacters', 'Use digit characters') !!}
            </div>
        </div>
        <div class="item">
            <div class="ui checkbox">
                {!! Form::hidden('useSymbolCharacters', 0) !!}
                {!! Form::checkbox('useSymbolCharacters', 1, @$useSymbolCharacters, ['id' => 'useSymbolCharacters']) !!}
                {!! Form::label('useSymbolCharacters', 'Use symbol characters') !!}
            </div>
        </div>
        <div class="item">
            <div class="ui checkbox">
                {!! Form::hidden('useSafeCharacters', 0) !!}
                {!! Form::checkbox('useSafeCharacters', 1, @$useSafeCharacters, ['id' => 'useSafeCharacters']) !!}
                {!! Form::label('useSafeCharacters', 'Use safe characters', ['title' => 'Hide characters like: o, O, 0, I, l']) !!}
            </div>
        </div>
    </div>
{!! Form::close() !!}
@endsection

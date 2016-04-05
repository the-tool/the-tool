@extends('layout.master')

@section('title', 'Генератор паролей')

@section('content')
<h1>Генератор паролей</h1>
{!! Form::open(['url' => 'time-converter', 'class' => 'ui fluid form']) !!}
<div class="ui grid">
    <div class="ten wide column">
        <div>{!! Form::label('unix_timestamp', 'Unix timestamp', ['class' => 'ui pointing below label large']) !!}</div>
        <div>{!! Form::text('unix_timestamp', $unixTimestamp, ['class' => 'ui input large']) !!}</div>
    </div>
</div>
<div class="ui inverted segment">
    {!! Form::submit('&#8675; Unix в Человеческое', ['name' => 'unit_to_human', 'class' => 'ui primary button inverted teal']) !!}
    {!! Form::submit('&#8673; Человеческое в Unix', ['name' => 'human_to_unix', 'class' => 'ui primary button inverted purple']) !!}
</div>
<div class="ui grid">
    <div class="ten wide column">
        <div>{!! Form::label('human_timestamp', 'Human time', ['class' => 'ui pointing below label large']) !!}</div>
        <div>{!! Form::text('human_timestamp', $humanTimestamp, ['class' => 'ui input large']) !!}</div>
    </div>
    <div class="six wide column">
        <div>{!! Form::label('time_zone', 'Time zone', ['class' => 'ui pointing below label large']) !!}</div>
        <div>{!! Form::text('time_zone', $timeZone, ['class' => 'ui input large', 'readonly' => true]) !!}</div>
    </div>
</div>
{!! Form::close() !!}
@endsection

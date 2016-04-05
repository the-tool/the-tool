@extends('layout.master')

@section('title', 'Информация о клиенте')

@section('content')
<h1>Информация о клиенте</h1>
<div class="ui list large relaxed form">
    <div class="item">
        <label class="ui pointing below label large">IP v4</label>
        <input type="text" value="{{ $ip_v4 }}" readonly>
    </div>
    <div class="item">
        <label class="ui pointing below label large">UserAgent</label>
        <input type="text" value="{{ $ua }}" readonly>
    </div>
</div>
@endsection

@section('sidebar')
    @parent
    <ul class="ui left vertical inverted labeled icon sidebar menu">
        <li class="item">
            {!! link_to_route('text-length', '<i class="trophy icon"></i> Длина текста') !!}
        </li>
    </ul>
@endsection

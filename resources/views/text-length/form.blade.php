@extends('layout.master')

@section('title', 'Подсчёт длины текста')

@section('content')
<h1>Подсчёт длины текста</h1>
{!! Form::open(['url' => 'text-length', 'class' => 'ui fluid form']) !!}
    <div class="ui field">
        <div>{!! Form::label('body', 'Text body', ['class' => 'ui pointing below label large']) !!}</div>
        <div>{!! Form::textarea('body', @$body, ['class' => 'ui input large']) !!}</div>
    </div>
    <div class="ui inverted segment">
        {!! Form::submit('Посчитать', ['class' => 'ui primary button inverted teal']) !!}
    </div>
    <div class="ui list horizontal divided large">
        <div class="item">
            Characters count:
            <span id="charsCount">{{ @$bodyLength }}</span>
        </div>
        <div class="item">
            Characters count (ignore spaces):
            <span id="charsCountIgnoreSpace">{{ @$bodyLengthIgnoreSpace }}</span>
        </div>
        <div class="item">
            Words count:
            <span id="wordsCount">{{ @$wordsCount }}</span>
        </div>
    </div>
{!! Form::close() !!}
@endsection

@push('script-footer')
<script>
    $(document).ready(function() {
        $('.ui.field textarea').characterCount($('#charsCount'));
        $('.ui.field textarea').characterCount($('#charsCountIgnoreSpace'), true);
        $('.ui.field textarea').wordCount($('#wordsCount'));
    });
</script>
@endpush

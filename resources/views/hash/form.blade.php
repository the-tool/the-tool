@extends('layout.master')

@section('title', 'Хэш-генератор')

@section('content')
<h1>Создать хэш</h1>
{!! Form::open(['url' => 'hash', 'class' => 'ui fluid form']) !!}
    <div class="ui field">
        <div>{!! Form::label('body', 'Text body', ['class' => 'ui pointing below label large']) !!}</div>
        <div>{!! Form::text('body', @$body, ['class' => 'ui input large']) !!}</div>
    </div>
    <div class="ui inverted segment">
        {!! Form::submit('Конвертировать', ['class' => 'ui primary button inverted teal']) !!}
    </div>
    <div class="ui list large">
        <div class="item">
            <label class="ui pointing below label large cursor-help" title="MD5 (Message-Digest algorithm) — алгоритм хеширования, разработанный профессором Р. Л. Ривестом в еще 1991 году. Алгоритм md5 шифрует любые данные в формате 128-bit hash (контрольную сумму), которую достаточно сложно подделать. Алгоритм используется для проверки подлинности данных, когда происходит их передача в зашифрованном виде.">
                MD5
            </label>
            <input type="text" value="{{ @$md5Hash }}" readonly>
        </div>
        <div class="item">
            <label class="ui pointing below label large">Base64 MD5</label>
            <input type="text" value="{{ @$base64Md5Hash }}" readonly>
        </div>
        <div class="item">
            <label class="ui pointing below label large">SHA1</label>
            <input type="text" value="{{ @$sha1Hash }}" readonly>
        </div>
        <div class="item">
            <label class="ui pointing below label large">Base64</label>
            <textarea class="ui input large" readonly>{{ @$base64Hash }}</textarea>
        </div>
    </div>
{!! Form::close() !!}
@endsection

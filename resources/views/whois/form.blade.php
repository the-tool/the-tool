@extends('layout.master')

@section('title', 'WHOIS проверка домена')

@section('content')
<h1>Проверить домен</h1>
{!! Form::open(['url' => 'whois', 'class' => 'ui fluid form']) !!}
    <div class="ui field">
        <div>{!! Form::label('domain', 'Domain name', ['class' => 'ui pointing below label large']) !!}</div>
        <div>{!! Form::text('domain', $domain, ['class' => 'ui input large']) !!}</div>
    </div>
    <div class="ui inverted segment">
        {!! Form::submit('Проверить', ['class' => 'ui primary button inverted teal']) !!}
    </div>
    @if ($domain)
        <div class="ui list large">
            <div class="item">
                @if ($isAvailable)
                    <label class="ui pointing below green label large">
                        Domain is available
                    </label>
                @else
                    <label class="ui pointing below red label large">
                        Domain is already taken!
                    </label>
                @endif
                <pre class="ui input large" readonly>{{ $response }}</pre>
            </div>
        </div>
    @endif
{!! Form::close() !!}
@endsection

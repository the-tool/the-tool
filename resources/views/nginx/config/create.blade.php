@extends('layout.master')

@section('content')
{!! Form::open([
    'class' => 'ui fluid form',
    'method' => 'POST',
    'route' => 'nginx-config.store',
]) !!}

    <div class="ui field">
        <div>{!! Form::label('domain', 'Domain', ['class' => 'ui pointing below label large']) !!}</div>
        <div>
            {!! Form::url(
                'domain',
                old('domain'),
                [
                    'class' => 'ui input large',
                    'required' => 'required',
                    'placeholder' => 'https://cybercog.su'
                ]
            ) !!}
        </div>
    </div>
    <div class="field">
        <div>{!! Form::label('domains_secondary', 'Secondary domains (optional)', ['class' => 'ui pointing below label large']) !!}</div>
        <div>
            {!! Form::text(
                'domains_secondary',
                old('domains_secondary'),
                [
                    'class' => 'ui input large',
                    'placeholder' => 'cybercog.su'
                ]
            ) !!}
        </div>
    </div>
    <div class="field">
        <div>{!! Form::label('fast_cgi_port', 'FastCGI port', ['class' => 'ui pointing below label large']) !!}</div>
        <div>
            {!! Form::text(
                'fast_cgi_port',
                old('fast_cgi_port'),
                [
                    'class' => 'ui input large',
                    'required' => 'required',
                    'placeholder' => '9000'
                ]
            ) !!}
        </div>
    </div>
    <div class="field">
        <div class="ui checkbox">
            {!! Form::checkbox(
                'rewrite_end_slash',
                1,
                old('rewrite_end_slash', true),
                [
                    'tabindex' => 0,
                    'class' => 'hidden',
                    'id' => 'rewrite_end_slash',
                ]
            ) !!}
            {!! Form::label('rewrite_end_slash', 'Rewrite end slash') !!}
        </div>
    </div>
    <div class="ui inverted segment">
        {!! Form::submit('Generate config', ['class' => 'ui primary button inverted teal', 'name' => 'check']) !!}
    </div>
{!! Form::close() !!}
@endsection

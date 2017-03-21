@extends('layout.master')

@section('title', 'Конвертер JSON')

@section('content')
<h1>Конвертер JSON</h1>
{!! Form::open(['url' => 'json-converter', 'class' => 'ui fluid form']) !!}
<div class="ui grid">
    <div class="wide column">
        <div>{!! Form::label('text', 'Raw text', ['class' => 'ui pointing below label large']) !!}</div>
        <div>{!! Form::textarea('text', '', ['id' => 'TextSource', 'class' => 'ui input large']) !!}</div>
    </div>
</div>
<div class="ui inverted segment">
    {!! Form::button('&#8675; Конвертировать в JSON', ['name' => 'text_to_json', 'class' => 'ui primary button inverted teal']) !!}
</div>
<div class="ui grid">
    <div class="wide column">
        <div>{!! Form::label('human_timestamp', 'JSON', ['class' => 'ui pointing below label large']) !!}</div>
        <div>{!! Form::textarea('human_timestamp', '', ['id' => 'TextOutput', 'class' => 'ui input large']) !!}</div>
    </div>
</div>
{!! Form::close() !!}

<script>
    $('button').on('click', function () {
        var source = $('#TextSource').val();
        var output = JSON.stringify(source);

        console.log(output);
        $('#TextOutput').html(output);
    });
</script>
@endsection


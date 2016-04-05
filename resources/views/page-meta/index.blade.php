@extends('layout.master')

@section('title', 'META информация страницы')

@section('content')

<?php

function printAny($text)
{
    if (is_array($text)) {
        printArray($text);
    } else {
        printText($text);
    }
}

function printText($text)
{
    echo htmlspecialchars($text, ENT_IGNORE);
}

function printImage($image)
{
    if ($image) {
        echo <<<EOT
                <img src="{$image}"><br>
EOT;
        printUrl($image);
    }
}

function printUrl($url)
{
    if ($url) {
        echo <<<EOT
                <a href="{$url}" target="_blank">Open (new window)</a> | {$url}
EOT;
    }
}

function printArray($array)
{
    if ($array) {
        echo '<pre>'.htmlspecialchars(print_r($array, true), ENT_IGNORE).'</pre>';
    }
}

function printCode($code, $asHtml = true)
{
    if ($asHtml) {
        echo $code;
    }

    if ($code) {
        echo '<pre>'.htmlspecialchars($code, ENT_IGNORE).'</pre>';
    }
}
?>

<h1>META информация страницы</h1>

<form method="GET">
    <div class="ui list large relaxed form">
        <div class="item">
            <label class="ui pointing below label large" for="url">URL</label>
            <input type="url"
                   id="url"
                   name="url"
                   value="{{ $url }}"
                   placeholder="http://"
                   autofocus>
        </div>
    </div>
    <div class="ui inverted segment">
        {!! Form::submit('Получить информацию', ['class' => 'ui primary button inverted teal']) !!}
    </div>
</form>

    @if (!empty($info))
        <section class="PageMeta__Result">
            <h1>Result</h1>

            <table class="PageMeta__Table">
                @foreach ($adapterData as $name => $value)
                <tr>
                    <th class="PageMeta__HeadCell">{!! $name !!}</th>
                    <td class="PageMeta__Cell">{!! $value !!}</td>
                </tr>
                @endforeach
            </table>

            <div class="PageMeta__ButtonExtend">
                <button class="ui primary button inverted purple"
                        onclick="document.getElementById('ExtendedData').style.display = 'block'; this.style.display = 'none';">
                    View all collected data
                </button>
            </div>

            <div class="PageMeta__ExtendedData" id="ExtendedData">
                @foreach ($info->getAllProviders() as $providerName => $provider)
                <h2>{!! $providerName !!} provider</h2>

                <table class="PageMeta__Table">
                    @foreach ($providerData as $name => $fn)
                    <tr>
                        <th class="PageMeta__HeadCell">{!! $providerName !!}.{!! $name !!}</th>
                        <td class="PageMeta__Cell"><?php $fn($provider->{"get{$name}"}(), false); ?></td>
                    </tr>
                    @endforeach

                    <tr>
                        <th class="PageMeta__HeadCell">All data collected</th>
                        <td class="PageMeta__Cell"><?php printArray($provider->bag->getAll()); ?></td>
                    </tr>

                    @if (isset($provider->api))
                    <tr>
                        <th class="PageMeta__HeadCell">Data provider by the API</th>
                        <td class="PageMeta__Cell"><?php printArray($provider->api->getAll()); ?></td>
                    </tr>
                    @endif

                </table>
                @endforeach

                <h2>Http request info</h2>

                <table class="PageMeta__Table">
                    @foreach ($info->getRequest()->getRequestInfo() as $name => $value)
                    <tr>
                        <th class="PageMeta__HeadCell">{!! $name !!}</th>
                        <td class="PageMeta__Cell"><?php printAny($value); ?></td>
                    </tr>
                    @endforeach
                </table>

                <h2>Content</h2>

                <pre>
                    <?php printText($info->getRequest()->getContent()); ?>
                </pre>
            </div>
        </section>
    @elseif (!empty($url))
        <h1>Информацию получить не удалось</h1>
    @endif

@endsection

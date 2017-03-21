<?php

/*
 * This file is part of The Tool.
 *
 * (c) CyberCog <oss@cybercog.su>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Controllers;

use Embed\Embed;
use Exception;
use Illuminate\Http\Request;

/**
 * Class PageMetaController.
 * @package App\Http\Controllers
 */
class PageMetaController extends Controller
{
    /**
     * Resolve meta data of present URL.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Embed\Exceptions\InvalidUrlException
     */
    public function index(Request $request)
    {
        $url = $request->input('url');

        $providerData = [
            'title' => 'printText',
            'description' => 'printText',
            'url' => 'printUrl',
            'type' => 'printText',
            'tags' => 'printArray',
            'imagesUrls' => 'printArray',
            'code' => 'printCode',
            'source' => 'printUrl',
            'width' => 'printText',
            'height' => 'printText',
            'authorName' => 'printText',
            'authorUrl' => 'printUrl',
            'providerIconsUrls' => 'printArray',
            'providerName' => 'printText',
            'providerUrl' => 'printUrl',
            'publishedTime' => 'printText',
        ];

        $adapterData = [
            'title' => 'printText',
            'description' => 'printText',
            'url' => 'printUrl',
            'type' => 'printText',
            'tags' => 'printArray',
            'image' => 'printImage',
            'imageWidth' => 'printText',
            'imageHeight' => 'printText',
            'images' => 'printArray',
            'code' => 'printCode',
            'source' => 'printUrl',
            'width' => 'printText',
            'height' => 'printText',
            'aspectRatio' => 'printText',
            'authorName' => 'printText',
            'authorUrl' => 'printUrl',
            'providerIcon' => 'printImage',
            'providerIcons' => 'printArray',
            'providerName' => 'printText',
            'providerUrl' => 'printUrl',
            'publishedTime' => 'printText',
        ];

        $info = '';

        if ($url) {
            try {
                $info = Embed::create($url);
            } catch (Exception $exception) {
                // :TODO: Log it
                $error = $exception->getMessage();
            }
        }

        if (!empty($info)) {
            $adapterData = $this->collectAdapterData($adapterData, $info);
        }

        return view('page-meta.index', compact('url', 'providerData', 'adapterData', 'info'));
    }

    private function collectAdapterData($adapterFields, $info)
    {
        $adapterData = [];
        foreach ($adapterFields as $key => $function) {
            $adapterData[$key] = $this->{$function}($info->{$key});
        }

        return $adapterData;
    }

    private function gett($name, $default = '')
    {
        if (!isset($_GET[$name])) {
            return $default;
        }

        if ($name === 'url') {
            if (!filter_var($_GET['url'], FILTER_VALIDATE_URL)) {
                return 'http://doNotTryToXSS.invalid';
            }
        }

        return $_GET[$name];
    }

    /*
    private function getEscaped($name, $default = '')
    {
        return htmlspecialchars(gett($name, $default), ENT_QUOTES, 'UTF-8');
    }
    */

    private function printAny($text)
    {
        $output = '';
        if (is_array($text)) {
            $output .= $this->printArray($text);
        } else {
            $output .= $this->printText($text);
        }

        return $output;
    }

    private function printText($text)
    {
        return htmlspecialchars($text, ENT_IGNORE);
    }

    private function printImage($image)
    {
        $output = '';
        if ($image) {
            $output .= "<img src='{$image}'><br>";
            $output .= $this->printUrl($image);
        }

        return $output;
    }

    private function printUrl($url)
    {
        $output = '';
        if ($url) {
            $output .= "<a href='{$url}' target='_blank'>Open (new window)</a> | {$url}";
        }

        return $output;
    }

    private function printArray($array)
    {
        $output = '';

        if ($array) {
            $output .= '<pre>' . htmlspecialchars(print_r($array, true), ENT_IGNORE) . '</pre>';
        }

        return $output;
    }

    private function printCode($code, $asHtml = true)
    {
        $output = '';

        if ($asHtml) {
            $output .= $code;
        }

        if ($code) {
            $output .= '<pre>' . htmlspecialchars($code, ENT_IGNORE) . '</pre>';
        }

        return $output;
    }
}

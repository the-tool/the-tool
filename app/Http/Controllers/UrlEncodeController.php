<?php

/*
 * This file is part of The Tool.
 *
 * (c) CyberCog <support@cybercog.su>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

/**
 * Class UrlEncodeController.
 * @package App\Http\Controllers
 */
class UrlEncodeController extends Controller
{
    /**
     * Encode URL address.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $url = Input::get('url');
        $encode = Input::get('encode');
        $decode = Input::get('decode');
        $skipCharacters = Input::get('skipCharacters');

        if ($encode) {
            $charactersReplace = str_split($skipCharacters);
            $characterSearch = [];
            foreach ($charactersReplace as $character) {
                $characterSearch[] = urlencode($character);
            }
            $url = urlencode($url);
            $url = str_replace($characterSearch, $charactersReplace, $url);
        } elseif ($decode) {
            $url = urldecode($url);
        }

        return view('url-encode.form',
            [
                'url' => $url,
                'skipCharacters' => $skipCharacters,
            ]
        );
    }
}

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

use Illuminate\Support\Facades\Input;

/**
 * Class TextLengthController.
 * @package App\Http\Controllers
 */
class TextLengthController extends Controller
{
    /**
     * Calculate text length.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $body = Input::get('body');
        $body = trim($body);
        $bodyLength = mb_strlen($body, 'utf-8');
        if ($bodyLength > 0) {
            $wordsCount = count(preg_split('/\s+/u', $body));
        } else {
            $wordsCount = 0;
        }

        $searchIgnoreChars = [' ', "\n", "\r"];
        $bodyIgnoreSpace = str_replace($searchIgnoreChars, '', $body);
        $bodyLengthIgnoreSpace = mb_strlen($bodyIgnoreSpace, 'utf-8');

        return view('text-length.form',
            [
                'body' => $body,
                'bodyLength' => $bodyLength,
                'bodyLengthIgnoreSpace' => $bodyLengthIgnoreSpace,
                'wordsCount' => $wordsCount,
            ]
        );
    }
}

<?php

/*
 * This file is part of The Tool.
 *
 * (c) Anton Komarev <a.komarev@cybercog.su>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;

/**
 * Class HashController.
 * @package App\Http\Controllers
 */
class HashController extends Controller
{
    /**
     * Hash generating.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $body = Input::get('body');
        // :TODO: Optional checkbox to trim spaces
        //$body = trim($body);

        $md5Hash = md5($body);
        $base64Md5Hash = base64_encode(md5($body, true));
        $base64Hash = base64_encode($body);
        $sha1Hash = sha1($body);

        return view('hash.form',
            [
                'body' => $body,
                'md5Hash' => $md5Hash,
                'base64Md5Hash' => $base64Md5Hash,
                'base64Hash' => $base64Hash,
                'sha1Hash' => $sha1Hash,
            ]
        );
    }
}
